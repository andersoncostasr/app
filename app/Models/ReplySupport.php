<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $keyType = 'string';

    protected $fillable = ['support_id', 'user_id', 'description'];
}
