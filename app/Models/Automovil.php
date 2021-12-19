<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automovil extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'vin',
        'model',
        'make',
        'color',
        'year'
    ];

    protected $table = 'automovil';
}
