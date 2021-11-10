<?php

declare(strict_types=1);

namespace PhpEnv\Tests;

use PHPUnit\Framework\TestCase;
use PhpEnv\EnvManager;

class EnvManagerTest extends TestCase
{
    public function testParseOk(): void
    {
        $filename = ROOT_DIR . "tests/.env";
        $envs = EnvManager::parse($filename);

        $this->assertArrayHasKey('MIX_PUSHER_APP_CLUSTER', $envs);
        $this->assertSame($envs['MIX_PUSHER_APP_CLUSTER'], '${PUSHER_APP_CLUSTER}');
    }

    public function testSetArray(): void
    {
        $filename = ROOT_DIR . "tests/.env";
        $envs = EnvManager::parse($filename);

        EnvManager::setArray($envs);

        $this->assertSame(EnvManager::get('PUSHER_APP_CLUSTER'), EnvManager::get('MIX_PUSHER_APP_CLUSTER'));
    }
}