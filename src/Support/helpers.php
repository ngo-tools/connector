<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use NgoTools\Connector\Support\Ngo;

if (! function_exists('ngo')) {
    function ngo() : Ngo
    {
        return new Ngo();
    }
}

if (! function_exists('tenantRoute')) {
    /**
     * Return the route if it is accessible for the user, otherwise return null.
     * @param mixed $parameters Can be an array, an object or null.
     * The null value is to simplify this common pattern:
     *     ->url(fn($record) => $record->contact? tenantRoute('...', $record->contact) : null),
     * into
     *     ->url(fn($record) => tenantRoute('...', $record->contact))
     */
    function tenantRoute($name, $parameters = [], $absolute = true, $skipAuthenticationCheck = false): ?string
    {
        if ($parameters === null) {
            return null;
        }

        if(!$skipAuthenticationCheck && !canAccessRoute($name)) {
            return null;
        }

        // Helper for the case that we only have one parameter - we assume "record"
        if(!is_array($parameters)) {
            $parameters = ['record' => $parameters];
        }

        $parameters['tenant'] = Filament::getTenant() ?? 'app';
        return route($name, $parameters, $absolute);
    }
}

if (! function_exists('canAccessRoute')) {
    function canAccessRoute($name): bool
    {
        $controller = Route::getRoutes()->getByName($name)->getController();

        if(!$controller::canAccess()) {
            return false;
        }

        if(method_exists($controller, 'getResource') && filled($controller::getResource()) && !$controller::getResource()::canAccess()) {
            return false;
        }

        return true;
    }
}

if (! function_exists('tenant')) {
    function tenant(): \NgoTools\Connector\Models\Tenant
    {
        return \NgoTools\Connector\Models\Tenant::current();
    }
}
