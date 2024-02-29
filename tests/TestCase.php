<?php

namespace Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use ValidatorDocs\ServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
