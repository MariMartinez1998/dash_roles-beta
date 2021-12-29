<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profilleController extends Controller
{
    public function change_password(){
        return view('profile.change_password');

    }

    public function update_password(Request $request){
        $request->validate([
           'pfCurrentPassword'=>'required|min:6|max:100',
            'pfNewPassword'=>'required|min:6|max:100',
            'pfNewConfirmPassword'=>'required|same:pfNewPassword'
        ]);

        $current_user = auth()->user();
        if(Hash::check($request->pfCurrentPassword, $current_user->password )){ 
            $current_user->update([
                'password'=>Hash::make($request->pfNewPassword)
            ]);

            return redirect()->back()->with('success', 'Password successfully update');

        }else{
            return redirect()->back()->with('error', 'Old password does not exits');
        }
    }
}
