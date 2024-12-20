@extends('layouts.admin')
@section('content')
    <div class="add">
        <div class="head">
            <h1>Cadastro de Medicos</h1>

        </div>
        <form action="{{ route('store-medicos') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-control">
                <label for="nome">Nome</label>
                <input type="text" name="nome" placeholder="Digite nome" required>
            </div>



            <div class="card-control">
                <label for="Email">Email</label>
                <input type="email" id="" min="0" name="email" placeholder="Digite email">
            </div>
            <div class="card-control">
                <label for="Contacto">Contacto</label>
                <input type="number" id="" min="0" name="contacto" placeholder="Digite contacto">
            </div>
            <div class="card-control">
                <label for="Especialidade">Especialidade</label>
                <input type="text" id="" min="0" name="especialidade" placeholder="Digite especialidade">
            </div>
            <div class="card-control">
                <label for="Foto">Especialidade</label>
                <input type="file" id="" min="0" name="foto">
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
@endsection
