@extends('layouts.admin')
@section('content')
    <div class="add">
        <div class="head">
            <h1>Edição de Medico</h1>

        </div>
        <form action="{{ route('update-medicos', $medico->id) }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-control">
                <label for="nome">Nome</label>
                <input type="text" name="nome" placeholder="Digite nome" value="{{ $medico->nome }}" required>
            </div>



            <div class="card-control">
                <label for="Email">Email</label>
                <input type="email" id="" min="0" name="email" value="{{ $medico->email }}"
                    placeholder="Digite email">
            </div>
            <div class="card-control">
                <label for="Contacto">Contacto</label>
                <input type="number" id="" min="0" name="contacto" value="{{ $medico->contacto }}"
                    placeholder="Digite contacto">
            </div>
            <div class="card-control">
                <label for="Especialidade">Especialidade</label>
                <input type="text" id="" min="0" name="especialidade"
                    value="{{ $medico->especialidade }}" placeholder="Digite especialidade">
            </div>
            <div class="card-control">
                <label for="Foto">Foto</label>
                <input type="file" id="" min="0" name="foto">
            </div>
            <div class="card-control">
                <button type="submit">Actualizar</button>
            </div>

        </form>

    </div>
    @if ($errors->any())
        @include('Admin.error')
    @endif
    @if (session('success'))
        @include('Admin.success')
    @endif
@endsection
