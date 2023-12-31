<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{
    public function index(){


        return view('users.index')->with('users',User::all());
    }
    public function makeAdmin(User $user){

        $user->role = 'admin';
        $user->save();
        return redirect(route('users.index'));
    }
    public function edit(User $user){
        $profile = $user->profile;
        return view('users.profile',['user'=>$user ,'profile'=>$profile]);

    }
    
    public function update(User $user ,Request $request){
       $profile = $user->profile;
       $data = $request->all();
        if ($request->hasFile('picture')) {
            $picture = $request->picture->store('ProfilesPicture','public');
            Storage::disk('public')->delete($user->profile->picture);
            $data['picture']=$picture;
          }
        $profile->update($data);
        return redirect(route('users.index'));
    }
}
