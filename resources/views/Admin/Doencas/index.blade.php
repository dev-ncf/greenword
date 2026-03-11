@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    
    <!-- CABEÇALHO -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white">Lista de Doenças</h1>
            <p class="text-sm text-[#7d8da1]">Catálogo de patologias e condições médicas registadas.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- Botão Pesquisar (ID mantido para o JS) -->
            <button id="pesquisar" class="p-3 bg-white dark:bg-[#202528] text-emerald-500 rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800 hover:bg-emerald-50 transition-all group">
                <span class="material-symbols-sharp group-hover:scale-110 transition-transform">search</span>
            </button>
            
            <!-- Botão Adicionar -->
            <a href="{{ route('add-doencas') }}" class="flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-lg shadow-emerald-200 dark:shadow-none transition-all hover:scale-[1.02] active:scale-95">
                <span class="material-symbols-sharp text-lg">add</span>
                Nova Doença
            </a>
        </div>
    </div>

    <!-- TABELA DE DOENÇAS -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[#7d8da1] text-[11px] uppercase tracking-[0.2em] font-black border-b border-gray-50 dark:border-gray-800">
                        <th class="px-8 py-5">Nome da Patologia</th>
                        <th class="px-8 py-5">Descrição Resumida</th>
                        <th class="px-8 py-5 text-center">Acções</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach ($doencas as $doenca)
                        <tr class="hover:bg-emerald-50/30 dark:hover:bg-emerald-900/5 transition-all group">
                            <!-- Nome com Ícone -->
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600">
                                        <span class="material-symbols-sharp text-lg">medical_information</span>
                                    </div>
                                    <span class="font-bold text-sm text-[#363949] dark:text-white tracking-tight">{{ $doenca->nome }}</span>
                                </div>
                            </td>

                            <!-- Descrição -->
                            <td class="px-8 py-5">
                                <span class="text-xs text-[#677483] dark:text-gray-400 leading-relaxed max-w-xs block italic">
                                    {{ $doenca->truncateWords($doenca->descricao, 8) }}
                                </span>
                            </td>

                            <!-- Ações -->
                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('show-doenca', $doenca->id) }}" class="p-2 text-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-xl transition-all" title="Ver Detalhes">
                                        <span class="material-symbols-sharp text-lg">visibility</span>
                                    </a>
                                    
                                    <a href="{{ route('edit-doenca', $doenca->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all" title="Editar">
                                        <span class="material-symbols-sharp text-lg">edit</span>
                                    </a>

                                    <button id="delete-{{ $doenca->id }}" rota="doencas/destroy" dado='{{ $doenca->id }}' onclick="return confirmDeletion(event)" class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all" title="Eliminar">
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
            @php $dados = $doencas; @endphp
            @include('Admin.paginar')
        </div>
    </div>

    <!-- MODAL DE PESQUISA (ESTRUTURA ORIGINAL PRESERVADA) -->
    <div class="search-modal close fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-[#202528] w-full max-w-4xl rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col max-h-[90vh] animate-in zoom-in duration-200">
            
            <!-- Modal Head -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-transparent">
                <h3 class="text-xl font-black text-emerald-600 flex items-center gap-2 uppercase tracking-tight">
                    <span class="material-symbols-sharp">search</span> Pesquisar Doenças
                </h3>
                <button class="close p-2 hover:bg-red-50 text-red-500 rounded-full transition-colors" id="close">
                    <span class="material-symbols-sharp">close</span>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="modal-main p-8 overflow-y-auto">
                <div class="content">
                    <div class="content-s space-y-6" data-doencas="{{ $todasDoencas }}">
                        
                        <!-- Barra de Busca -->
                        <div class="search relative group">
                            <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500">search</span>
                            <input type="text" class="input w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-[#181a1e] border-2 border-transparent focus:border-emerald-500 rounded-2xl outline-none transition-all text-sm font-medium" 
                                   id="search-input-c" placeholder="Pesquise por: nome ou descrição...">
                        </div>

                        <!-- Resultados -->
                        <div class="results mt-6 border border-gray-100 dark:border-gray-800 rounded-2xl overflow-hidden">
                            <div class="item overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-gray-50 dark:bg-gray-800/50 text-[10px] font-black uppercase text-[#7d8da1] tracking-widest">
                                        <tr>
                                            <th class="px-6 py-4">Nome da Doença</th>
                                            <th class="px-6 py-4">Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800 text-sm font-medium">
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
</style>


@include('Admin.delete')

<script src="{{ asset('js/pacientes.js') }}"></script>
<script src="{{ asset('js/search-doencas.js') }}"></script>
@endsection