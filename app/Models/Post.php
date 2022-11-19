<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use UuidTrait;
    use TenantTrait;
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = ['title', 'body', 'user_id', 'image'];

    public $incrementing = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
