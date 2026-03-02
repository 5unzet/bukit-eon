<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        // skip all tests if sqlite driver is not installed on this machine
        if (!extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('PDO SQLite extension is not available.');
        }

        parent::setUp();
    }
}
