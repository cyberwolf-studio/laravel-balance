<?php

namespace Batv45\Balance\Tests;

use Batv45\Balance\BalanceServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Orchestra\Testbench\workbench_path;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    public function getPackageProviders($app): array
    {
        return [
            BalanceServiceProvider::class
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom([
            workbench_path('database/migrations'),
        ]);
    }
}
