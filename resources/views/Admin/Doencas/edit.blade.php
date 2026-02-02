@extends('layouts.admin')
@section('content')
    <div class="add">
        <div class="head">
            <h1>Edição de Doença</h1>

        </div>
        <form action="{{ route('update-doenca', $doenca->id) }}" class="form" method="POST">
            @csrf
            @method('PUT')
            <div class="card-control">
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="{{ $doenca->nome }}" required placeholder="Digite a nome">
            </div>

            <div class="card-control">
                <label for="descricao">Descrição</label>
                <textarea type="text" id="" min="0" name="descricao" required placeholder="Digite a descrição">{{ $doenca->descricao }}</textarea>
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
@endsection
