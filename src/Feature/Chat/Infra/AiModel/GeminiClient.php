<?php

namespace App\Feature\Chat\Infra\AiModel;

use App\Feature\Chat\Infra\AiModel\Models\AiModelAction;
use App\Shared\App\Enums\Event;
use App\Shared\Infra\Database\Models\EventSchema;
use Http;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GeminiClient implements IAiModel
{

    private array $schemas;
    public function __construct(
        private readonly Http $httpClient,
        EventSchema $eventSchema
    ) {
        $this->schemas = $eventSchema->all(['event', 'output'])->keyBy('event')->toArray();
    }

    public function prompt(array $prompts): AiModelAction
    {
        $url = config('services.gemini.base_url') . "/models/gemini-2.5-flash:generateContent";

        $response = $this->httpClient::withHeader(
            "x-goog-api-key",
            config('services.gemini.api_key')
        )->post(
                $url,
                [
                    "contents" => [
                        "parts" => Collection::make([
                            "Based on the provided schemas, build the most consistent JSON schema according to the prompt that will be provided.",
                            "The response MUST always be a valid JSON and contain the following keys:
- 'event': string with the event name, or null if no coherent event is found
- 'output': object containing the event properties, or an empty object if no event is found
- 'response': a clear, user-facing message describing what happened
- 'executeAppEvent': boolean",
                            "Rules:
- If a coherent event matching the schemas is found, set 'executeAppEvent' to true and populate 'event' and 'output' accordingly.
- If NO coherent event can be determined from the schemas, set:
  - 'event' to null
  - 'output' to {}
  - 'executeAppEvent' to false
  - 'response' to a custom message responding or interacting with user, informing them that no matching action was found.
",
                            "Schemas: " . json_encode($this->schemas),
                            "Return ONLY the JSON. No explanations, no extra text.",
                            ...$prompts
                        ])
                            ->map(fn($text) => ["text" => $text])
                            ->toArray()
                    ]
                ]
            )->json();


        $result = json_decode(
            Str::replace(
                ["```", "json"],
                "",
                $response['candidates'][0]['content']['parts'][0]['text']
            )
        );
        return new AiModelAction(
            event: Event::tryFrom($result->event),
            content: $result->output,
            executeAppEvent: $result->executeAppEvent,
            response: $result->response
        );
    }

}