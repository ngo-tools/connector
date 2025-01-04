<?php

namespace NgoTools\Connector;

use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Livewire;
use NgoTools\Connector\Livewire\Segment;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use NgoTools\Connector\Facades\Connector;

class MarketplaceAppServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$key)
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
            $package->hasViews(static::$key);
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

        $this->registerLivewireComponents();
    }

    protected function getAssetPackageName(): ?string
    {
        return Connector::namespaceToKey((new \ReflectionClass($this))->getNamespaceName(), '/');
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
        return [];
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

    protected function registerLivewireComponents()
    {
        foreach(File::allFiles($this->package->basePath('Segments')) as $file) {
            [$category, $segment] = explode('/', Str::of($file->getPathname())->after('Segments/')->beforeLast('.php'));
            $segmentClassName = (new \ReflectionClass($this))->getNamespaceName() . '\\Segments\\' . $category . '\\' . $segment;

            if(is_subclass_of($segmentClassName, Segment::class)) {
                $key = Connector::namespaceToKey($segmentClassName);
                Livewire::component($key, $segmentClassName);
            }
        }
    }

    public function getResources()
    {
        return $this->getFilamentStuff('Resources');
    }

    public function getPages()
    {
        return $this->getFilamentStuff('Pages');
    }

    private function getFilamentStuff($type)
    {
        $namespace = (new \ReflectionClass($this))->getNamespaceName();

        return collect(File::files($this->package->basePath($type)))
            ->map(fn($file) => $namespace . '\\' . $type . '\\' . Str::before($file->getFilename(), '.php'));
    }

    public function getMigrationsPath()
    {
        $path = 'database/migrations';

        return $this->package->basePath("/../{$path}");
    }
}
