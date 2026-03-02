@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- CABEÇALHO -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white">Lista de Pacientes</h1>
            <p class="text-sm text-[#7d8da1]">Gerencie e visualize todos os pacientes registados.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- Botão Pesquisar (ID mantido para o JS) -->
            <button id="pesquisar" class="p-3 bg-white dark:bg-[#202528] text-emerald-500 rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800 hover:bg-emerald-50 transition-all group">
                <span class="material-symbols-sharp group-hover:scale-110 transition-transform">search</span>
            </button>
            
            <a href="{{ route('add-pacientes') }}" class="flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-lg shadow-emerald-200 transition-all hover:scale-[1.02] active:scale-95">
                <span class="material-symbols-sharp text-lg">add</span>
                Adicionar
            </a>
        </div>
    </div>

    <!-- TABELA PRINCIPAL -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[#7d8da1] text-[11px] uppercase tracking-[0.2em] font-black border-b border-gray-50 dark:border-gray-800">
                        <th class="px-8 py-5">Nome</th>
                        <th class="px-8 py-5">Apelido</th>
                        <th class="px-8 py-5">Gênero</th>
                        <th class="px-8 py-5">Idade</th>
                        <th class="px-8 py-5">Contacto</th>
                        <th class="px-8 py-5 text-center">Acção</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach ($pacientes as $paciente)
                        <tr class="hover:bg-emerald-50/30 dark:hover:bg-emerald-900/5 transition-all group">
                            <td class="px-8 py-5 font-bold text-sm text-[#363949] dark:text-white">{{ $paciente->nome }}</td>
                            <td class="px-8 py-5 text-sm text-[#677483]">{{ $paciente->apelido }}</td>
                            <td class="px-8 py-5 text-sm">{{ $paciente->genero }}</td>
                            <td class="px-8 py-5 text-sm font-bold">24</td>
                            <td class="px-8 py-5 text-sm text-[#7d8da1]">{{ $paciente->contacto }}</td>
                            <td class="px-8 py-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('show-pacientes', $paciente->id) }}" class="text-emerald-500 hover:scale-110 transition-transform">
                                        <span class="material-symbols-sharp">visibility</span>
                                    </a>
                                    <a href="{{ route('edit-pacientes', $paciente->id) }}" class="text-blue-500 hover:scale-110 transition-transform">
                                        <span class="material-symbols-sharp">edit</span>
                                    </a>
                                    <a href="javascript:;" id="delete-{{ $paciente->id }}" rota="pacientes/destroy" onclick="return confirmDeletion(event)" dado='{{ $paciente->id }}' class="text-red-500 hover:scale-110 transition-transform">
                                        <span class="material-symbols-sharp">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 border-t border-gray-50 dark:border-gray-800">
            @php $dados = $pacientes; @endphp
            @include('Admin.paginar')
        </div>
    </div>

   <!-- MODAL DE PESQUISA (ESTRUTURA ORIGINAL MANTIDA PARA O JS) -->
<div class="search-modal close fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-md transition-all duration-300">
    
    <!-- Card do Modal -->
    <div class="bg-white dark:bg-[#202528] w-full max-w-4xl rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.3)] overflow-hidden flex flex-col max-h-[85vh] border border-white/20">
        
        <!-- Cabeçalho do Modal -->
        <div class="p-6 md:px-10 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-transparent relative">
            <!-- Linha de detalhe verde no topo -->
            <div class="absolute top-0 left-10 right-10 h-1 bg-emerald-500 rounded-b-full"></div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-sharp text-3xl">manage_search</span>
                </div>
                <div>
                    <h3 class="text-xl font-black text-[#363949] dark:text-white uppercase tracking-tight">Busca Inteligente</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Localize registros rapidamente</p>
                </div>
            </div>

            <button class="close group p-3 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-2xl transition-all" id="close">
                <span class="material-symbols-sharp text-red-500 group-hover:rotate-90 transition-transform duration-300">close</span>
            </button>
        </div>

        <!-- Corpo do Modal -->
        <div class="modal-main p-6 md:p-10 overflow-y-auto custom-scrollbar">
            <div class="content">
                <!-- content-s e data-pacientes originais preservados -->
                <div class="content-s space-y-8" data-pacientes='{{ $todosPacientes }}'>
                    
                    <!-- Container do Input -->
                    <div class="search relative group">
                        <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                            <span class="material-symbols-sharp text-gray-400 group-focus-within:text-emerald-500 transition-colors">search</span>
                        </div>
                        <input type="text" 
                               class="input w-full pl-14 pr-6 py-5 bg-gray-100 dark:bg-[#181a1e] border-2 border-transparent focus:border-emerald-500 rounded-[2rem] outline-none transition-all text-sm font-semibold placeholder:text-gray-400 placeholder:italic shadow-inner" 
                               placeholder="Digite nome, contato ou doenças do paciente..." 
                               name="search">
                    </div>

                    <!-- Área de Resultados -->
                    <div class="results mt-8">
                        <div class="item rounded-[2rem] border border-gray-100 dark:border-gray-800 overflow-hidden bg-white dark:bg-[#1f2327]">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead class="bg-gray-50 dark:bg-gray-800/50 sticky top-0 z-10">
                                        <tr class="text-[10px] font-black uppercase text-[#7d8da1] tracking-[0.15em]">
                                            <th class="px-6 py-5">Identificação</th>
                                            <th class="px-6 py-5">Gênero</th>
                                            <th class="px-6 py-5 text-center">Contato</th>
                                            <th class="px-6 py-5">Histórico</th>
                                            <th class="px-6 py-5 text-right">Registo</th>
                                        </tr>
                                    </thead>
                                    <!-- O JS vai injetar os <tr> aqui dentro -->
                                    <tbody class="table-body divide-y divide-gray-50 dark:divide-gray-800/50">
                                        <!-- Injetado dinamicamente -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer do Modal (Apenas visual) -->
        <div class="px-10 py-4 bg-emerald-500 flex justify-center items-center">
             <span class="text-[9px] font-black text-white uppercase tracking-[0.3em]">SiGEH - Sistema de Gestão Hospitalar</span>
        </div>
    </div>
</div>

<style>
    /* GARANTIA DE FUNCIONAMENTO DO JS ORIGINAL */
    .search-modal.close {
        display: none !important;
    }

    /* ESTILIZAÇÃO DAS LINHAS INJETADAS PELO JS */
    /* Como o JS injeta <tr> e <td> puros, usamos este CSS para dar estilo a eles */
    .table-body tr {
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .table-body tr:hover {
        background-color: rgba(16, 185, 129, 0.05); /* emerald-500 com opacidade */
    }

    .table-body tr td {
        padding: 1.25rem 1.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #363949;
    }

    .dark .table-body tr td {
        color: #edeffd;
    }

    /* Estilização da scrollbar interna */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #334155;
    }
</style>

@if ($errors->any()) @include('Admin.error') @endif
@if (session('success')) @include('Admin.success') @endif
@include('Admin.delete')

<script src="{{ asset('js/pacientes.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/filtro.js') }}"></script>
@endsection