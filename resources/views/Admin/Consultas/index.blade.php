@extends('layouts.admin')
@section('content')
    <div class="main-table">
        <div class="head">
            <h1>Lista de Consultas</h1>
            <div class="right">
                <a class="search" id="pesquisar"><span class="material-symbols-sharp">search</span></a>
                <a href="{{ route('add-consulta') }}"><span class="material-symbols-sharp">add </span>Adicionar</a>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Doença(s)</th>
                    <th>Data</th>
                    <th>Estado</th>
                    <th>Acção</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultas as $consulta)
                    <tr>
                        <td>{{ $consulta->paciente->nome . ' ' . $consulta->paciente->apelido }} </td>
                        @php
                            $doencas = null;
                            foreach ($consulta->doencas as $doenca) {
                                // Se já houver algum valor, adiciona a vírgula antes do próximo nome
                                if ($doencas) {
                                    $doencas .= ', ';
                                }
                                // Concatena o nome da doença
                                $doencas .= $doenca->nome;
                            }
                        @endphp
                        <td>{{ $doencas }}</td>
                        <td>{{ $consulta->data_consulta }}</td>
                        <td
                            class="{{ $consulta->estado == 'Pendente' ? 'warning' : ($consulta->estado == 'Atendido' ? 'primary' : 'red') }}">
                            {{ $consulta->estado }}</td>
                        <td class="actions">
                            @if ($consulta->estado == 'Pendente')
                                <a href="{{ route('estado-consultas', $consulta->id) }}"><span
                                        class="material-symbols-sharp edit">
                                        check_circle
                                    </span></a>
                            @endif
                            <a href="{{ route('show-consulta', $consulta->id) }}"><span
                                    class="material-symbols-sharp show">visibility</span></a>
                            <a href="javascript:;" id="delete-{{ $consulta->id }}" rota="consultas/destroy"
                                onclick="return confirmDeletion(event)" class="btn btn-sm bg-danger"
                                dado='{{ $consulta->id }}'><span class="material-symbols-sharp delete">delete</span></a>
                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
        @php
            $dados = $consultas;
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
                    <div class="content-s" data-consultas="{{ $todasConsultas }}">
                        <div class="search">
                            <input type="text" class="input" id="search-input-c"
                                placeholder="Pesquise por: nome, doença, Data, ...">
                            <span class="material-symbols-sharp">search</span>
                        </div>
                        <div class="results">
                            <div class="item">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Genero</th>
                                            <th>Data Nascimento</th>
                                            <th>Doença</th>
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
