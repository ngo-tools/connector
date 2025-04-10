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
    function tenantRoute($name, $parameters = [], $absolute = true, $skipAuthenticationCheck = false)
    {
        if(!$skipAuthenticationCheck) {
            $controller = Route::getRoutes()->getByName($name)->getController();

            if(!$controller::canAccess()) {
                return null;
            }

            if(filled($controller::getResource()) && !$controller::getResource()::canAccess()) {
                return null;
            }
        }

        // Helper for the case that we only have one parameter - we assume "record"
        if(!is_array($parameters)) {
            $parameters = ['record' => $parameters];
        }

        $parameters['tenant'] = Filament::getTenant() ?? 'app';
        return route($name, $parameters, $absolute);
    }
}
