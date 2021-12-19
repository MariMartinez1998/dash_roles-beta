<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $blogs = 'blogs';
    protected $auto = 'automovil';
    protected $message = 'message';
    protected $mess_user_serv = 'message_user_servicio';

    public function scopeGetListaservicios($query, $id)
    {
        return $query->select($this->table . '.id',$this->table .'.name', $this->table . '.last_name', $this->table . '.email', $this->table . '.city',
            $this->auto . '.*', $this->blogs . '.*', $this->blogs . '.id as id_servicio')
            ->join($this->auto, $this->auto . '.id_user', '=', $this->table . '.id')
            ->join($this->blogs, $this->blogs . '.id_plate', '=', $this->auto . '.plate')
            ->where($this->table . '.id', $id)
            ->get();
    }

    public function scopeGetServiciosDetalles($query, $id, $idservicio)
    {
        return $query->select($this->table . '.id as id_usuario', $this->table . '.name', $this->table . '.last_name', $this->table . '.email', 
            $this->table . '.city', $this->table . '.state', $this->table . '.phone',
            $this->blogs . '.*', $this->auto . '.*')
            ->join($this->auto, $this->auto . '.id_user', '=', $this->table . '.id')
            ->join($this->blogs, $this->blogs . '.id_plate', '=', $this->auto . '.plate')
            ->where($this->table . '.id', $id)
            ->where($this->blogs . '.id', $idservicio)
            ->get();
    }

    public function scopeGetMesages($query, $id, $idservicio)
    {
        return $query->select($this->table . '.name', $this->table . '.last_name', $this->message . '.*')
            ->join($this->mess_user_serv, $this->mess_user_serv . '.id_user', '=', $this->table . '.id')
            ->join($this->blogs, $this->blogs . '.id', '=', $this->mess_user_serv . '.id_servicio')
            ->join($this->message, $this->message . '.id', '=', $this->mess_user_serv . '.id_message')
            ->where($this->table . '.id', $id)
            ->where($this->blogs . '.id', $idservicio)
            ->get();
    }
}

