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

class profilleController extends Controller
{
    public function changepasswordForm(){
        return view('profile.change_password');

    }

    public function changepassword(Request $request){
        $this->validate($request, [
            
            'password' => 'same:confirm-password'
        ]);      
        
        // if(!empty($input['password'])){ 
        //     $input['password'] = Hash::make($input['password']);
        // }
 
        if(!(Hash::check($request->get('pfCurrentPassword'),  auth()->user()->password))) { 
            return back()->with('error', 'Your current password does not match with what you provided');
        }

        if(strcmp($request->get('pfCurrentPassword'), $request->get('pfNewPassword')) == 0) {
            return back()->with('error', 'Your current password cannot be same with the new password');
        } 
        $request->validate([
            'pfCurrentPassword'=>'required|min:6|max:100',
             'pfNewPassword'=>'required|min:6|max:100',
             'pfNewConfirmPassword'=>'required|same:pfNewPassword'
         ]);

         $user = User::find($div[0]);
  
        
         $user =  auth()->user();
          $user->password = bcrypt($request->get('pfNewPassword'));
          $user->update($input);
           return back()->with('message', 'Password changed successfully');
        }

}