<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    use TenantTrait;
    use HasFactory;
    use UuidTrait;

    protected $keyType = 'string';


    protected $fillable = ['name', 'description', 'image', 'available', 'user_id', 'tenant_id', 'category_id'];

    public $incrementing = false;


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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
