<?php

namespace NgoTools\Connector\Filament;

abstract class Resource extends \Filament\Resources\Resource
{
    public final static function canAccess(): bool
    {
        return static::hasAccess();
    }

    public static function hasAccess(): bool
    {
        return parent::canAccess();
    }
}
