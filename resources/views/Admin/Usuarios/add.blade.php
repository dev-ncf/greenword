@extends('layouts.admin')
@section('content')
    <div class="add">

        <div class="head">
            <h1>Cadastro de Usuarios</h1>

        </div>
        <form action="{{ route('store-usuarios') }}" class="form" method="POST">
            @csrf
            <div class="card-control">
                <label for="nome">Nome</label>
                <input type="text" name="name" placeholder="Zé ninguem">
            </div>
            <div class="card-control">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="exemplo@empresa.com">
            </div>
            <div class="card-control">
                <label for="nivel">Nível</label>
                <select name="nivel" id="">
                    <option value="" disabled selected>Selecione o nivel</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="A">A</option>
                </select>
            </div>

            <div class="card-control">
                <button type="submit">Cadastrar</button>
            </div>

        </form>

    </div>
    @if ($errors->any())
        @include('Admin.error')
    @endif
    @if (session('success'))
        @include('Admin.success')
    @endif
    <script>
        const dataInput = document.getElementById("dataNascimento");
        const hoje = new Date();
        hoje.setDate(hoje.getDate() - 1); // Subtrai um dia, definindo para ontem

        // Formata a data para o formato yyyy-mm-dd exigido pelo input de data
        const dia = String(hoje.getDate()).padStart(2, '0');
        const mes = String(hoje.getMonth() + 1).padStart(2, '0'); // Janeiro é 0!
        const ano = hoje.getFullYear();

        dataInput.max = `${ano}-${mes}-${dia}`; // Define o max para ontem
    </script>
@endsection
