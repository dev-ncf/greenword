@extends('layouts.admin')
@section('content')
    <div class="main-table">
        <div class="head">
            <h1>Lista de Medicos</h1>
            <div class="right">
                <a class="search" id="pesquisar"><span class="material-symbols-sharp">search</span></a>
                <a href="{{ route('add-medicos') }}"><span class="material-symbols-sharp">add </span>Adicionar</a>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>email</th>
                    <th>Contacto</th>
                    <th>Especialidade</th>
                    <th>Acção</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicos as $medico)
                    <tr>
                        <td>{{ $medico->nome }}</td>
                        <td>{{ $medico->email }}</td>
                        <td>{{ $medico->contacto }}</td>
                        <td>{{ $medico->especialidade }}</td>
                        <td class="actions">
                            <a href="{{ route('edit-medicos', $medico->id) }}"><span
                                    class="material-symbols-sharp edit">edit</span></a>
                            <a href="javascript:;" id="delete-{{ $medico->id }}" rota="medicos/destroy"
                                onclick="return confirmDeletion(event)" class="btn btn-sm bg-danger"
                                dado='{{ $medico->id }}'><span class="material-symbols-sharp delete">delete</span></a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
        @php
            $dados = $medicos;
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
                    <div class="content-s" data-medicos="{{ $todosMedicos }}">
                        <div class="search">
                            <input type="text" class="input" id="search-input-c" placeholder="Pesquise por: nome">
                            <span class="material-symbols-sharp">search</span>
                        </div>
                        <div class="results">
                            <div class="item">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Contacto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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
    <script src="{{ asset('js/search-medicos.js') }}"></script>
@endsection
