<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GeminiService;
use App\Services\ContextService;
use App\Services\ChatbotCommandHandler;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function __construct(
        private GeminiService $gemini,
        private ContextService $context,
        private ChatbotCommandHandler $handler
    ) {}

    public function handleMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $request->input('message');
        $context = $this->context->get();

        $aiResponse = $this->gemini->generate($context, $message);
        $result = $this->handler->handle($aiResponse, auth()->id());

        return response()->json($result);
    }
}
