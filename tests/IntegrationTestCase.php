<?php

namespace Flugg\Responder\Tests;

use Flugg\Responder\ResponderServiceProvider;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Orchestra\Testbench\TestCase;

/**
 * Abstract test case for bootstrapping the environment for the integration suite.
 */
abstract class IntegrationTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        Mockery::globalHelpers();
    }

    /**
     * Define environment variables.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }

    /**
     * Get package service providers.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [ResponderServiceProvider::class];
    }
}
