<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Filter;
use Mvc5\Test\Test\TestCase;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $filter = new Filter(['foo'], ['bar'], ['baz'], 'foobar');

        $this->assertEquals(['foo'],  $filter->config());
        $this->assertEquals(['bar'],  $filter->filter());
        $this->assertEquals(['baz'],  $filter->args());
        $this->assertEquals('foobar', $filter->param());
    }
}
