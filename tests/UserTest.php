<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Depends;
use worlddevs\uptimerobot\Environment;
use worlddevs\uptimerobot\Service\UserService;

final class UserTest extends TestCase {
    protected function setUp(): void {
        \Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();
        Environment::configure($_ENV['ENDPOINT'], $_ENV['API_KEY']);
    }

    public function testGetCurrentUser(): void {
        $result = UserService::retrieve();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('email', $result);
        $this->assertArrayHasKey('activeSubscription', $result);
    }

    public function testGetAlertContacts(): void {
        $result = UserService::alertContacts();

        $this->assertIsArray($result);

        foreach($result as $alert) {
            $this->assertIsArray($alert);
            $this->assertArrayHasKey('id', $alert);
        }
    }

    public function testGetAllAlerts(): void {
        $result = UserService::allAlertContacts();

        $this->assertIsArray($result);

        foreach($result as $contact) {
            $this->assertIsArray($contact);
            $this->assertArrayHasKey('user', $contact);
        }
    }
}