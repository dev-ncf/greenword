@extends('layouts.admin')
@section('content')
    <div class="add">
        <div class="head">
            <h1>Cadastro de Doenças</h1>

        </div>
        <form action="{{ route('store-doencas') }}" class="form" method="POST">
            @csrf
            <div class="card-control">
                <label for="nome">Nome</label>
                <input type="text" name="nome" required placeholder="Digite a nome">
            </div>

            <div class="card-control">
                <label for="descricao">Descrição</label>
                <input type="text" id="" min="0" name="descricao" required
                    placeholder="Digite a descrição">
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
