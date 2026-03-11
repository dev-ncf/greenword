@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    
    <!-- CABEÇALHO -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white">Corpo Clínico</h1>
            <p class="text-sm text-[#7d8da1]">Gestão de médicos, especialidades e contactos.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- Botão Pesquisar (ID mantido para o JS) -->
            <button id="pesquisar" class="p-3 bg-white dark:bg-[#202528] text-emerald-500 rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800 hover:bg-emerald-50 transition-all group">
                <span class="material-symbols-sharp group-hover:scale-110 transition-transform">search</span>
            </button>
            
            <!-- Botão Adicionar -->
            <a href="{{ route('add-medicos') }}" class="flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-lg shadow-emerald-200 dark:shadow-none transition-all hover:scale-[1.02] active:scale-95 text-sm uppercase tracking-widest">
                <span class="material-symbols-sharp text-lg">person_add</span>
                Novo Médico
            </a>
        </div>
    </div>

    <!-- TABELA DE MÉDICOS -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-800 overflow-hidden text-[#363949] dark:text-[#edeffd]">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[#7d8da1] text-[11px] uppercase tracking-[0.2em] font-black border-b border-gray-50 dark:border-gray-800">
                        <th class="px-8 py-5">Médico</th>
                        <th class="px-8 py-5">Contacto / Email</th>
                        <th class="px-8 py-5">Especialidade</th>
                        <th class="px-8 py-5 text-center">Acções</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach ($medicos as $medico)
                        <tr class="hover:bg-emerald-50/30 dark:hover:bg-emerald-900/5 transition-all group">
                            <!-- Nome com Avatar de Inicial -->
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 font-bold text-xs">
                                        {{ substr($medico->nome, 0, 1) }}{{ str_contains($medico->nome, ' ') ? substr(strrchr($medico->nome, " "), 1, 1) : '' }}
                                    </div>
                                    <span class="font-bold text-sm tracking-tight">{{ $medico->nome }}</span>
                                </div>
                            </td>

                            <!-- Email e Contacto -->
                            <td class="px-8 py-5">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium">{{ $medico->contacto }}</span>
                                    <span class="text-[10px] text-[#7d8da1] italic">{{ $medico->email }}</span>
                                </div>
                            </td>

                            <!-- Especialidade -->
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase rounded-lg border border-emerald-100 dark:border-emerald-800">
                                    {{ $medico->especialidade }}
                                </span>
                            </td>

                            <!-- Ações -->
                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('edit-medicos', $medico->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all" title="Editar Médico">
                                        <span class="material-symbols-sharp text-lg">edit</span>
                                    </a>

                                    <button id="delete-{{ $medico->id }}" rota="medicos/destroy" dado='{{ $medico->id }}' onclick="return confirmDeletion(event)" class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all" title="Remover Médico">
                                        <span class="material-symbols-sharp text-lg">delete</span>
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
            @php $dados = $medicos; @endphp
            @include('Admin.paginar')
        </div>
    </div>

    <!-- MODAL DE PESQUISA (ESTRUTURA COMPATÍVEL COM O SEU JS) -->
    <div class="search-modal close fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white dark:bg-[#202528] w-full max-w-4xl rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col max-h-[85vh] animate-in zoom-in duration-200 border border-white/10">
            
            <!-- Modal Head -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-transparent">
                <h3 class="text-xl font-black text-emerald-600 flex items-center gap-3 uppercase tracking-tight">
                    <span class="material-symbols-sharp">clinical_notes</span> Pesquisar Médicos
                </h3>
                <button class="close p-2 hover:bg-red-50 text-red-500 rounded-full transition-colors" id="close">
                    <span class="material-symbols-sharp">close</span>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="modal-main p-8 overflow-y-auto">
                <div class="content">
                    <!-- IDs e Atributos originais mantidos para o search-medicos.js -->
                    <div class="content-s space-y-6" data-medicos="{{ $todosMedicos }}">
                        
                        <!-- Barra de Busca -->
                        <div class="search relative group">
                            <span class="material-symbols-sharp absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">search</span>
                            <input type="text" class="input w-full pl-14 pr-6 py-4 bg-gray-50 dark:bg-[#181a1e] border-2 border-transparent focus:border-emerald-500 rounded-2xl outline-none transition-all text-sm font-semibold" 
                                   id="search-input-c" placeholder="Pesquise por nome do médico...">
                        </div>

                        <!-- Resultados -->
                        <div class="results mt-6 border border-gray-100 dark:border-gray-800 rounded-2xl overflow-hidden bg-white dark:bg-[#1f2327]">
                            <div class="item overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead class="bg-gray-100 dark:bg-gray-800 text-[10px] font-black uppercase text-[#7d8da1] tracking-widest">
                                        <tr>
                                            <th class="px-6 py-4">Nome</th>
                                            <th class="px-6 py-4">Contacto</th>
                                        </tr>
                                    </thead>
                                    <!-- O seu JS injeta os resultados no tbody aqui -->
                                    <tbody class="table-body divide-y divide-gray-50 dark:divide-gray-800">
                                        <!-- Injetado dinamicamente via JS -->
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
    /* CSS para manter a funcionalidade original de fechar do seu JS */
    .search-modal.close {
        display: none !important;
    }

    /* Garante visibilidade dos dados injetados pelo JavaScript */
    .table-body tr td {
        padding: 1.2rem 1.5rem !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        color: #363949 !important;
    }
    
    .dark .table-body tr td {
        color: #edeffd !important;
    }

    /* Efeito de hover nas linhas da busca */
    .table-body tr:hover {
        background-color: rgba(16, 185, 129, 0.05) !important;
    }
</style>

@include('Admin.delete')

<script src="{{ asset('js/pacientes.js') }}"></script>
<script src="{{ asset('js/search-medicos.js') }}"></script>
@endsection