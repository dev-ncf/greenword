@extends('layouts.admin')
@section('content')
    <div class="main-table">
        <div class="head">
            <h1>Lista de Usuarios</h1>
            <div class="right">
                <a class="search" id="pesquisar"><span class="material-symbols-sharp">search</span></a>
                <a href="{{ route('add-usuarios') }}"><span class="material-symbols-sharp">add </span>Adicionar</a>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nivel</th>
                    <th>Acção</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->nivel }}</td>
                        <td class="actions">
                            <a href="{{ route('show-usuarios', $usuario->id) }}"><span
                                    class="material-symbols-sharp show">visibility</span></a>
                            <a href="{{ route('edit-usuarios', $usuario->id) }}"><span
                                    class="material-symbols-sharp edit">edit</span></a>
                            <a href="javascript:;" id="delete-{{ $usuario->id }}" rota="usuarios/destroy"
                                onclick="return confirmDeletion(event)" class="btn btn-sm bg-danger"
                                dado='{{ $usuario->id }}'><span class="material-symbols-sharp delete">delete</span></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        @php
            $dados = $usuarios;
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
                    <div class="content-s" id="content-s-user" data-usuarios='{{ $todosUsuarios }}'>
                        <div class="search">
                            <input type="text" class="input" id="input-user"
                                placeholder="Pesquise por: nome ou email..." name="search">
                            <span class="material-symbols-sharp">search</span>
                        </div>
                        <div class="results">
                            <div class="item">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Nível</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body" id="table-body-user">
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
    <script src="{{ asset('js/search-user.js') }}"></script>
@endsection
