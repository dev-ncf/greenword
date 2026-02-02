@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    
    <!-- Título e Boas-vindas -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-[#363949] dark:text-white">Dashboard</h1>
            <p class="text-[#7d8da1]">Bem-vindo de volta ao sistema de gestão SiGEH.</p>
        </div>
        <div class="bg-white dark:bg-[#202528] p-2 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800">
            <span class="text-sm font-bold px-4 tracking-wide">{{ date('d M, Y') }}</span>
        </div>
    </div>

    <!-- SEÇÃO DE INSIGHTS (CARDS) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Card: Total Atendimentos -->
        <div class="bg-white dark:bg-[#202528] p-6 rounded-[2rem] shadow-sm hover:shadow-xl transition-all border border-gray-50 dark:border-gray-800 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-2xl text-[#7380ec]">
                    <span class="material-symbols-sharp">analytics</span>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black uppercase text-green-500 bg-green-50 px-2 py-1 rounded-md">+12%</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-[#7d8da1] text-sm font-bold uppercase tracking-wider">Total Atendimentos</h3>
                    <h1 class="text-3xl font-black mt-1">1,540</h1>
                </div>
                <!-- Gráfico Radial Pequeno -->
                <div id="chart-atendimentos" class="w-24"></div>
            </div>
            <p class="text-[10px] text-[#7d8da1] mt-4 font-medium italic">* Dados atualizados há 5 min</p>
        </div>

        <!-- Card: Pacientes Novos -->
        <div class="bg-white dark:bg-[#202528] p-6 rounded-[2rem] shadow-sm hover:shadow-xl transition-all border border-gray-50 dark:border-gray-800">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-2xl text-[#41f1b6]">
                    <span class="material-symbols-sharp">group</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-[#7d8da1] text-sm font-bold uppercase tracking-wider">Novos Pacientes</h3>
                    <h1 class="text-3xl font-black mt-1">84</h1>
                </div>
                <div id="chart-pacientes" class="w-24"></div>
            </div>
            <p class="text-[10px] text-[#7d8da1] mt-4 font-medium italic">Meta mensal: 100</p>
        </div>

        <!-- Card: Taxa de Recuperação (ou outro dado) -->
        <div class="bg-white dark:bg-[#202528] p-6 rounded-[2rem] shadow-sm hover:shadow-xl transition-all border border-gray-50 dark:border-gray-800">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-2xl text-[#ff7782]">
                    <span class="material-symbols-sharp">medical_services</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-[#7d8da1] text-sm font-bold uppercase tracking-wider">Casos Graves</h3>
                    <h1 class="text-3xl font-black mt-1">12</h1>
                </div>
                <div id="chart-graves" class="w-24"></div>
            </div>
            <p class="text-[10px] text-[#7d8da1] mt-4 font-medium italic">Requer atenção imediata</p>
        </div>
    </div>

    <!-- SEÇÃO: TABELA DE ÚLTIMOS ATENDIMENTOS -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] p-8 shadow-sm border border-gray-50 dark:border-gray-800">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <h2 class="text-xl font-black text-[#363949] dark:text-white uppercase tracking-tight">Últimos Atendimentos</h2>
            <a href="#" class="text-sm font-bold text-[#7380ec] hover:underline">Ver relatório completo</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[#7d8da1] text-[11px] uppercase tracking-[0.2em] font-black border-b border-gray-50 dark:border-gray-700">
                        <th class="pb-4 px-4">Paciente</th>
                        <th class="pb-4 px-4">Doenças</th>
                        <th class="pb-4 px-4">Gênero</th>
                        <th class="pb-4 px-4">Idade</th>
                        <th class="pb-4 px-4">Estado</th>
                        <th class="pb-4 px-4 text-right">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach ($consultas as $consulta)
                    <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-all">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-[10px] font-bold text-[#7380ec]">
                                    {{ substr($consulta->paciente->nome, 0, 1) }}{{ substr($consulta->paciente->apelido, 0, 1) }}
                                </div>
                                <span class="font-bold text-sm">{{ $consulta->paciente->nome }} {{ $consulta->paciente->apelido }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-xs text-gray-500 font-medium">
                            {{ $consulta->doencas->pluck('nome')->implode(', ') }}
                        </td>
                        <td class="py-4 px-4 text-sm">{{ $consulta->paciente->genero == 'M' ? 'M' : 'F' }}</td>
                        @php $ano = \Carbon\Carbon::parse($consulta->paciente->data_nascimento)->year; @endphp
                        <td class="py-4 px-4 text-sm font-bold">{{ date('Y') - $ano }}</td>
                        <td class="py-4 px-4">
                            @php
                                $statusClasses = [
                                    'Pendente' => 'bg-orange-100 text-orange-600 dark:bg-orange-900/20',
                                    'Atendido' => 'bg-green-100 text-green-600 dark:bg-green-900/20',
                                    'Cancelado' => 'bg-red-100 text-red-600 dark:bg-red-900/20',
                                ];
                                $class = $statusClasses[$consulta->estado] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase {{ $class }}">
                                {{ $consulta->estado }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <a href="{{ route('show-consulta', $consulta->id) }}" class="p-2 hover:bg-white dark:hover:bg-[#181a1e] rounded-lg transition-all inline-block shadow-sm">
                                <span class="material-symbols-sharp text-lg text-[#7380ec]">visibility</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SCRIPTS PARA GRÁFICOS FUNCIONAIS -->
<script>
    const optionsAtendimentos = {
        series: [80], // Valor dinâmico aqui
        chart: { height: 120, type: 'radialBar' },
        plotOptions: {
            radialBar: {
                hollow: { size: '50%' },
                dataLabels: { name: { show: false }, value: { fontSize: '14px', fontWeight: '900', offsetY: 5 } }
            }
        },
        colors: ['#7380ec'],
        stroke: { lineCap: 'round' }
    };
    new ApexCharts(document.querySelector("#chart-atendimentos"), optionsAtendimentos).render();

    const optionsPacientes = { ...optionsAtendimentos, series: [65], colors: ['#41f1b6'] };
    new ApexCharts(document.querySelector("#chart-pacientes"), optionsPacientes).render();

    const optionsGraves = { ...optionsAtendimentos, series: [25], colors: ['#ff7782'] };
    new ApexCharts(document.querySelector("#chart-graves"), optionsGraves).render();
</script>
@endsection