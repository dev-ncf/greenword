@extends('layouts.admin')
@section('content')
    <div class="add">
        <div class="head">
            <h1>Detalhes da Doença</h1>

        </div>
        <form class="form" method="POST">
            @csrf
            @method('PUT')
            <div class="card-control">
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="{{ $doenca->nome }}" required readonly>

                <label for="descricao">Descrição</label>
                <textarea type="text" id="" min="0" name="descricao" readonly placeholder="null">{{ $doenca->descricao }}</textarea>
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
