<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'contenido', 'image','id_plate'];

    //relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(user::class, 'plate', 'id_plate');
    }

    public function scopePdf($query, $plate) {
    	if ($plate) {
    		return $query->where('id_plate','like',"%$plate%");
    	}
    }
}
