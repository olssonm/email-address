<?php

namespace Olssonm\EmailAddress\Test;

use PHPUnit\Framework\TestCase as FrameworkTestCase;

abstract class TestCase extends FrameworkTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    // protected function getPackageProviders($app)
    // {
    //     return [
    //         SwishServiceProvider::class
    //     ];
    // }
}
