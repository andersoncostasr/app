<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    use TenantTrait;
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'available', 'user_id', 'tenant_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
