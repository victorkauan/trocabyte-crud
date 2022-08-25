<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    // Route: /
    public function index() {
        $search = request('search');

        if ($search) {
            $users = User::where([
                ['name', 'like', '%' . $search . '%'],
            ])->get();
        } else {
            $users = User::all();
        }

        return view('welcome', ['users' => $users, 'search' => $search]);
    }

    // Route: /usuarios/registrar
    public function create() {
        return view('users.create');
    }

    // Route: /usuarios/criar
    public function store(Request $request) {
        $user = new User;

        $user->name = $request->name;
        $user->cpf = preg_replace('/[^0-9]+/', '', $request->cpf);
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = preg_replace('/[^0-9]+/', '', $request->phone);

        $user->save();

        return redirect('/')->with('msg', 'Usuário criado com sucesso!');
    }

    // Route: /usuarios/deletar/{id}
    public function destroy($id) {
        User::findOrFail($id)->delete();

        return redirect('/')->with('msg', 'Usuário deletado com sucesso!');
    }

    // Route: /usuarios/editar/{id}
    public function edit($id) {
        $user = User::findOrFail($id);

        return view('users.edit', ['user' => $user]);
    }

    // Route: /usuarios/atualizar/{id}
    public function update(Request $request) {
        $data = $request->all();
        
        $data['cpf'] = preg_replace('/[^0-9]+/', '', $request->cpf);
        $data['phone'] = preg_replace('/[^0-9]+/', '', $request->phone);
        
        User::findOrFail($request->id)->update($data);

        return redirect('/')->with('msg', 'Usuário editado com sucesso!');
    }
}
