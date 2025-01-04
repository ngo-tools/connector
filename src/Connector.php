<?php

namespace NgoTools\Connector;

use Illuminate\Support\Str;
use ReflectionClass;

class Connector {
    public function getServiceProviderForNamespace($namespace)
    {
        $vendorNamespace = Str::of($namespace)
            ->explode('\\')
            ->slice(0, 2)
            ->implode('\\');

        $providerClass = collect(app()->getLoadedProviders())
            ->keys()
            ->first(fn($provider) => str_starts_with($provider, $vendorNamespace));

        return app()->getProvider($providerClass);
    }

    public function appKey()
    {
        $initiator = collect(debug_backtrace(limit: 10))
            ->first(fn($item) => isset($item['object']) && !$item['object'] instanceof Connector)
            ['object'];

        return $this->getServiceProviderForNamespace((new ReflectionClass($initiator))->getNamespaceName())::$key;
    }

    public function namespaceToKey($namespace, $separator = '.')
    {
        return collect(explode('\\', $namespace))
            ->map(fn($part) => Str::kebab($part))
            ->implode($separator);
    }
}
