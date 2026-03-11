@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">
    
    <!-- Cabeçalho -->
    <div class="flex items-center gap-4">
        <div class="p-3 bg-white dark:bg-[#202528] rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800">
            <span class="material-symbols-sharp text-emerald-500 text-3xl">health_metrics</span>
        </div>
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white uppercase tracking-tight">Cadastro de Doenças</h1>
            <p class="text-sm text-[#7d8da1]">Adicione novas patologias ao catálogo médico do sistema.</p>
        </div>
    </div>

    <!-- Card do Formulário -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-gray-50 dark:border-gray-800">
        
        <form action="{{ route('store-doencas') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Campo: Nome da Doença -->
            <div class="space-y-2">
                <label for="nome" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Nome da Doença</label>
                <div class="relative group">
                    <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">label</span>
                    <input type="text" name="nome" required placeholder="Ex: Malária, Diabetes..."
                        class="w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                </div>
            </div>

            <!-- Campo: Descrição -->
            <div class="space-y-2">
                <label for="descricao" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Descrição / Notas</label>
                <div class="relative group">
                    <span class="material-symbols-sharp absolute left-4 top-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors">description</span>
                    <!-- Mudei para textarea pois descrições tendem a ser longas, mas mantive o estilo -->
                    <textarea name="descricao" required placeholder="Breve resumo sobre os sintomas ou tratamento..."
                        class="w-full pl-12 pr-4 py-4 h-32 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium italic"></textarea>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="flex flex-col md:flex-row gap-4 pt-4">
                <button type="submit" 
                    class="flex-1 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black rounded-2xl shadow-lg shadow-emerald-100 dark:shadow-none transition-all hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-2 tracking-widest uppercase text-xs">
                    CADASTRAR DOENÇA
                    <span class="material-symbols-sharp">add_task</span>
                </button>
                
                <a href="{{ route('doencas') }}" 
                    class="flex-1 py-4 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-bold rounded-2xl text-center hover:bg-gray-200 dark:hover:bg-gray-700 transition-all flex items-center justify-center gap-2 text-xs uppercase tracking-widest">
                    CANCELAR
                </a>
            </div>

        </form>
    </div>

    <!-- Alertas -->
    <div class="fixed bottom-8 right-8 z-50">
        
    </div>

</div>
@endsection