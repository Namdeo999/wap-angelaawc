<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    //
    protected $table = 'templates';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
