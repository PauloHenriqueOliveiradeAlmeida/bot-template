<?php

namespace App\Feature\Chat\Entrypoint\Http;

use Illuminate\Support\Facades\Route;

Route::prefix('chat')->group(function () {
    Route::post('webhook/message', [ChatController::class, 'webhook']);
});