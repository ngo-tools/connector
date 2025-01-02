<?php

namespace NgoTools\Connector\Models;

class MarketplaceApp
{
    public static function byNamespace($namespace)
    {
        return new self;
    }

    public function isActivated()
    {
        return true;
    }
}
