<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($slug)
    {
        $user = User::where('slug', $slug)->first();

        return view('profiles/profile')->with('user', $user);
    }

    public function edit()
    {
        return view('profiles/edit')->with('info', Auth::user()->profile);
    }



    public function update(Request $request)
    {

        $this->validate($request, [
            'location' => 'required',
            'about' => 'required|max:255'
        ]);

        if($request->hasFile('avatar')){
            Auth::user()->update([
               'avatar' => $request->avatar->store('public/avatars')
            ]);
        }

        Auth::user()->profile->update([
           'location' => $request->input('location'),
            'about' => $request->input('about')
        ]);


        return redirect()->back();
    }
}
