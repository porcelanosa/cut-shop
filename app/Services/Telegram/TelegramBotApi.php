<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use App\Exceptions\TelegramException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    public static function sendMessage(string $token, int $chat_id, string $message): bool
    {
        try {
            $response = Http::get(self::HOST . $token . '/sendMessage', [
                'chat_id' => $chat_id,
                'text'    => $message
            ]);
            if ($response->status() === Response::HTTP_OK){
                return true;
            }

            return false;
        } catch (TelegramException $exception) {

        }
        return false;
    }
}
