<?php

namespace NgoTools\Connector\Filament;

abstract class Resource extends \Filament\Resources\Resource
{
    public final static function canAccess(): bool
    {
        return parent::canAccess();
    }
}
