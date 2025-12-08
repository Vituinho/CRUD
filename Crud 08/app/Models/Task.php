<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status'];
    protected $casts = [
        'status' => 'boolean'
    ];
    /*faz com que sempre status seja boolean*/
}
