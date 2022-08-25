@extends('layouts.main')

@section('title', 'Criar usuário')

@section('content')
    <div id="event-create-container" class="col-md-4 offset-md-4 mt-4">
        <h1>Criar usuário</h1>

        <form class="d-flex flex-column gap-3">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" />
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" />
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" />
            </div>
            <div class="form-group">
                <label for="address">Endereço:</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" />
            </div>
            <div class="form-group">
                <label for="phone">Telefone:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Número de telefone" />
            </div>
            <input type="submit" class="btn btn-trocabyte" value="Criar" />
        </form>
    </div>
@endsection
