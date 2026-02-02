@extends('layouts.admin')
@section('content')
    <div class="add">

        <div class="head">
            <h1>Edição de Usuarios</h1>

        </div>
        <form action="{{ route('update-usuarios', $user->id) }}" class="form" method="POST">
            @csrf
            @method('PUT')
            <div class="card-control">
                <label for="nome">Nome</label>
                <input type="text" name="name" placeholder="Zé ninguem" value="{{ $user->name }}">
            </div>
            <div class="card-control">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="exemplo@empresa.com" value="{{ $user->email }}">
            </div>
            <div class="card-control">
                <label for="nivel">Nível</label>
                <select name="nivel" id="">
                    <option value="" disabled selected>Selecione o nivel</option>
                    <option {{ $user->nivel == 'B' ? 'selected' : '' }} value="B">B</option>
                    <option {{ $user->nivel == 'C' ? 'selected' : '' }} value="C">C</option>
                    <option {{ $user->nivel == 'A' ? 'selected' : '' }} value="A">A</option>
                </select>
            </div>

            <div class="card-control">
                <button type="submit">Salvar</button>
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
