@extends('layouts.main')

@section('title', 'TROCABYTE CRUD')

@section('content')
    <h1 class="mt-4">Lista de usuários:</h1>

    @if (count($users))
        <table class="table table-hover mt-2">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Data de criação</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php
                        $cpf_one = substr($user->cpf, 0, 3);
                        $cpf_two = substr($user->cpf, 3, 3);
                        $cpf_three = substr($user->cpf, 6, 3);
                        $cpf_four = substr($user->cpf, 9, 2);

                        $formatted_cpf = "$cpf_one.$cpf_two.$cpf_three-$cpf_four";

                        $phone_one = substr($user->phone, 0, 2);
                        if (strlen((string) $user->phone) === 10) {
                            $phone_two = substr($user->phone, 2, 4);
                            $phone_three = substr($user->phone, 6, 4);
                        }
                        else {
                            $phone_two = substr($user->phone, 2, 5);
                            $phone_three = substr($user->phone, 7, 4);
                        }

                        $formatted_phone = "($phone_one) $phone_two-$phone_three";
                    @endphp

                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $formatted_cpf }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $formatted_phone }}</td>
                        <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                        <td>
                            <a href="#">Editar</a>
                            <form id="delete-button" action="/users/{{ $user->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a
                                    href="/users/{{ $user->id }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"    
                                >
                                    Deletar
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum usuário registrado ainda. <a href="/register">Criar usuário</a></p>
    @endif
@endsection
