<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Depends;
use worlddevs\uptimerobot\Environment;
use worlddevs\uptimerobot\Service\TagService;

final class TagTest extends TestCase {
    protected function setUp(): void {
        \Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();
        Environment::configure($_ENV['ENDPOINT'], $_ENV['API_KEY']);
    }

    public function testSearchTags(): array {
        $result = TagService::search();
        $data = [];

        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        
        // @todo iterate with cursor,  if !empty
        $data = $result['data'];

        return $data;
    }

    #[Depends('testSearchTags')]
    public function testDeleteTag(array $data): void {
        $this->assertIsArray($data);
    }
}