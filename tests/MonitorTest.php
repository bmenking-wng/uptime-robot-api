<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Depends;
use worlddevs\uptimerobot\Environment;
use worlddevs\uptimerobot\Service\MonitorService;

final class MonitorTest extends TestCase {
    protected function setUp(): void {
        \Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();
        Environment::configure($_ENV['ENDPOINT'], $_ENV['API_KEY']);
    }

    public function testListMonitors(): int {
        $result = MonitorService::search();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('nextLink', $result);
        $this->assertArrayHasKey('data', $result);
        $this->assertGreaterThan(0, count($result['data']));

        return $result['data'][0]['id'];
    }

    #[Depends('testListMonitors')]
    public function testGetMonitorById(int $id): void {
        $this->assertIsInt($id);

        $result = MonitorService::retrieve($id);

        $this->assertIsArray($result);
    }
}