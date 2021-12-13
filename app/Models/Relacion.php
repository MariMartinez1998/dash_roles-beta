<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $blogs = 'blogs';

    public function scopeGetListaservicios($query, $id)
    {
        return $query->select($this->table . '.*', $this->blogs . '.*')
            ->join($this->blogs, $this->blogs . '.id_plate', '=', $this->table . '.plate')
            ->where($this->table . '.id', $id)
            ->get();
    }
}
