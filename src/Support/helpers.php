<?php

use Filament\Facades\Filament;
use Illuminate\Support\Arr;
use NgoTools\Connector\Support\Ngo;

if (! function_exists('ngo')) {
    function ngo() : Ngo
    {
        return new Ngo();
    }
}

if (! function_exists('tenantRoute')) {
    function tenantRoute($name, $parameters = [], $absolute = true)
    {
        $parameters = Arr::wrap($parameters);
        array_unshift($parameters, Filament::getTenant());
        return route($name, $parameters, $absolute);
    }
}
