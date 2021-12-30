<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mail\WelcomeNewsletter;
use Illuminate\Support\Facades\Mail;

class NotificacionesController extends Controller
{
    //
    public function index()
    {
        $correo = new WelcomeNewsletter;
        Mail::to('mayojose321@gmail.com')->send($correo);
        return "mensaje enviado";
    }
    public function store()
    {
        // $blog = Relacion::GetListaservicios(auth()->user()->id);
        // return view('cliente.vista', compact('blog'));
    }
}
