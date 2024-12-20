@extends('layouts.admin')
@section('content')
    <div class="main-table">
        <div class="head">
            <h1>Lista de Pacientes</h1>
            <div class="right">
                <a class="search" id="pesquisar"><span class="material-symbols-sharp">search</span></a>
                <a href="{{ route('add-pacientes') }}"><span class="material-symbols-sharp">add </span>Adicionar</a>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Apelido</th>
                    <th>Genero</th>
                    <th>Idade</th>
                    <th>Contacto</th>
                    <th>Acção</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->nome }}</td>
                        <td>{{ $paciente->apelido }}</td>
                        <td>{{ $paciente->genero }}</td>
                        <td>24</td>
                        <td>{{ $paciente->contacto }}</td>
                        <td class="actions">
                            <a href="{{ route('show-pacientes', $paciente->id) }}"><span
                                    class="material-symbols-sharp show">visibility</span></a>
                            <a href="{{ route('edit-pacientes', $paciente->id) }}"><span
                                    class="material-symbols-sharp edit">edit</span></a>
                            <a href="javascript:;" id="delete-{{ $paciente->id }}" rota="pacientes/destroy"
                                onclick="return confirmDeletion(event)" class="btn btn-sm bg-danger"
                                dado='{{ $paciente->id }}'><span
                                    class="material-symbols-sharp delete">delete</span></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        @php
            $dados = $pacientes;
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
                    {{-- <button id="btn-filtrar" class="filtrar">Filtrar</button> --}}
                </div>
                <div class="content">
                    <div class="content-s" data-pacientes='{{ $todosPacientes }}'>
                        <div class="search">
                            <input type="text" class="input" placeholder="Pesquise por: nome, contato, doenças..."
                                name="search">
                            <span class="material-symbols-sharp">search</span>
                        </div>
                        <div class="results">
                            <div class="item">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Gênero</th>
                                            <th>Contato</th>
                                            <th>Doenças</th>
                                            <th>Data de Nascimento</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <!-- Linhas da tabela serão renderizadas dinamicamente -->
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
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/filtro.js') }}"></script>
@endsection
