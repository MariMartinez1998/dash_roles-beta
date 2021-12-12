<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $blogs = 'blogs';
    
<<<<<<< HEAD
    public function scopeGetListaservicios($query,$id){
        return $query->select($this->table.'.*',$this->blogs.'.*')
            ->join($this->blogs, $this->blogs.'.id_users', '=', $this->table.'.id')
            ->where($this->table.'.id', $id)
=======
    public function scopeGetListaservicios(){
        return $query->select(
            $this->table_areas . '.nombre',
            $this->tabla . '.name as user',
        )
            ->join($this->table_area_user, 'users.plate', '=', $this->table_area_user . '.id_plate')
            ->join($this->table_areas, $this->table_areas . '.id', '=', $this->table_area_user . '.id_area')
>>>>>>> 770a5bf6806f76abf0e8d98cfa37a007cb6e8d7e
            ->get();
    }

}
