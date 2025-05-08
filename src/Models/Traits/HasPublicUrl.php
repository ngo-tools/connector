<?php

namespace NgoTools\Connector\Models\Traits;

use App\Enums\PublicUrlType;
use App\Models\PublicUrl;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPublicUrl
{
    public function publicUrls($includeInactive = false) : MorphMany
    {
        return $this->morphMany(PublicUrl::class, 'model')
            ->where('type', PublicUrlType::Package)
            ->when($includeInactive, fn(Builder $query) => $query->withoutGlobalScope('active'));
    }

    public function getPublicUrl(Carbon $expiresAt = null, $data = [], $version = null) : PublicUrl
    {
        return $this->publicUrls()->firstOrCreate([
            'type' => PublicUrlType::Package,
            'version' => $version,
        ], [
            'expires_at' => $expiresAt,
            'data' => $data,
        ]);
    }

    public function publicUrlIsActive() : bool
    {
        return $this->publicUrls()->exists();
    }

    public function refreshPublicUrl($version = null)
    {
        return $this->getPublicUrl(version: $version)->refreshToken();
    }
}
