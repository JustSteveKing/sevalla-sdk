<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Saloon\Config;
use Saloon\MockConfig;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Config::preventStrayRequests();
        MockConfig::throwOnMissingFixtures();
    }
}
