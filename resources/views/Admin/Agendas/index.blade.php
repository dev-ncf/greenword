@extends('layouts.admin')
@section('content')
    <div class="main-table">
        <div class="head">
            <h1>Lista de Agendas</h1>
            <div class="right">
                <a class="search" id="pesquisar"><span class="material-symbols-sharp">search</span></a>
                <a href="{{ route('add-agendas') }}"><span class="material-symbols-sharp">add </span>Adicionar</a>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Email</th>
                    <th>Contacto</th>
                    <th>Medico</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Acção</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agendas as $agenda)
                    <tr>
                        <td>{{ $agenda->paciente }} </td>

                        <td>{{ $agenda->email }}</td>
                        <td>{{ $agenda->contacto }}</td>
                        <td>{{ $agenda->medico ? $agenda->medico->nome : '' }}</td>
                        <td>{{ $agenda->data }}</td>
                        <td>{{ $agenda->hora }}</td>

                        <td class="actions">

                            <a href="{{ route('show-agendas', $agenda->id) }}"><span
                                    class="material-symbols-sharp show">visibility</span></a>
                            <a href="javascript:;" id="delete-{{ $agenda->id }}" rota="agendas/destroy"
                                onclick="return confirmDeletion(event)" class="btn btn-sm bg-danger"
                                dado='{{ $agenda->id }}'><span class="material-symbols-sharp delete">delete</span></a>
                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
        @php
            $dados = $agendas;
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
                    <div class="content-s" data-consultas="{{ $todasAgendas }}">
                        <div class="search">
                            <input type="text" class="input" id="search-input-c" placeholder="Pesquise por: nome">
                            <span class="material-symbols-sharp">search</span>
                        </div>
                        <div class="results">
                            <div class="item">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Paciente</th>
                                            <th>Email</th>
                                            <th>Contacto</th>
                                            <th>Medico</th>
                                            <th>Data</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="content-f">
                        <div class="filtrar">
                            <select name="" id="">
                                <option value="">Filtrar por doença</option>
                            </select>
                            <select name="" id="">
                                <option value="">Filtrar por genero</option>
                            </select>
                            <select name="" id="">
                                <option value="">Filtrar por doença</option>
                            </select>
                        </div>
                        <div class="results">
                            <div class="item">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Genero</th>
                                            <th>Idade</th>
                                            <th>Doença</th>
                                            <th>Nivel</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center; background-color: blanchedalmond">
                                            <td><a href="">Ntwali Chance Filme</a></td>
                                            <td>Masculino</td>
                                            <td>25</td>
                                            <td>Malaria</td>
                                            <td>Critico</td>
                                            <td>Atednido</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
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
    <script src="{{ asset('js/search-consultas.js') }}"></script>
@endsection
