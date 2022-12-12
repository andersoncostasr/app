<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attacchment extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $keyType = 'string';

    protected $fillable = ['lesson_id', 'name', 'path'];

    public $incrementing = false;

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
