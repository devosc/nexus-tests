<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Config;
use Mvc5\Plugin\Filter;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    public function test_filter()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['callable', 'filter', 'filterTest', 'invoke', 'signal']);

        $this->assertEquals('foo', $mock->filterTest(null, [function() { return 'foo'; }]));
    }

    /**
     *
     */
    public function test_filter_named_param()
    {
        $app = new App([
            Arg::SERVICES => [
                'bar' => function() {
                    return 'bar';
                }
            ]
        ]);

        $filters = [
            function($foo, $o) {
                return $foo . $o;
            },

            new class() {
                function __invoke($foo)
                {
                    return $foo;
                }
            },

            Model\Filterable::class,

            function($foo, $baz, $bar) {
                return $foo . $bar . $baz;
            }
        ];

        $plugin = new Filter('fo', $filters, ['o' => 'o'], 'foo');

        $this->assertEquals('foobars', $app->plugin($plugin, ['baz' => 's']));
    }

    /**
     *
     */
    public function test_filter_merge_param()
    {
        $app = new App([
            Arg::SERVICES => [
                'bar' => function() {
                    return 'bar';
                }
            ]
        ]);

        $filters = [
            function($foo) {
                return $foo;
            },

            new class() {
                function __invoke($foo)
                {
                    return $foo;
                }
            },

            Model\Filterable::class,

            function($foo, $baz, $bar) {
                return $foo . $bar . $baz;
            }
        ];

        $plugin = new Filter('foo', $filters, ['bar']);

        $this->assertEquals('foobars', $app->plugin($plugin, ['s']));
    }

    /**
     *
     */
    public function test_filter_false()
    {
        $app = new App([
            Arg::SERVICES => [
                'bar' => function() {
                    return 'bar';
                }
            ]
        ]);

        $filters = [
            function($foo) {
                return $foo;
            },

            new class() {
                function __invoke($foo)
                {
                    return $foo;
                }
            },

            Model\Filterable::class,

            function($foo, $baz) {
                return $foo . $baz;
            },

            function() {
              return false;
            },

            function($foo, $baz, $bar) {
                return $foo . $bar;
            }
        ];

        $plugin = new Filter('foo', $filters, ['bar']);

        $this->assertEquals('foos', $app->plugin($plugin, ['s']));
    }

    /**
     *
     */
    public function test_filter_null()
    {
        $app = new App([
            Arg::SERVICES => [
                'bar' => function() {
                    return 'bar';
                }
            ]
        ]);

        $filters = [
            function($foo) {
                return $foo;
            },

            new class() {
                function __invoke($foo)
                {
                    return $foo;
                }
            },

            Model\Filterable::class,

            function($foo, $baz) {
                return $foo . $baz;
            },

            function() {
                return null;
            },

            function($foo, $baz, $bar) {
                return $foo . $bar;
            }
        ];

        $plugin = new Filter('foo', $filters, ['bar']);

        $this->assertEquals(null, $app->plugin($plugin, ['s']));
    }

    /**
     *
     */
    public function test_filter_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $plugin = new Plugin('Mvc5\Config', [[function($foo) { return $foo; }]]);

        $this->assertEquals('foo', $mock->resolvableTest(new Filter('foo', $plugin)));
    }

    /**
     *
     */
    public function test_filter_args_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $plugin = new Args([function($foo) { return $foo; }]);

        $this->assertEquals('foo', $mock->resolvableTest(new Filter('foo', $plugin)));
    }
}
