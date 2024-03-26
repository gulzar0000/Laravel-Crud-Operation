<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('show')->with('success');
    }

    public function show()
    {
        $users = User::all();
        return view('show', compact('users'));
    }

    public function getUser($id)
    {

        $users = User::findOrFail($id);

        return view('update', compact('users'));
    }
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);


        $user = User::find($id);


        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('show', $id)->with('success');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('show')->with('success');
    }
}
