<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $keyType = 'string';

    protected $fillable = ['status', 'description', 'user_id', 'lesson_id'];
}
