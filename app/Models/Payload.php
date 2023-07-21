<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payload extends Model
{
    use UuidTrait;
    use HasFactory;

    protected $keyType = 'string';

    protected $casts = [
        'payload' => 'array',
    ];

    protected $fillable = ['tenant_id', 'webhook_id', 'type', 'data'];

    public $incrementing = false;

    public function webhook()
    {
        return $this->belongsTo(Webhook::class);
    }
}
