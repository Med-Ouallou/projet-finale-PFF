<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    public function generate(array $context, string $message): array
    {
        $systemPrompt = <<<PROMPT
You are a restaurant admin AI assistant.

Your job is to analyze the user's request and decide whether they want to:
1. Create a menu (e.g. Main Menu, Kids Menu, Drinks Menu, etc.)
2. Create a category
3. Create a menu item
4. Toggle menu item status/stock availability (available/unavailable)
5. Update or cancel an order status
6. Request a business intelligence report (revenue today, top sellers, out-of-stock items)
7. Receive a normal conversational reply

Return ONLY valid JSON.

Schema:
{
  "action": "create_menu | create_category | create_menu_item | update_item_status | update_order_status | get_business_report | respond_user",
  "data": {},
  "message": ""
}

Rules:
- Never return markdown.
- Never wrap JSON inside code blocks.
- Never invent database IDs. Use menu_name, category_name, or item_name instead of IDs.
- For orders, match by ID if explicitly provided in context, or look up recent orders.
- If information is missing or unclear, use action="respond_user" and ask for details.

Action Details:

- For create_menu:
{
  "action": "create_menu",
  "data": {
      "name": "Menu name",
      "description": "Optional description"
  },
  "message": ""
}

- For create_category:
{
  "action": "create_category",
  "data": {
      "name": "Category name",
      "menu_name": "Menu name",
      "description": "Optional description"
  },
  "message": ""
}

- For create_menu_item:
{
  "action": "create_menu_item",
  "data": {
      "name": "Item name",
      "category_name": "Category name",
      "price": 45,
      "description": "Optional description",
      "status": "available"
  },
  "message": ""
}

- For update_item_status (stock availability toggle):
{
  "action": "update_item_status",
  "data": {
      "item_name": "Item name to toggle",
      "status": "available | unavailable"
  },
  "message": ""
}

- For update_order_status (changing order state, like cancelling or finishing):
{
  "action": "update_order_status",
  "data": {
      "order_id": 12,
      "status": "pending | preparing | ready | delivered | cancelled"
  },
  "message": ""
}

- For get_business_report (today's stats, top items, stock warnings):
{
  "action": "get_business_report",
  "data": {
      "metric": "revenue | top_sellers | out_of_stock"
  },
  "message": ""
}

- For respond_user (regular conversation or clarifying):
{
  "action": "respond_user",
  "data": {},
  "message": "Conversational reply in French/English"
}
PROMPT;

        $body = [
            "contents" => [
                [
                    "parts" => [
                        [
                            "text" => $systemPrompt
                        ],
                        [
                            "text" => "Existing restaurant data (Context):\n" . json_encode(
                                $context,
                                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                            )
                        ],
                        [
                            "text" => "User message:\n" . $message
                        ]
                    ]
                ]
            ],
            "generationConfig" => [
                "responseMimeType" => "application/json",
                "temperature" => 0.1,
            ]
        ];

        $apiKey = config('services.gemini.key');
        $model = config('services.gemini.model', 'gemini-2.5-flash');

        if (!$apiKey) {
            return [
                'action' => 'respond_user',
                'data' => [],
                'message' => 'Gemini API key is not configured.'
            ];
        }

        try {
            $response = Http::withoutVerifying()
                ->timeout(30)
                ->acceptJson()
                ->post(
                    "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}",
                    $body
                );

            if ($response->failed()) {
                Log::error('Gemini API Error', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return [
                    'action' => 'respond_user',
                    'data' => [],
                    'message' => 'Unable to communicate with the AI service.'
                ];
            }

            $result = $response->json();
            $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? '{}';

            Log::info('Gemini Raw Response', [
                'response' => $text
            ]);

            $decoded = json_decode($text, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Invalid Gemini JSON', [
                    'json_error' => json_last_error_msg(),
                    'response' => $text
                ]);

                return [
                    'action' => 'respond_user',
                    'data' => [],
                    'message' => 'AI returned an invalid response.'
                ];
            }

            return $decoded;

        } catch (\Throwable $e) {
            Log::error('Gemini Service Exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return [
                'action' => 'respond_user',
                'data' => [],
                'message' => 'An unexpected error occurred.'
            ];
        }
    }
}
