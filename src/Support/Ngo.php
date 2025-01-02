<?php

namespace NgoTools\Connector\Support;

class Ngo
{
    public function app($namespace)
    {
        $marketplaceAppModel = config('connector.marketplace-app-model');

        return $marketplaceAppModel::byNamespace($namespace);
    }
}
