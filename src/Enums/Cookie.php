<?php

namespace NgoTools\Connector\Enums;

enum Cookie
{
    case KomootEmbedding;
    case ReliveEmbedding;
    case OpenStreetMap;

    public function getName()
    {
        return __('connector::cookies.' . $this->name . '.name');
    }

    public function getDescription()
    {
        return __('connector::cookies.' . $this->name . '.description');
    }

    public function getDuration()
    {
        return config('connector.cookies.duration.' . $this->name);
    }
}
