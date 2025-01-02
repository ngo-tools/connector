<?php

use NgoTools\Connector\Ngo;

if (! function_exists('ngo')) {
    function ngo() : Ngo
    {
        return new Ngo();
    }
}
