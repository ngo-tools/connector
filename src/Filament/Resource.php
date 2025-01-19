<?php

namespace NgoTools\Connector\Filament;

use Filament\Facades\Filament;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        return ngo()->app(self::getAppNamespace())
            ->getNavigationGroup();
    }

    public static function getNavigationSort(): ?int
    {
        return ngo()->app(self::getAppNamespace())
            ->getNavigationSort();
    }

    public final static function getNavigationIcon(): string|Htmlable|null
    {
        return '';
    }

    public static function hasAccess(): bool
    {
        return parent::canAccess();
    }

    public final static function getAppNamespace()
    {
        return implode('\\', array_slice(explode('\\', (new ReflectionClass(static::class))->getNamespaceName()), 0, 2));
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()
            ->where(function (Builder $query) {
                $query->where('team_id', Filament::getTenant()->id)
                    ->orWhereNull('team_id');
            });
    }

    public static function getTenantRelationship(Model $tenant): Relation
    {
        return $tenant->hasMany(static::$model);
    }
}
