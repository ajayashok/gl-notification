<?php

namespace GlPackage\NotificationManager\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    protected $vendorId;
    protected $apiUrl;
    protected $engine;

    //create custructor
    public function __construct(){
        $this->vendorId = auth()?->user()?->id;
        $this->apiUrl = 'https://api.telegram.org/bot';
        $this->engine = 'telegram';
    }

    public function sendMessage($telegramConfig,$telegramData)
    {
        if ($telegramConfig) {
            // Telegram API endpoint for sending messages
            $url = $this->apiUrl."{$telegramConfig->token}/sendMessage";

            // Send the message
            $data = [
                'chat_id' => $telegramConfig->chat_id,
                'text' => $telegramData['message'],
                'parse_mode' => 'HTML'
            ];
    
            if (!empty($telegramData['buttons'])) {
                $data['reply_markup'] = json_encode([
                    'inline_keyboard' => $telegramData['buttons']
                ]);
            }

            try {
                $response = Http::post($url, $data);
            } catch (\Throwable $th) {
                throw new \Exception('Failed to send Telegram message.');
            }

            if ($response->successful()) {
                return true;
            } else {
                throw new \Exception('Failed to send Telegram message.');
            }
        } else {
            throw new \Exception('Telegram configuration not found for vendor.');
        }
    }

}
