<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(){
      return view("profile")->withUser(Auth::user());
    }

    public function update(Request $request){
      $validated = $request->validate([
        "name" => ['required', 'string', 'max:255'],
        "avatar" => ['image','mimes:jpeg,png,jpg','max:2048']
      ]);
      $user = Auth::user();
      if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
        $avatarName = $user->id.'_avatar_'.time().'.'.request()->avatar->getClientOriginalExtension();
        $avatarPath = $request->avatar->storeAs('avatars',$avatarName,'public');
        $validated['avatar'] = $avatarPath;
        if($user->avatar){
          Storage::disk('public')->delete($user->avatar);
        }
      }
      $user->update($validated);
      return back()->withStatus("Profile updated.");
    }
}
