<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use Exception;
use Throwable;
use App\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    /**
     * @throws \App\Exceptions\TelegramBotApiException
     */
    public static function sendMessage(string $token, int $chat_id, string $message): bool
    {
        try {
            $response = Http::get(self::HOST.$token.'/sendMessage', [
                'chat_id' => $chat_id,
                'text'    => $message,
            ])->throw()->json();

            return $response['ok'] ?? false;
        } catch (Throwable $exception) {
//            throw new TelegramBotApiException($exception->getMessage());
            report(new TelegramBotApiException($exception->getMessage()));

            return false;
        }
    }
}
