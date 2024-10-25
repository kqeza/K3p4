<?php

namespace Prince\K3p4;

use DateTimeImmutable;

interface Notification
{
    public function send(string $message): void;
    public function getStatus(): string;
    public function getType(): string;
    public function getTimestamp(): DateTimeImmutable;
}
