<?php

use Orchestra\Testbench\TestCase;


class LaravelMddocTest extends TestCase
{
    /**
     * baseServeHost variable
     *
     * @var string
     */
    protected static $baseServeHost = '127.0.0.1';

    /**
     * baseServePort variable
     *
     * @var integer
     */
    protected static $baseServePort = 8000;

    /**
     * setUp function
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
    }
}