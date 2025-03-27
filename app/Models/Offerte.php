<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offerte extends Model
{
    protected $fillable = [
        'dienst', 'first_name', 'last_name', 'email', 'phone',
    ];
}
