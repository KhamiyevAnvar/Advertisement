<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement_photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisement_id',
        'photo'
    ];
}
