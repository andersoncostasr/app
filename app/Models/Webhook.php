<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    use UuidTrait;
    use TenantTrait;
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = ['type', 'name', 'token', 'offer', 'available'];

    public $incrementing = false;
}
