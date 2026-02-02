@extends('layouts.admin')
@section('content')
    <div class="main-table">
        <div class="head">
            <h1>Lista de Doenças</h1>
            <div class="right">
                <a class="search" id="pesquisar"><span class="material-symbols-sharp">search</span></a>
                <a href="{{ route('add-doencas') }}"><span class="material-symbols-sharp">add </span>Adicionar</a>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Acção</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doencas as $doenca)
                    <tr>
                        <td>{{ $doenca->nome }}</td>
                        <td>{{ $doenca->truncateWords($doenca->descricao, 8) }}</td>
                        <td class="actions">
                            <a href="{{ route('show-doenca', $doenca->id) }}"><span
                                    class="material-symbols-sharp show">visibility</span></a>
                            <a href="{{ route('edit-doenca', $doenca->id) }}"><span
                                    class="material-symbols-sharp edit">edit</span></a>
                            <a href="javascript:;" id="delete-{{ $doenca->id }}" rota="doencas/destroy"
                                onclick="return confirmDeletion(event)" class="btn btn-sm bg-danger"
                                dado='{{ $doenca->id }}'><span class="material-symbols-sharp delete">delete</span></a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
            $dados = $doencas;
        @endphp
        @include('Admin.paginar')
    </div>
    <div class="search-modal close">
        <div style="width: 50%">
            <div class="modal-top">
                <span></span>
                <button class="close" id="close"><span class="material-symbols-sharp ">close</span></button>
            </div>
            <div class="modal-main">
                <div class="head">
                    <button id="btn-pesquisar" class="pesquisar active">Pesquisar</button>

                </div>
                <div class="content">
                    <div class="content-s" data-doencas="{{ $todasDoencas }}">
                        <div class="search">
                            <input type="text" class="input" id="search-input-c"
                                placeholder="Pesquise por: nome ou descricao">
                            <span class="material-symbols-sharp">search</span>
                        </div>
                        <div class="results">
                            <div class="item">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center;">
                                            <td><a href="">Ntwali Chance Filme</a></td>
                                            <td>842195299</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        @include('Admin.error')
    @endif
    @if (session('success'))
        @include('Admin.success')
    @endif
    @include('Admin.delete')
    <script src="{{ asset('js/pacientes.js') }}"></script>
    <script src="{{ asset('js/search-doencas.js') }}"></script>
@endsection
