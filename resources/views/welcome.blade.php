@extends('layouts.main')

@section('title', 'TROCABYTE CRUD')

@section('content')
    <div id="search-container" class="col-md-12 px-5 my-4">
        <h1><ion-icon name="search-outline"></ion-icon> Procurar por usuário(s):</h1>
        <form action="#" class="d-flex gap-2">
            <input type="text" id="search" name="search" class="form-control" placeholder="Digite um nome para pesquisar por usuários" {{ $search ? "value=$search" : "" }} />
            <input type="submit" class="btn btn-trocabyte px-4" value="Buscar">
        </form>
    </div>

    <div id="user-container" class="col-md-12 px-5">
        @if ($search)
            <h2 class="fs-4">Procurando por: <strong>{{ $search }}</strong></h2>
        @endif

        <h1><ion-icon name="list-outline"></ion-icon> <span>Lista de usuários:</span></h1>

        @if (count($users))
            <table class="table table-hover mt-2">
                <thead>
                    <tr>
                        <th scope="col"># ID</th>
                        <th scope="col"><ion-icon name="person-outline"></ion-icon> Nome</th>
                        <th scope="col"><ion-icon name="document-text-outline"></ion-icon> CPF</th>
                        <th scope="col"><ion-icon name="mail-outline"></ion-icon> E-mail</th>
                        <th scope="col"><ion-icon name="home-outline"></ion-icon> Endereço</th>
                        <th scope="col"><ion-icon name="call-outline"></ion-icon> Telefone</th>
                        <th scope="col"><ion-icon name="calendar-outline"></ion-icon> Data de criação</th>
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
                                <a href="/usuarios/editar/{{ $user->id }}" class="btn btn-primary edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                                <form id="delete-button" action="/usuarios/deletar/{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a
                                        href="/usuarios/deletar/{{ $user->id }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="btn btn-danger delete-btn"  
                                    >
                                        <ion-icon name="trash-outline"></ion-icon> Deletar
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif (!count($users) && $search)
            <p>Não existe nenhum usuário com <strong>{{ $search }}</strong> no nome. <a href="/">Ver todos os usuários</a></p>
        @elseif (!count($users))
            <p>Nenhum usuário registrado ainda. <a href="/usuarios/registrar">Criar usuário</a></p>
        @endif
    </div>
@endsection
