<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory, UuidTrait;

    protected $keyType = 'string';

    protected $fillable = ['subdomain', 'name', 'cnpj', 'logo'];

    // public $incrementing = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
