@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    
    <!-- CABEÇALHO -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white">Lista de Consultas</h1>
            <p class="text-sm text-[#7d8da1]">Gerencie o estado e visualize o histórico de atendimentos.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- Botão Pesquisar (ID mantido para o JS) -->
            <button id="pesquisar" class="p-3 bg-white dark:bg-[#202528] text-emerald-500 rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800 hover:bg-emerald-50 transition-all group">
                <span class="material-symbols-sharp group-hover:scale-110 transition-transform">search</span>
            </button>
        </div>
    </div>

    <!-- TABELA DE CONSULTAS -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[#7d8da1] text-[11px] uppercase tracking-[0.2em] font-black border-b border-gray-50 dark:border-gray-800">
                        <th class="px-8 py-5">Paciente</th>
                        <th class="px-8 py-5">Doença(s)</th>
                        <th class="px-8 py-5 text-center">Data</th>
                        <th class="px-8 py-5 text-center">Estado</th>
                        <th class="px-8 py-5 text-center">Acções</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach ($consultas as $consulta)
                        <tr class="hover:bg-emerald-50/30 dark:hover:bg-emerald-900/5 transition-all group">
                            <!-- Nome com Avatar -->
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 font-bold">
                                        {{ substr($consulta->paciente->nome, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-sm text-[#363949] dark:text-white">{{ $consulta->paciente->nome }} {{ $consulta->paciente->apelido }}</span>
                                </div>
                            </td>

                            <!-- Doenças -->
                            <td class="px-8 py-5">
                                <span class="text-xs text-[#677483] font-medium leading-relaxed">
                                    {{ $consulta->doencas->pluck('nome')->implode(', ') }}
                                </span>
                            </td>

                            <!-- Data -->
                            <td class="px-8 py-5 text-center">
                                <span class="text-xs font-bold text-[#7d8da1]">{{ \Carbon\Carbon::parse($consulta->data_consulta)->format('d/m/Y') }}</span>
                            </td>

                            <!-- Estado com Badges Coloridas -->
                            <td class="px-8 py-5 text-center">
                                @php
                                    $statusClass = match($consulta->estado) {
                                        'Pendente' => 'bg-orange-50 text-orange-500 border-orange-100',
                                        'Atendido' => 'bg-emerald-50 text-emerald-500 border-emerald-100',
                                        default => 'bg-red-50 text-red-500 border-red-100',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase border {{ $statusClass }}">
                                    {{ $consulta->estado }}
                                </span>
                            </td>

                            <!-- Ações -->
                            <td class="px-8 py-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @if ($consulta->estado == 'Pendente')
                                        <a href="{{ route('estado-consultas', $consulta->id) }}" class="p-2 text-emerald-500 hover:bg-emerald-50 rounded-xl transition-all" title="Concluir Atendimento">
                                            <span class="material-symbols-sharp">check_circle</span>
                                        </a>
                                    @endif
                                    
                                    <a href="{{ route('show-consulta', $consulta->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-xl transition-all" title="Ver Detalhes">
                                        <span class="material-symbols-sharp">visibility</span>
                                    </a>

                                    <button id="delete-{{ $consulta->id }}" rota="consultas/destroy" dado='{{ $consulta->id }}' onclick="return confirmDeletion(event)" class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Eliminar">
                                        <span class="material-symbols-sharp">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="px-8 py-6 border-t border-gray-50 dark:border-gray-800">
            @php $dados = $consultas; @endphp
            @include('Admin.paginar')
        </div>
    </div>

    <!-- MODAL DE PESQUISA (ESTRUTURA ORIGINAL PARA O JS) -->
    <div class="search-modal close fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-[#202528] w-full max-w-4xl rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col max-h-[90vh] animate-in zoom-in duration-200">
            
            <!-- Modal Head -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-transparent">
                <h3 class="text-xl font-black text-emerald-600 flex items-center gap-2 uppercase tracking-tight">
                    <span class="material-symbols-sharp">search</span> Pesquisar Consultas
                </h3>
                <button class="close p-2 hover:bg-red-50 text-red-500 rounded-full transition-colors" id="close">
                    <span class="material-symbols-sharp">close</span>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="modal-main p-8 overflow-y-auto">
                <div class="content">
                    <div class="content-s space-y-6" data-consultas="{{ $todasConsultas }}">
                        
                        <!-- Barra de Busca -->
                        <div class="search relative group">
                            <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500">search</span>
                            <input type="text" class="input w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-[#181a1e] border-2 border-transparent focus:border-emerald-500 rounded-2xl outline-none transition-all text-sm font-medium" 
                                   id="search-input-c" placeholder="Pesquise por: nome, doença, Data, ...">
                        </div>

                        <!-- Resultados -->
                        <div class="results mt-6 border border-gray-100 dark:border-gray-800 rounded-2xl overflow-hidden">
                            <div class="item overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-gray-50 dark:bg-gray-800/50 text-[10px] font-black uppercase text-[#7d8da1] tracking-widest">
                                        <tr>
                                            <th class="px-6 py-4">Nome</th>
                                            <th class="px-6 py-4">Genero</th>
                                            <th class="px-6 py-4">Data Nascimento</th>
                                            <th class="px-6 py-4">Doença</th>
                                            <th class="px-6 py-4">Estado</th>
                                        </tr>
                                    </thead>
                                    <!-- ID tbody mantido para o JS injetar as linhas -->
                                    <tbody id="tbody" class="divide-y divide-gray-50 dark:divide-gray-800 text-sm font-medium">
                                        <!-- Injetado pelo JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilo crucial para o funcionamento do seu JS original */
    .search-modal.close {
        display: none !important;
    }
    /* Estilização para as linhas injetadas dinamicamente pelo JS */
    #tbody tr td {
        padding: 1rem 1.5rem;
        color: #363949;
    }
    .dark #tbody tr td {
        color: #edeffd;
    }
</style>

@if ($errors->any()) @include('Admin.error') @endif
@if (session('success')) @include('Admin.success') @endif
@include('Admin.delete')

<script src="{{ asset('js/pacientes.js') }}"></script>
<script src="{{ asset('js/search-consultas.js') }}"></script>
@endsection