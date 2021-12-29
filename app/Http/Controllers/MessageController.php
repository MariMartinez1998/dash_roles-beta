<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageUserServicio;
use App\Models\User;
use App\Models\Relacion;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function index()
    {
        $blog = Relacion::GetListaservicios(auth()->user()->id);
        return view('cliente.vista', compact('blog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string|max:255',
        ]);
        $Message = new Message();
        $Message->mensaje = $request->mensaje;
        $Message->save();
        
        $MessageUserServicio = new MessageUserServicio();
        $MessageUserServicio->id_message = $Message->id;
        $MessageUserServicio->id_servicio = intval($request->id_servicio);
        $MessageUserServicio->id_user = auth()->user()->id;
        $MessageUserServicio->save();

        $user = User::find(auth()->user()->id);

        Message::createNotification($Message, $user);

        // $blog = Relacion::GetListaservicios(auth()->user()->id);
        // return view('cliente.vista', compact('blog'))->render();
        return redirect()->route('seguimiento', $request->id_servicio);
        
    }

    public function show()
    {
        
    }
}
