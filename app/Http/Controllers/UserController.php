<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('welcome', ['users' => $users]);
    }

    public function create() {
        return view('user.create');
    }

    public function store(Request $request) {
        $user = new User;

        $user->name = $request->name;
        $user->cpf = $request->cpf;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;

        $user->save();

        return redirect('/')->with('msg', 'Usuário criado com sucesso!');
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();

        return redirect('/')->with('msg', 'Usuário deletado com sucesso!');
    }
}
