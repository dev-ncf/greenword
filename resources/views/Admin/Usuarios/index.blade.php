@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    
    <!-- CABEÇALHO -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white uppercase tracking-tight">Gestão de Utilizadores</h1>
            <p class="text-sm text-[#7d8da1]">Administre as contas e níveis de acesso ao sistema SiGEH.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- Botão Pesquisar (ID mantido) -->
            <button id="pesquisar" class="p-3 bg-white dark:bg-[#202528] text-emerald-500 rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800 hover:bg-emerald-50 transition-all group">
                <span class="material-symbols-sharp group-hover:scale-110 transition-transform">search</span>
            </button>
            
            <!-- Botão Adicionar -->
            <a href="{{ route('add-usuarios') }}" class="flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-lg shadow-emerald-200 dark:shadow-none transition-all hover:scale-[1.02] active:scale-95 text-sm uppercase tracking-widest">
                <span class="material-symbols-sharp text-lg">person_add</span>
                Novo Usuário
            </a>
        </div>
    </div>

    <!-- TABELA PRINCIPAL DE USUÁRIOS -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[#7d8da1] text-[11px] uppercase tracking-[0.2em] font-black border-b border-gray-50 dark:border-gray-800">
                        <th class="px-8 py-5">Nome do Utilizador</th>
                        <th class="px-8 py-5">Endereço de Email</th>
                        <th class="px-8 py-5 text-center">Nível de Acesso</th>
                        <th class="px-8 py-5 text-center">Acções</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach ($usuarios as $usuario)
                        <tr class="hover:bg-emerald-50/30 dark:hover:bg-emerald-900/5 transition-all group">
                            <!-- Nome com Iniciais -->
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 font-bold text-xs uppercase">
                                        {{ substr($usuario->name, 0, 2) }}
                                    </div>
                                    <span class="font-bold text-sm text-[#363949] dark:text-white tracking-tight">{{ $usuario->name }}</span>
                                </div>
                            </td>

                            <!-- Email -->
                            <td class="px-8 py-5 text-sm text-[#677483] font-medium italic">
                                {{ $usuario->email }}
                            </td>

                            <!-- Nível Badge -->
                            <td class="px-8 py-5 text-center">
                                @if($usuario->nivel == 'A')
                                    <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase bg-emerald-100 text-emerald-600 border border-emerald-200">Administrador</span>
                                @else
                                    <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase bg-gray-100 text-gray-500 border border-gray-200">Operador</span>
                                @endif
                            </td>

                            <!-- Ações -->
                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('edit-usuarios', $usuario->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all" title="Editar Usuário">
                                        <span class="material-symbols-sharp text-lg">edit</span>
                                    </a>

                                    <button id="delete-{{ $usuario->id }}" rota="usuarios/destroy" dado='{{ $usuario->id }}' onclick="return confirmDeletion(event)" class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all" title="Remover Usuário">
                                        <span class="material-symbols-sharp text-lg">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 border-t border-gray-50 dark:border-gray-800">
            @php $dados = $usuarios; @endphp
            @include('Admin.paginar')
        </div>
    </div>

    <!-- MODAL DE PESQUISA (ESTRUTURA COMPATÍVEL COM JS) -->
    <div class="search-modal close fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white dark:bg-[#202528] w-full max-w-4xl rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col max-h-[85vh] animate-in zoom-in duration-200">
            
            <!-- Modal Head -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-transparent">
                <h3 class="text-xl font-black text-emerald-600 flex items-center gap-3 uppercase tracking-tight">
                    <span class="material-symbols-sharp">manage_accounts</span> Pesquisar Usuários
                </h3>
                <button class="close p-2 hover:bg-red-50 text-red-500 rounded-full transition-colors" id="close">
                    <span class="material-symbols-sharp">close</span>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="modal-main p-8 overflow-y-auto">
                <div class="content">
                    <!-- IDs e Data-Attributes originais preservados para o search-user.js -->
                    <div class="content-s space-y-6" id="content-s-user" data-usuarios='{{ $todosUsuarios }}'>
                        
                        <!-- Barra de Busca -->
                        <div class="search relative group">
                            <span class="material-symbols-sharp absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">search</span>
                            <input type="text" class="input w-full pl-14 pr-6 py-4 bg-gray-50 dark:bg-[#181a1e] border-2 border-transparent focus:border-emerald-500 rounded-2xl outline-none transition-all text-sm font-semibold" 
                                   id="input-user" placeholder="Pesquise por: nome ou email..." name="search">
                        </div>

                        <!-- Resultados -->
                        <div class="results mt-6 border border-gray-100 dark:border-gray-800 rounded-2xl overflow-hidden bg-white dark:bg-[#1f2327]">
                            <div class="item overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead class="bg-gray-100 dark:bg-gray-800/50 text-[10px] font-black uppercase text-[#7d8da1] tracking-widest">
                                        <tr>
                                            <th class="px-6 py-4">Nome Completo</th>
                                            <th class="px-6 py-4">Endereço de Email</th>
                                            <th class="px-6 py-4 text-center">Nível</th>
                                        </tr>
                                    </thead>
                                    <!-- ID table-body-user mantido para injeção via JS -->
                                    <tbody id="table-body-user" class="divide-y divide-gray-50 dark:divide-gray-800">
                                        <!-- Resultados dinâmicos aqui -->
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
    /* GARANTIA DE FUNCIONAMENTO DO MODAL */
    .search-modal.close {
        display: none !important;
    }

    /* ESTILO PARA DADOS DINÂMICOS (INJETADOS PELO JS) */
    #table-body-user tr td {
        padding: 1.2rem 1.5rem !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        color: #363949 !important; /* Cor cinza escuro no light mode */
    }

    .dark #table-body-user tr td {
        color: #f3f4f6 !important; /* Cor clara no dark mode */
    }

    #table-body-user tr:hover {
        background-color: rgba(16, 185, 129, 0.05) !important;
    }
</style>

@if ($errors->any()) @include('Admin.error') @endif
@if (session('success')) @include('Admin.success') @endif
@include('Admin.delete')

<script src="{{ asset('js/pacientes.js') }}"></script>
<script src="{{ asset('js/search-user.js') }}"></script>
@endsection