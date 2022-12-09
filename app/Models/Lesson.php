<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use UuidTrait;
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = ['module_id', 'name', 'url', 'video', 'description', 'image'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
