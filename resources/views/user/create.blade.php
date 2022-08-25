@extends('layouts.main')

@section('title', 'Criar usuário')

@section('content')
    <div id="event-create-container" class="col-md-4 offset-md-4 mt-4">
        <h1>Criar usuário</h1>

        <form action="/register" method="POST" class="d-flex flex-column gap-3">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required/>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required/>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required/>
            </div>
            <div class="form-group">
                <label for="address">Endereço:</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" required/>
            </div>
            <div class="form-group">
                <label for="phone">Telefone:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Número de telefone" required/>
            </div>
            <input type="submit" class="btn btn-trocabyte" value="Criar" />
        </form>

        <script>
            function getCountOfDigits(string) {
                return string.replace(/[^0-9]/g, '').length;
            }

            $(document).ready(() => {
                $('#cpf').inputmask('999.999.999-99');
            });

            $(document).ready(() => {
                $('#phone').inputmask('(99) 99999-9999');
            });

            document.querySelector('.btn-trocabyte').addEventListener('click', (event) => {
                let cpfInput = document.getElementById('cpf');
                let phoneInput = document.getElementById('phone');

                let cpfDigits = getCountOfDigits(cpfInput.value);
                let phoneDigits = getCountOfDigits(phoneInput.value);

                if (cpfDigits !== 11 && cpfDigits > 0) {
                    cpfInput.setCustomValidity("CPF inválido.");
                } else {
                    cpfInput.setCustomValidity("");
                }

                if ((phoneDigits < 10 || phoneDigits > 11) && phoneDigits > 0) {
                    phoneInput.setCustomValidity("Número de telefone inválido.");
                } else {
                    phoneInput.setCustomValidity("");
                }
            });
        </script>
    </div>
@endsection
