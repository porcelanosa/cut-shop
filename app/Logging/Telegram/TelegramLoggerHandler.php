<?php

declare(strict_types=1);

namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\FormattedRecord;
use Monolog\Logger;

class TelegramLoggerHandler extends AbstractProcessingHandler
{
    protected int $chat_id;
    protected string $token;

    public function __construct(array $config)
    {
        $this->chat_id = $config['chat_id'];
        $this->token   = $config['token'];
        $level         = Logger::toMonologLevel($config['level']);
        parent::__construct($level);
    }

    /**
     * @return void
     *
     * @param array $record
     */
    protected function write(array $record): void
    {
        TelegramBotApi::sendMessage($this->token, $this->chat_id, $record['formatted']);
    }
}
