<?php

namespace Prince\K3p4;

use Prince\K3p4\AbstractNotification;
use Prince\K3p4\Exceptions\MessageExceedsMaxCharactersException;

class SMSNotification extends AbstractNotification
{
    private int $maxLength = 160;

    public function send(string $message): void
    {
        try {
            if (strlen($message) > $this->maxLength) {
                throw new MessageExceedsMaxCharactersException('Длина сообщения больше 160 символов');
            }
            $this->status = "sent";
            print "Отправка SMS: " . $message . PHP_EOL;
        } catch (MessageExceedsMaxCharactersException $e) {
            $this->status = "failed";
            print $e->getMessage() . PHP_EOL;
        }
    }
    public function getType(): string
    {
        return "SMS";
    }
}
