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
        
        return view('cliente.vista', compact('blog'));
    }
}
