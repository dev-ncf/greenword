@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Cabeçalho com Botão de Ação -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Ficha do Paciente</h1>
            <p class="text-sm text-gray-500">Gerencie as informações detalhadas e o histórico clínico.</p>
        </div>
        
        <a href="{{route('add-consulta',$paciente->id)}}" 
           class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#7380ec] hover:bg-[#5a65c1] text-white font-semibold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
            <span class="material-symbols-sharp">add</span>
            Marcar Nova Consulta
        </a>
    </div>

    <!-- Grid Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Coluna Esquerda: Card de Perfil -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-[#202528] rounded-[2rem] p-8 shadow-sm border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
                <div class="relative">
                    <img src="{{ asset('img/1-intro-photo-final.webp') }}" 
                         alt="Foto do Paciente"
                         class="w-40 h-40 rounded-full object-cover ring-4 ring-[#41f1b6] p-1 shadow-xl">
                    <span class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 border-4 border-white dark:border-[#202528] rounded-full"></span>
                </div>
                
                <h2 class="mt-6 text-xl font-extrabold">{{ $paciente->nome }} {{ $paciente->apelido }}</h2>
                <p class="text-[#7d8da1] font-medium">{{ $paciente->contacto }}</p>

                <div class="w-full mt-8 pt-6 border-t border-gray-50 dark:border-gray-700 space-y-4 text-left">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-400 uppercase font-bold text-[10px] tracking-widest">Idade</span>
                        @php $ano = \Carbon\Carbon::parse($paciente->data_nascimento)->year; @endphp
                        <span class="font-bold">{{ date('Y') - $ano }} anos</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-400 uppercase font-bold text-[10px] tracking-widest">Gênero</span>
                        <span class="font-bold">{{ $paciente->genero == 'M' ? 'Masculino' : 'Feminino' }}</span>
                    </div>
                </div>
            </div>

            <!-- Card de Doenças -->
            <div class="bg-white dark:bg-[#202528] rounded-[2rem] p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <span class="material-symbols-sharp text-[#ff7782]">emergency</span>
                    Condições Médicas
                </h3>
                <div class="flex flex-wrap gap-2">
                    @forelse ($paciente->doencas as $doenca)
                        <span class="px-3 py-1 bg-red-50 dark:bg-red-900/20 text-red-500 text-xs font-bold rounded-full border border-red-100 dark:border-red-800">
                            {{ $doenca->nome }}
                        </span>
                    @empty
                        <p class="text-sm text-gray-400 italic">Nenhuma doença registrada.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Coluna Direita: Histórico e Agendas -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card Próxima Consulta -->
            @if ($proximaAgenda)
            <div class="bg-gradient-to-r from-[#7380ec] to-[#41f1b6] rounded-[2rem] p-1 text-white shadow-xl">
                <div class="bg-white dark:bg-[#202528] rounded-[1.9rem] p-6 flex flex-col md:flex-row items-center justify-between gap-4 text-[#363949] dark:text-white">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-2xl text-[#7380ec]">
                            <span class="material-symbols-sharp text-3xl">event_upcoming</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase">Próxima Consulta Agendada</p>
                            <h4 class="text-xl font-black">{{ \Carbon\Carbon::parse($proximaAgenda->data)->format('d/m/Y') }} às {{ $proximaAgenda->hora }}</h4>
                        </div>
                    </div>
                    <a href="{{ route('show-agendas', $proximaAgenda->id) }}" 
                       class="px-6 py-2 bg-[#363949] dark:bg-white dark:text-[#363949] text-white rounded-xl text-sm font-bold hover:scale-105 transition-transform">
                        Ver Detalhes
                    </a>
                </div>
            </div>
            @endif

            <!-- Histórico de Consultas -->
            <div class="bg-white dark:bg-[#202528] rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="p-8 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-bold">Histórico Clínico</h3>
                    <span class="text-xs bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-full font-bold text-gray-500">
                        {{ $paciente->consultas->count() }} Atendimentos
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[#7d8da1] text-xs uppercase tracking-wider">
                                <th class="px-8 py-4 font-bold">Data da Consulta</th>
                                <th class="px-8 py-4 font-bold">Tipo / Status</th>
                                <th class="px-8 py-4 font-bold text-right">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                            @forelse ($paciente->consultas as $consulta)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-sharp text-gray-300">calendar_today</span>
                                        <span class="font-semibold">{{ \Carbon\Carbon::parse($consulta->data_consulta)->format('d/m/Y') }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 text-[10px] font-black rounded-lg uppercase">
                                        Concluída
                                    </span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <a href="{{ route('show-consulta', $consulta->id) }}" class="text-[#7380ec] hover:underline font-bold text-sm">
                                        Ver Relatório
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-12 text-center text-gray-400 italic">
                                    Nenhum histórico de consulta encontrado.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Se você tiver um input de data nesta tela no futuro (ex: em um modal), 
    // este script será útil. Se não houver, pode remover.
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