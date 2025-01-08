@props(['cookie'])

@if(\Whitecube\LaravelCookieConsent\Facades\Cookies::hasConsentFor($cookie->getName()))
    {{ $slot }}
@else
    <div>
        {{ __('connector::cookies.messages.consent-needed') }}
    </div>
    <div class="flex justify-start gap-2">
        {{ __('connector::cookies.messages.manage-cookies-label') }}
        @cookieconsentbutton(action: 'reset', label: __('connector::cookies.messages.manage-cookies'))
    </div>

@endif
