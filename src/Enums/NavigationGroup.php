<?php

namespace NgoTools\Connector\Enums;

enum NavigationGroup: string
{
    case Communication = 'Communication';
    case Donations = 'Donations';
    case Finance = 'Finance';
    case General = 'General';
    case Projects = 'Projects';
    case Contacts = 'Contacts';
    case Website = 'Website';
    case Knowledge = 'Knowledge';
    case Fundraising = 'Fundraising';
    case Miscellaneous = 'Miscellaneous';
    case Events = 'Events';
    case Resources = 'Resources';

    public function translatedString()
    {
        return __('connector::navigation-groups.' . $this->name . '.label');
    }
}
