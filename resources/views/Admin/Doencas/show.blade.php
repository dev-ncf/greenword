@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    
    <!-- Cabeçalho de Navegação -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-white dark:bg-[#202528] rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800">
                <span class="material-symbols-sharp text-emerald-500 text-3xl">medical_information</span>
            </div>
            <div>
                <h1 class="text-2xl font-black text-[#363949] dark:text-white uppercase tracking-tight">Ficha da Patologia</h1>
                <p class="text-sm text-[#7d8da1]">Consulta detalhada das informações técnicas.</p>
            </div>
        </div>
        
        <a href="{{ route('doencas') }}" class="flex items-center gap-2 text-sm font-bold text-[#7d8da1] hover:text-emerald-500 transition-colors">
            <span class="material-symbols-sharp">arrow_back</span>
            Voltar à lista
        </a>
    </div>

    <!-- Card Principal de Detalhes -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-gray-50 dark:border-gray-800 relative overflow-hidden">
        
        <!-- Detalhe decorativo no fundo -->
        <div class="absolute top-0 right-0 p-8 opacity-5 dark:opacity-10">
            <span class="material-symbols-sharp text-[150px] text-emerald-500">description</span>
        </div>

        <div class="relative z-10 space-y-10">
            
            <!-- Nome da Doença -->
            <div class="space-y-1">
                <span class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1]">Nome da Doença</span>
                <h2 class="text-4xl font-black text-emerald-600 dark:text-emerald-400">{{ $doenca->nome }}</h2>
            </div>

            <!-- Divisor -->
            <div class="w-20 h-1.5 bg-emerald-500 rounded-full"></div>

            <!-- Descrição -->
            <div class="space-y-4">
                <span class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] block">Descrição e Notas Clínicas</span>
                
                <div class="bg-emerald-50/30 dark:bg-[#181a1e] p-6 md:p-8 rounded-[2rem] border border-emerald-50 dark:border-gray-700 shadow-inner">
                    <p class="text-[#677483] dark:text-gray-300 leading-relaxed italic text-lg whitespace-pre-line">
                        "{{ $doenca->descricao ?? 'Nenhuma descrição detalhada registada para esta patologia.' }}"
                    </p>
                </div>
            </div>

            <!-- Ações -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <a href="{{ route('edit-doenca', $doenca->id) }}" 
                   class="flex-1 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black rounded-2xl shadow-lg shadow-emerald-100 dark:shadow-none transition-all hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-2 tracking-widest uppercase text-xs">
                    <span class="material-symbols-sharp">edit</span>
                    Editar Informações
                </a>
                
                <button onclick="window.print()" 
                   class="flex-1 py-4 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-bold rounded-2xl text-center hover:bg-gray-200 dark:hover:bg-gray-700 transition-all flex items-center justify-center gap-2 text-xs uppercase tracking-widest">
                    <span class="material-symbols-sharp">print</span>
                    Imprimir Ficha
                </button>
            </div>
        </div>
    </div>

    <!-- Sugestão de Rodapé -->
    <div class="text-center">
        <p class="text-[10px] text-[#7d8da1] font-medium uppercase tracking-[0.2em]">SiGEH - Sistema de Gestão Hospitalar</p>
    </div>

</div>



@endsection