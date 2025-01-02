<?php

namespace NgoTools\Connector\Filament;

use Illuminate\Contracts\Support\Htmlable;
use ReflectionClass;

abstract class Resource extends \Filament\Resources\Resource
{
    public final static function canAccess(): bool
    {
        $namespace = implode('\\', array_slice(explode('\\', (new ReflectionClass(static::class))->getNamespaceName()), 0, 2));

        // check if app is active
        
        dd($namespace);

        return static::hasAccess();
    }

    public static function hasAccess(): bool
    {
        return parent::canAccess();
    }

    public final static function getNavigationIcon(): string|Htmlable|null
    {
        return '';
    }
}
