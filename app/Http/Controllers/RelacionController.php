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

<<<<<<< HEAD
        // $sql = 'SELECT * FROM users inner JOIN blogs ON blogs.id_users = users.id where users.id='.auth()->user()->id;
=======
        $sql = 'SELECT * FROM users JOIN blogs ON blogs.id_plate = users.plate where users.id='.auth()->user()->id;
       
        $blog = DB::select($sql);
>>>>>>> 770a5bf6806f76abf0e8d98cfa37a007cb6e8d7e

        // $blog = DB::select($sql);

        $blog = Relacion::GetListaservicios(auth()->user()->id);
        
        return view('cliente.vista', compact('blog'));
    }
}
