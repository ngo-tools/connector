<?php

return [
    'messages' => [
        'consent-needed' => 'Um diesen Inhalt anzuzeigen, muss dem entsprechenden Cookie zugestimmt werden.',
        'manage-cookies-label' => 'Hier können die Cookies verwaltet werden:',
        'manage-cookies' => 'Cookies verwalten',
    ],

    \NgoTools\Connector\Enums\Cookie::KomootEmbedding->name => [
        'name' => 'Komoot',
        'description' => 'Ermöglicht das Anzeigen von Inhalten von Komoot. Diese Inhalte werden von Komoot geladen. Dabei können Cookies gesetzt werden, auf die wir keinen Einfluss haben. Bitte stimmen Sie zu, um die Inhalte zu sehen.'
    ],
    \NgoTools\Connector\Enums\Cookie::ReliveEmbedding->name => [
        'name' => 'Relive',
        'description' => 'Ermöglicht das Anzeigen von Inhalten von Relive. Diese Inhalte werden von Relive geladen. Dabei können Cookies gesetzt werden, auf die wir keinen Einfluss haben. Bitte stimmen Sie zu, um die Inhalte zu sehen.'
    ],
    \NgoTools\Connector\Enums\Cookie::OpenStreetMap->name => [
        'name' => 'OpenStreetMap',
        'description' => 'Ermöglicht das Anzeigen von Inhalten von OpenStreetMap. Diese Inhalte werden von OpenStreetMap geladen. Dabei können Cookies gesetzt werden, auf die wir keinen Einfluss haben. Bitte stimmen Sie zu, um die Inhalte zu sehen.'
    ],
];
