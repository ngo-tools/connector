<?php

return [
    'marketplace-app-model' => env('MARKETPLACE_APP_MODEL', \NgoTools\Connector\Models\MarketplaceApp::class),
    'cookies' => [
        'duration' => [
            \NgoTools\Connector\Enums\Cookie::KomootEmbedding->name => 168 * 24 * 60, // 6 months
            \NgoTools\Connector\Enums\Cookie::ReliveEmbedding->name => 168 * 24 * 60, // 6 months
        ]
    ]
];
