<?php

namespace NgoTools\Connector\Traits;

use Illuminate\Support\Str;
use NgoTools\Connector\Facades\Connector;

trait TranslatedEnum
{
    public function getLabel(): ?string
    {
        return __(Connector::appKey() . '::enums.' . Str::kebab((new \ReflectionEnum($this))->getShortName()) . '.labels.' . $this->value);
    }
}
