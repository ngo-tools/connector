<?php

namespace NgoTools\Connector\Livewire;

use App\Livewire\Segments\BaseSegment;
use NgoTools\Connector\Facades\Connector;

class Segment extends BaseSegment
{
    protected function getTranslationRootPath()
    {
        return Connector::appKey() . '::segments';
    }
}
