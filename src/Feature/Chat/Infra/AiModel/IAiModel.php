<?php

namespace App\Feature\Chat\Infra\AiModel;

use App\Feature\Chat\Infra\AiModel\Models\AiModelAction;

interface IAiModel
{
    /**
     * @param string[] $prompts
     */
    public function prompt(array $prompts): AiModelAction;
}