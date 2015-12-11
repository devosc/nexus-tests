<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Factory;
use Mvc5\Test\Test\TestCase;

class FactoryTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Factory::class, new Factory('foo'));
    }
}