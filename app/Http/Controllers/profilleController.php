<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Automovil;
use App\Models\Blog;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class profilleController extends Controller
{
    public function changepasswordForm(){
        return view('profile.change_password');

    }

    public function changepassword(Request $request){

        $user = User::find(auth()->user()->id);

        $this->validate($request, [
            'password' => 'same:password_confirmation'
        ]);
        $input = $request->all();
        $input['email'] = $user['email'];
        //return $input;
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }

        if(Auth::attempt(['email' => $input['email'], 'password' => $input['password_current']])){
            User::find(auth()->user()->id)->update(['password' => $input['password']]);
            return 'autenticacion correcta';
        }
        return 'no se pudo autenticar';
    }

}