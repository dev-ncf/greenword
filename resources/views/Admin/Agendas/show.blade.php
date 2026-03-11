@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Cabeçalho e Ações -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <a href="javascript:history.back()" class="flex items-center gap-2 text-[#7380ec] font-bold text-sm mb-2 hover:gap-3 transition-all">
                <span class="material-symbols-sharp">arrow_back</span>
                Voltar para lista
            </a>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Detalhes do Agendamento</h1>
            <p class="text-sm text-gray-500">Informações sobre a consulta programada.</p>
        </div>
 @if (auth()->check() && auth()->user()->nivel == 'B')
        <!-- Botão Principal: Iniciar Consulta -->
        <a href="{{ route('add-consulta', $agenda->paciente_id) }}" 
           class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-[#7380ec] hover:bg-[#5a65c1] text-white font-bold rounded-2xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none hover:scale-105">
            <span class="material-symbols-sharp">clinical_notes</span>
            Iniciar Atendimento
        </a>
@endif
    </div>

    <!-- Grid de Conteúdo -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Coluna Esquerda: Informações do Paciente e Status -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-[#202528] rounded-[2rem] p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 dark:bg-blue-900/30 text-[#7380ec] rounded-full mb-4">
                        <span class="material-symbols-sharp text-4xl">person</span>
                    </div>
                    <h2 class="text-xl font-black text-gray-800 dark:text-white">{{ $agenda->paciente->nome ?? $agenda->paciente }}</h2>
                    <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 text-[10px] font-black rounded-lg uppercase tracking-wider">
                        Agendado
                    </span>
                </div>

                <div class="mt-8 space-y-4 pt-6 border-t border-gray-50 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 uppercase font-bold text-[10px] tracking-widest">Data</span>
                        <span class="font-bold text-gray-700 dark:text-gray-200 italic">
                            {{ \Carbon\Carbon::parse($agenda->data)->format('d/m/Y') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 uppercase font-bold text-[10px] tracking-widest">Horário</span>
                        <span class="font-bold text-gray-700 dark:text-gray-200">
                            {{ $agenda->hora }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card de Alerta -->
            {{-- <div class="bg-gradient-to-br from-[#ffbb55] to-[#ff7782] rounded-[2rem] p-6 text-white shadow-lg">
                <div class="flex items-start gap-4">
                    <span class="material-symbols-sharp text-3xl">priority_high</span>
                    <div>
                        <h4 class="font-bold">Lembrete</h4>
                        <p class="text-sm opacity-90">Confirme a presença do paciente com 24h de antecedência.</p>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Coluna Direita: Descrição e Notas -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-[#202528] rounded-[2rem] p-8 shadow-sm border border-gray-100 dark:border-gray-800 h-full">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-sharp text-[#7380ec]">description</span>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Descrição do Agendamento</h3>
                </div>
                
                <div class="bg-gray-50 dark:bg-[#181a1e] rounded-2xl p-6 min-h-[200px] text-gray-600 dark:text-gray-300 leading-relaxed border border-gray-100 dark:border-gray-700">
                    @if($agenda->descricao)
                        {{ $agenda->descricao }}
                    @else
                        <span class="italic text-gray-400">Nenhuma descrição detalhada fornecida para este agendamento.</span>
                    @endif
                </div>

                <!-- Botões de Ação Secundários -->
                <div class="mt-8 flex flex-wrap gap-4">
                    <button class="px-6 py-3 border-2 border-red-100 dark:border-red-900/30 text-red-500 font-bold rounded-xl hover:bg-red-50 dark:hover:bg-red-900/10 transition-all flex items-center gap-2">
                        <span class="material-symbols-sharp">cancel</span>
                        Cancelar Agenda
                    </button>
                    <button class="px-6 py-3 border-2 border-gray-100 dark:border-gray-700 text-gray-500 font-bold rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-all flex items-center gap-2">
                        <span class="material-symbols-sharp">edit</span>
                        Editar Dados
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Script para o input de data (se necessário nesta tela)
    const dataInput = document.getElementById("dataNascimento");
    if(dataInput) {
        const hoje = new Date();
        hoje.setDate(hoje.getDate() - 1);
        const dia = String(hoje.getDate()).padStart(2, '0');
        const mes = String(hoje.getMonth() + 1).padStart(2, '0');
        const ano = hoje.getFullYear();
        dataInput.max = `${ano}-${mes}-${dia}`;
    }
</script>
@endsection