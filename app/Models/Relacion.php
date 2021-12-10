<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    use HasFactory;

    protected $table = '';
    protected $table1 = '';
    protected $table2 = '';
    
    public function scopeGetListaservicios(){
        return $query->select(
            $this->table_areas . '.nombre',
            $this->tabla . '.name as user',
        )
            ->join($this->table_area_user, 'users.plate', '=', $this->table_area_user . '.id_plate')
            ->join($this->table_areas, $this->table_areas . '.id', '=', $this->table_area_user . '.id_area')
            ->get();
    }

}
