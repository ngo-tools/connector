<?php

namespace NgoTools\Connector;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use NgoTools\Connector\Commands\ConnectorCommand;
use Whitecube\LaravelCookieConsent\CookiesManager;
use Whitecube\LaravelCookieConsent\Facades\Cookies;

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
            ->hasTranslations();
    }
}
