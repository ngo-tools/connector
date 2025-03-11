<?php

namespace NgoTools\Connector\Enums;

enum NavigationGroup
{
    case Communication;
    case Donations;
    case Finance;
    case General;
    case Projects;
    case Contacts;
    case Website;
    case Knowledge;
    case Fundraising;
    case Miscellaneous;
    case Events;

    public function translatedString()
    {
        return __('connector::navigation-groups.' . $this->name . '.label');
    }
}
