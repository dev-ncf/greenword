@extends('layouts.admin')
@section('content')
    <div class="add">
        <div class="head">
            <h1>Edição de Pacientes</h1>

        </div>
        <form action="{{ route('update-pacientes', $paciente->id) }}" class="form" method="POST">
            @csrf
            @method('PUT')
            <div class="card-control">
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="{{ $paciente->nome }}">
            </div>
            <div class="card-control">
                <label for="apelido">Apelido</label>
                <input type="text" name="apelido" value="{{ $paciente->apelido }}">
            </div>
            <div class="card-control">
                <label for="nome">Genero</label>
                <select name="genero" id="">
                    <option value="M" {{ $paciente->genero == 'M' ? 'selected' : '' }}>M</option>
                    <option value="F" {{ $paciente->genero == 'F' ? 'selected' : '' }}>F</option>
                </select>
            </div>
            <div class="card-control">
                <label for="Data de nascimento">Data de Nascimento</label>
                <input type="date" id="dataNascimento" max="" name="data_nascimento"
                    value="{{ $paciente->data_nascimento }}">
            </div>
            <div class="card-control">
                <label for="Contacto">Contacto</label>
                <input type="number" id="" min="0" name="contacto" value="{{ $paciente->contacto }}">
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
