<?php

namespace NgoTools\Connector\Livewire;

use App\Livewire\Segments\BaseSegment;
use NgoTools\Connector\Facades\Connector;

if(class_exists(BaseSegment::class)) {
    class Segment extends BaseSegment
    {
        protected function getTranslationRootPath()
        {
            return Connector::appKey() . '::segments';
        }
    }
}
else {
    class Segment
    {
        protected function getTranslationRootPath()
        {
            return Connector::appKey() . '::segments';
        }
    }
}

