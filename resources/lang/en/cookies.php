<?php

return [
    'messages' => [
        'consent-needed' => 'To display this content, you must consent to the corresponding cookie.',
        'manage-cookies-label' => 'You can manage the cookies here:',
        'manage-cookies' => 'Manage cookies',
    ],

    \NgoTools\Connector\Enums\Cookie::KomootEmbedding->name => [
        'name' => 'Komoot',
        'description' => 'Allows displaying content from Komoot. This content is loaded from Komoot. Cookies may be set over which we have no control. Please consent to view the content.',
    ],
    \NgoTools\Connector\Enums\Cookie::ReliveEmbedding->name => [
        'name' => 'Relive',
        'description' => 'Allows displaying content from Relive. This content is loaded from Relive. Cookies may be set over which we have no control. Please consent to view the content.',
    ],
    \NgoTools\Connector\Enums\Cookie::OpenStreetMap->name => [
        'name' => 'OpenStreetMap',
        'description' => 'Allows displaying content from OpenStreetMap. This content is loaded from OpenStreetMap. Cookies may be set over which we have no control. Please consent to view the content.',
    ],
];
