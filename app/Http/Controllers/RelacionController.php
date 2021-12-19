<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\User;
use App\Models\Relacion;


class RelacionController extends Controller
{
    //
    public function index(){

        // $sql = 'SELECT * FROM users inner JOIN blogs ON blogs.id_users = users.id where users.id='.auth()->user()->id;

        // $blog = DB::select($sql);

        $blog = Relacion::GetListaservicios(auth()->user()->id);
        //return $blog;
        return view('cliente.vista', compact('blog'));
    }

    public function show($id)
    {
        $blog = Relacion::GetServiciosDetalles(auth()->user()->id, $id);
        $message = Relacion::GetMesages(auth()->user()->id, $id);
        //return $message;
        return view('cliente.seguimiento', compact('blog'), compact('message'));
    }
}
