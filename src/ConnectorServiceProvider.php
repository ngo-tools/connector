<?php

namespace NgoTools\Connector;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use NgoTools\Connector\Commands\ConnectorCommand;

class ConnectorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('connector')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_connector_table')
            ->hasCommand(ConnectorCommand::class);
    }
}
