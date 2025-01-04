<?php

namespace NgoTools\Connector\Models;

use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use UsesTenantConnection;
}
