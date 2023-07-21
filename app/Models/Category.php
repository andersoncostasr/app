<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use UuidTrait;
    use TenantTrait;

    protected $table = 'categories';

    protected $keyType = 'string';

    protected $fillable = ['name', 'description', 'tenant_id', 'user_id'];

    public $incrementing = false;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
