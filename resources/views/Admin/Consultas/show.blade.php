@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-[1200px] mx-auto">
    
    <!-- Header da Página -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white">Resumo da Consulta</h1>
            <p class="text-sm text-[#7d8da1]">Visualizando detalhes do atendimento clínico.</p>
        </div>
        <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-[#202528] border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50 transition-all">
            <span class="material-symbols-sharp text-lg">print</span>
            Imprimir
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- COLUNA ESQUERDA: Perfil do Paciente -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-[#202528] rounded-[2rem] p-8 shadow-sm border border-gray-100 dark:border-gray-800 flex flex-col items-center">
                <div class="relative mb-6">
                    <img src="{{ asset('img/1-intro-photo-final.webp') }}" class="w-32 h-32 rounded-full object-cover ring-4 ring-[#7380ec] p-1">
                    <div class="absolute bottom-0 right-0 bg-[#7380ec] text-white p-2 rounded-full shadow-lg">
                        <span class="material-symbols-sharp text-sm">person</span>
                    </div>
                </div>

                @php
                    $paciente = $consulta->paciente;
                    $ano = \Carbon\Carbon::parse($paciente->data_nascimento)->year;
                @endphp

                <h2 class="text-xl font-black text-center">{{ $paciente->nome }} {{ $paciente->apelido }}</h2>
                <p class="text-[#7d8da1] text-sm mb-6">{{ $paciente->contacto }}</p>

                <div class="w-full space-y-4 pt-6 border-t border-gray-50 dark:border-gray-700">
                    <div class="flex justify-between">
                        <span class="text-xs font-bold text-gray-400 uppercase">Idade</span>
                        <span class="font-bold">{{ date('Y') - $ano }} anos</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs font-bold text-gray-400 uppercase">Gênero</span>
                        <span class="font-bold">{{ $paciente->genero == 'M' ? 'Masculino' : 'Feminino' }}</span>
                    </div>
                </div>

                @if ($proximaAgenda)
                    <div class="mt-8 w-full p-4 bg-blue-50 dark:bg-blue-900/20 rounded-2xl border border-blue-100 dark:border-blue-800">
                        <p class="text-[10px] font-black text-blue-500 uppercase mb-1 tracking-tighter">Próximo Agendamento</p>
                        <a href="{{ route('show-agendas', $proximaAgenda->id) }}" class="flex items-center justify-between group">
                            <span class="text-sm font-bold text-blue-700 dark:text-blue-300">{{ \Carbon\Carbon::parse($proximaAgenda->data)->format('d/m/Y') }}</span>
                            <span class="material-symbols-sharp text-blue-500 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- COLUNA DIREITA: Detalhes Médicos -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card de Detalhes Principais -->
            <div class="bg-white dark:bg-[#202528] rounded-[2rem] p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-3 mb-8 border-b border-gray-50 dark:border-gray-700 pb-4">
                    <span class="material-symbols-sharp text-[#7380ec] text-3xl">medical_information</span>
                    <h3 class="text-lg font-black uppercase tracking-tight">Informações Clínicas</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Data e Médico -->
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                <span class="material-symbols-sharp text-[#7d8da1]">calendar_month</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase">Data da Consulta</p>
                                <p class="font-bold text-[#363949] dark:text-white">{{ \Carbon\Carbon::parse($consulta->data_consulta)->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                <span class="material-symbols-sharp text-[#7d8da1]">stethoscope</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase">Médico Responsável</p>
                                <p class="font-bold text-[#363949] dark:text-white">{{ $consulta->medico->nome }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Nível e Prioridade -->
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                <span class="material-symbols-sharp text-[#7d8da1]">priority_high</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase">Nível de Triagem</p>
                                <span class="inline-block mt-1 px-3 py-1 rounded-full text-[10px] font-black uppercase 
                                    {{ $consulta->nivel == 'Grave' ? 'bg-red-100 text-red-500' : 'bg-green-100 text-green-500' }}">
                                    {{ $consulta->nivel }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                <span class="material-symbols-sharp text-[#7d8da1]">emergency</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase">Doenças Identificadas</p>
                                <p class="font-bold text-[#363949] dark:text-white">
                                    @foreach ($consulta->doencas as $doenca)
                                        <span class="inline-block bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded text-xs mr-1 mt-1">{{ $doenca->nome }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Observações -->
                <div class="mt-10 p-6 bg-gray-50 dark:bg-[#181a1e] rounded-[1.5rem] border-l-4 border-[#7380ec]">
                    <h4 class="text-xs font-black text-gray-400 uppercase mb-3 flex items-center gap-2">
                        <span class="material-symbols-sharp text-sm">notes</span>
                        Observações e Recomendações
                    </h4>
                    <p class="text-sm leading-relaxed text-[#677483] dark:text-gray-300 italic">
                        "{{ $consulta->observacoes ?? 'Nenhuma observação registrada para esta consulta.' }}"
                    </p>
                </div>
            </div>

            <!-- Botão de Voltar -->
            <div class="flex justify-end">
                <a href="{{ url()->previous() }}" class="text-sm font-bold text-[#7d8da1] hover:text-[#7380ec] flex items-center gap-2 transition-colors">
                    <span class="material-symbols-sharp">arrow_back</span>
                    Voltar para a lista
                </a>
            </div>
        </div>
    </div>
</div>
@endsection