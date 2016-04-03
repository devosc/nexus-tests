<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Resolver as Base;

class Resolver
{
    /**
     *
     */
    use Base {
        args       as public;
        arguments  as public;
        build      as public;
        //callable   as public;
        callback   as public;
        child      as public;
        combine    as public;
        compose    as public;
        composite  as public;
        create     as public;
        event      as public;
        filter     as public;
        filterable as public;
        first      as public;
        gem        as public;
        hydrate    as public;
        invokable  as public;
        invoke     as public;
        listener   as public;
        make       as public;
        merge      as public;
        parent     as public;
        provide    as public;
        relay      as public;
        repeat     as public;
        resolvable as public;
        resolve    as public;
        resolver   as public;
        solve      as public;
        transmit   as public;
        unique     as public;
        variadic   as public;
    }

    /**
     * @param array|callable|object|string $config
     * @return callable|null
     */
    public function callableMethod($config) : callable
    {
        return $this->callable($config);
    }
}