@extends('layouts.admin')
@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <!-- Cabeçalho Moderno -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-black text-gray-800 uppercase tracking-tight">Gestão de Agendas</h1>
                <p class="text-gray-500 text-sm">Controle e acompanhamento das consultas agendadas</p>
            </div>
            {{-- <div class="flex gap-3">
                <button id="pesquisar"
                    class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                    <span class="material-symbols-sharp">search</span> Pesquisar
                </button>
                <a href="{{ route('add-agendas') }}"
                    class="flex items-center gap-2 px-6 py-2 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition font-bold">
                    <span class="material-symbols-sharp">add</span> Nova Agenda
                </a>
            </div> --}}
        </div>

        <!-- Tabela Estilizada -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest">Paciente</th>
                        <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest">Data</th>
                        <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest">Prioridade</th>
                        <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($agendas as $agenda)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-6 font-bold text-gray-700">
                                {{ $agenda->paciente->nome }} {{ $agenda->paciente->apelido }}
                            </td>
                            <td class="p-6 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($agenda->data_consulta)->format('d/m/Y') }}
                            </td>
                            <td class="p-6">
                                <span
                                    class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider 
                    {{ $agenda->prioridade == 'Vermelho' ? 'bg-red-100 text-red-600' : ($agenda->prioridade == 'Amarelo' ? 'bg-yellow-100 text-yellow-600' : 'bg-emerald-100 text-emerald-600') }}">
                                    {{ $agenda->prioridade }}
                                </span>
                            </td>
                            <td class="p-6 text-right space-x-2">
                                <a href="{{ route('show-agendas', $agenda->id) }}"
                                    class="text-blue-500 hover:text-blue-700">
                                    <span class="material-symbols-sharp text-base">visibility</span>
                                </a>
                                <a href="javascript:;" onclick="confirmDeletion(event)" dado='{{ $agenda->id }}'
                                    class="text-red-400 hover:text-red-600">
                                    <span class="material-symbols-sharp text-base">delete</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <!-- Bloco exibido quando não há agendas -->
                        <tr>
                            <td colspan="4" class="p-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <span class="material-symbols-sharp text-5xl mb-4 opacity-50">event_busy</span>
                                    <p class="font-bold text-gray-600">Nenhuma agenda encontrada</p>
                                    <p class="text-sm">Não existem consultas agendadas no momento.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            @include('Admin.paginar', ['dados' => $agendas])
        </div>
    </div>

    <!-- Modal de Pesquisa (Aprimorado) -->
    <div id="search-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white w-full max-w-2xl rounded-3xl p-8 shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-black text-xl text-gray-700">Pesquisar Agenda</h2>
                <button id="close" class="text-gray-400 hover:text-red-500"><span
                        class="material-symbols-sharp">close</span></button>
            </div>
            <!-- Seu conteúdo de pesquisa aqui -->
        </div>
    </div>
    <script>
        // Exemplo de lógica para o arquivo search-agendas.js
        document.getElementById('search-input-c').addEventListener('input', function(e) {
            const termo = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#tbody tr');

            rows.forEach(row => {
                const texto = row.innerText.toLowerCase();
                row.style.display = texto.includes(termo) ? '' : 'none';
            });
        });
    </script>
@endsection
