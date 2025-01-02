<?php

namespace NgoTools\Connector\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NgoTools\Connector\Connector
 */
class Connector extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \NgoTools\Connector\Connector::class;
    }
}
