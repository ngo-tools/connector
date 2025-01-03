<?php

namespace NgoTools\Connector;

use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use NgoTools\TourManager\Testing\TestsTourManager;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use NgoTools\Connector\Commands\ConnectorCommand;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Livewire\Features\SupportTesting\Testable;

class MarketplaceAppServiceProvider extends PackageServiceProvider
{
    public static string $name = 'tour-manager';

    public static string $viewNamespace = 'tour-manager';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile();
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/tour-manager/{$file->getFilename()}"),
                ], 'tour-manager-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsTourManager);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'ngo-tools/tour-manager';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('tour-manager', __DIR__ . '/../resources/dist/components/tour-manager.js'),
            // Css::make('tour-manager-styles', __DIR__ . '/../resources/dist/tour-manager.css'),
            // Js::make('tour-manager-scripts', __DIR__ . '/../resources/dist/tour-manager.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            // TourManagerCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    public function getMigrationsPath()
    {
        $path = 'database/migrations';
        $reflector = new \ReflectionClass($this);

        return dirname(__DIR__);

        return $this->package->basePath("/../{$path}");
    }
}
