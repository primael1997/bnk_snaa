<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
       $request->validate([
        'name' => ['required', 'max:100'],
        'login' => ['required', 'max:100'],
       ]);


       $user = Auth::user();

       $user->name = $request->name;
       $user->login = $request->login;
       $user->save();

       toastr()->success('Mise à jour "ffectuée!');
       return redirect()->back();
    }

    /** Update Password */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required','confirmed', 'min:8'],
            'password_confirmation' => ['required', 'min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Mise à jour éffectuée!');
        return redirect()->back();
    }
}
