<?php

namespace NgoTools\Connector\Filament;

use Illuminate\Contracts\Support\Htmlable;
use NgoTools\Connector\Models\MarketplaceApp;
use ReflectionClass;

abstract class Resource extends \Filament\Resources\Resource
{
    public final static function canAccess(): bool
    {
        if(!ngo()->app(self::getAppNamespace())->isActivated()) {
            return false;
        }

        return static::hasAccess();
    }

    public final static function getNavigationGroup(): ?string
    {
        return __('donations.donations.navigation-group');
    }

    public static function hasAccess(): bool
    {
        return parent::canAccess();
    }

    public final static function getNavigationIcon(): string|Htmlable|null
    {
        return '';
    }

    public final static function getAppNamespace()
    {
        return implode('\\', array_slice(explode('\\', (new ReflectionClass(static::class))->getNamespaceName()), 0, 2));
    }
}
