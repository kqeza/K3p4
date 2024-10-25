<?php

use PHPUnit\Framework\TestCase;
use Prince\K3p4\EmailNotification;
use Prince\K3p4\Exceptions\ThemeIsNotSelectedException;

class EmailNotificationTest extends TestCase
{
    public function testSendMessage()
    {
        $email = new EmailNotification();
        $email->setTheme('Bonce');
        $email->send('Deaf Bonce');
        $this->assertEquals('sent', $email->getStatus());
    }
    public function testThemeIsNotSelectedExceptions()
    {
        $this->expectException(ThemeIsNotSelectedException::class);
        $email = new EmailNotification();
        $email->send('Deaf Bonce');
    }
}
