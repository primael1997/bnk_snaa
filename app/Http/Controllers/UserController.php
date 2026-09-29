<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role','user')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'login' => 'required|string',
            'role' => 'required|string',
            'status' => 'required|string',
        ]);

        $data['password'] = bcrypt('password');

        User::create($data);

        toastr('Utilisateur ajouté avec succès', 'success');

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $data = $request->validate([
                'name' => 'required|string',
                'login' => 'required|string',
                'role' => 'required|string',
                'status' => 'required|string',
            ]);

            $data['password'] = bcrypt('password');

            $user->update($data);

            toastr('Utilisateur ajouté avec succès', 'success');
            return redirect()->route('admin.user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
    }


    public function changeStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status == 'true' ? 'actif' : 'inactif';
        $user->save();

        return response(['message' => 'Mise à jour éffectuée!']);
    }

    public function generatePassword(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->password = bcrypt('password');
        $user->save();

        return response(['message' => 'Mot de passe généré!']);
    }
}
