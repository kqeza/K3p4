<?php

use PHPUnit\Framework\TestCase;
use Prince\K3p4\EmailNotification;
use Prince\K3p4\NotificationManager;
use Prince\K3p4\SMSNotification;
use Prince\K3p4\Notification;

class NotificationManagerTest extends TestCase
{
    public function testSendNotificationSuccessfully()
    {
        $SMSnotification = new SMSNotification();
        $manager = new NotificationManager();
        $manager->sendNotification($SMSnotification, 'Deaf Bonce');

        $history = $manager->getNotificationHistory();
        $this->assertCount(1, $history);
        $this->assertEquals('sent', $history[0]['status']);

        $logContent = file_get_contents('log.txt');
        $this->assertStringContainsString('Отправилось со статусом:sent', $logContent);
    }
    public function testSendNotificationWithException()
    {
        $EmailNotification = new EmailNotification();

        $manager = new NotificationManager();
        $manager->sendNotification($EmailNotification, 'Test massage');

        // Проверка истории уведомлений
        $history = $manager->getNotificationHistory();
        $this->assertCount(1, $history);
        $this->assertEquals('failed', $history[0]['status']);

        // Проверка лог-файла
        $logContent = file_get_contents('log.txt');
        $this->assertStringContainsString('Ошибка:Тема не выбрана', $logContent);
    }
}
