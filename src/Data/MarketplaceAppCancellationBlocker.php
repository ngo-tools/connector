<?php

namespace NgoTools\Connector\Data;

use Spatie\LaravelData\Data;

class MarketplaceAppCancellationBlocker extends Data
{
    public function __construct(
       public string $key,
       public string $message,
    ) {}
}
