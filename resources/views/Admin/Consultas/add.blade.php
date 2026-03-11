@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 pb-12">
    
    <!-- Cabeçalho -->
    <div class="flex items-center gap-4">
        <div class="p-3 bg-white dark:bg-[#202528] rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800">
            <!-- Ícone corrigido para medical_services -->
            <span class="material-symbols-sharp text-emerald-500 text-3xl">medical_services</span>
        </div>
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white uppercase tracking-tight">Registo de Consultas</h1>
            <p class="text-sm text-[#7d8da1]">Paciente: <span class="font-bold text-emerald-600">{{ $paciente->nome }} {{ $paciente->apelido }}</span></p>
        </div>
    </div>

    <form action="{{ route('store-consultas') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        <!-- COLUNA ESQUERDA: Dados Clínicos -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] p-8 shadow-sm border border-gray-50 dark:border-gray-800 space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Paciente (Fixado) -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[11px] font-black uppercase tracking-widest text-gray-400 ml-2">Paciente</label>
                        <select name="paciente_id" class="w-full  px-4 py-1 bg-emerald-50/50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-800 rounded-2xl outline-none font-bold text-emerald-700 dark:text-emerald-400 appearance-none">
                            <option value="{{ $paciente->id }}">{{ $paciente->nome }} {{ $paciente->apelido }}</option>
                        </select>
                    </div>

                    <!-- Médico -->
                    <div class="space-y-2">
                        <label class="text-[11px] font-black uppercase tracking-widest text-gray-400 ml-2">Médico</label>
                        <select name="medico_id" required class="w-full px-4 py-1 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition-all text-sm font-medium">
                            <option value="" disabled selected>Selecione o Médico</option>
                            @foreach ($medicos as $medico)
                                <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data -->
                    <div class="space-y-2">
                        <label class="text-[11px] font-black uppercase tracking-widest text-gray-400 ml-2">Data da Consulta</label>
                        <input type="date" name="data_consulta" required class="w-full px-4 py-1 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Sintomas -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase tracking-widest text-gray-400 ml-2 ">Sintomas / Queixas</label>
                    <textarea name="sintomas"  placeholder="Principais queixas..." class="w-full px-5 h-32 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-3xl outline-none focus:ring-2 focus:ring-emerald-500 transition-all text-sm italic"></textarea>
                </div>

                <!-- Observações -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase tracking-widest text-gray-400 ml-2">Observações</label>
                    <textarea name="observacoes"  placeholder="Descrição da consulta..." class="w-full px-5 h-32 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-3xl outline-none focus:ring-2 focus:ring-emerald-500 transition-all text-sm italic"></textarea>
                </div>
            </div>
        </div>

        <!-- COLUNA DIREITA: Triagem e Ações -->
        <div class="space-y-6" >
            
            <!-- Nível -->
            <div class="bg-white dark:bg-[#202528] p-8 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-800">
                <label class="text-[11px] font-black uppercase tracking-widest text-gray-400 block mb-4 ml-2">Nível de Prioridade</label>
                <select name="nivel" required class="w-full px-4 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl font-black text-center uppercase tracking-widest text-xs outline-none focus:border-emerald-500 transition-all">
                    <option value="" disabled selected>Selecione o nível</option>
                    <option value="Verde" class="text-green-500">🟢 Verde</option>
                    <option value="Amarelo" class="text-yellow-500">🟡 Amarelo</option>
                    <option value="Laranja" class="text-orange-500">🟠 Laranja</option>
                    <option value="Vermelho" class="text-red-500">🔴 Vermelho</option>
                </select>
            </div>

            <!-- Diagnósticos / Testes -->
            <div class="bg-white dark:bg-[#202528] p-8 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-800 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-black uppercase text-gray-400 ml-2 tracking-widest">Testes Clínicos</h3>
                    <button type="button" onclick="openModal()" class="text-emerald-500 hover:scale-110 transition-transform">
                        <span class="material-symbols-sharp">add_circle</span>
                    </button>
                </div>

                <div class="space-y-2" id="lista-diagnosticos">
                    @forelse ($diagnosticos as $item)
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-[#181a1e] rounded-xl border border-gray-100 dark:border-gray-700 group">
                            <input type="hidden" name="doenca[]" value="{{ $item->doenca->id }}">
                            <input type="hidden" name="estado[]" value="{{ $item->estado }}">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold">{{ $item->doenca->nome }}</span>
                                <span class="text-[9px] font-black uppercase {{ $item->estado == 1 ? 'text-red-500' : 'text-emerald-500' }}">
                                    {{ $item->estado == 1 ? 'Positivo' : 'Negativo' }}
                                </span>
                            </div>
                            <a href="{{ route('diagnostico-delete', $item->id) }}" onclick="return confirm('Excluir permanentemente?')" class="text-gray-300 hover:text-red-500">
                                <span class="material-symbols-sharp text-lg">delete</span>
                            </a>
                        </div>
                    @empty
                        <p class="text-[10px] text-gray-400 italic text-center py-4 font-medium">Nenhum teste efetuado.</p>
                    @endforelse
                </div>
            </div>

            <!-- Botão Salvar -->
            <button type="submit" class="w-full py-5 bg-emerald-500 hover:bg-emerald-600 text-white font-black rounded-[2rem] shadow-xl shadow-emerald-100 dark:shadow-none transition-all hover:scale-[1.02] flex items-center justify-center gap-3 tracking-widest uppercase text-sm">
                REGISTAR CONSULTA
                <span class="material-symbols-sharp">check_circle</span>
            </button>
        </div>
    </form>
</div>

<!-- MODAL DE DIAGNÓSTICO (ESTILO ORIGINAL RESTAURADO) -->
<div id="modal">
    <form onsubmit="addDiagnostico(event)" style="background: white; padding: 30px; border-radius: 15px; width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-top: 5px solid #4CAF50;">
        @csrf
        <h2 style="color: #2e7d32; margin-top: 0; font-size: 1.5rem; font-weight: 800; font-family: 'Poppins', sans-serif;">Dados do Paciente</h2>

        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #666; font-size: 0.8rem; font-weight: 700; margin-bottom: 5px; text-transform: uppercase;">Nome do Paciente</label>
            <input type="hidden" name='paciente_id' value="{{ $paciente->id }}">
            <p id="paciente-nome" style="background: #f1f8e9; padding: 10px; border-radius: 8px; color: #333; font-weight: 600; margin: 0; font-family: 'Poppins', sans-serif;">
                {{ $paciente->nome }} {{ $paciente->apelido }}
            </p>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #666; font-size: 0.8rem; font-weight: 700; margin-bottom: 5px; text-transform: uppercase;">Diagnóstico / Doença</label>
            <select name="doenca_id"  id='doenca_id' style="width: 100%; padding: 0 10px; border: 1px solid #c8e6c9; border-radius: 8px; outline: none; background: white; cursor: pointer; font-family: 'Poppins', sans-serif;">
                <option value="" disabled selected>Selecione uma doenca</option>
                @foreach ($doencas as $item)
                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; color: #666; font-size: 0.8rem; font-weight: 700; margin-bottom: 5px; text-transform: uppercase;">Resultado do Teste</label>
            <select name="estado" id='estado' style="width: 100%; padding: 0 10px; border: 1px solid #c8e6c9; border-radius: 8px; outline: none; background: white; cursor: pointer; font-family: 'Poppins', sans-serif;">
                <option value="0">⚪ Negativo</option>
                <option value="1">🟢 Positivo</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="flex: 2; background-color: #4CAF50; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 800; cursor: pointer; transition: background 0.3s; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">
                Salvar Teste
            </button>
            <button type="button" onclick="closeModal()" style="flex: 1; background-color: #f5f5f5; color: #666; border: 1px solid #ddd; padding: 12px; border-radius: 8px; font-weight: 700; cursor: pointer; text-transform: uppercase; font-size: 0.75rem;">
                Cancelar
            </button>
        </div>
    </form>
</div>

<style>
    #modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(4px); /* Adiciona um leve desfoque no fundo para ficar mais moderno */
    }

    #modal.mostrar {
        display: flex;
    }
</style>

<script>
// Função para abrir o modal
function openModal() {
    document.getElementById('modal').classList.add('mostrar');
}

// Função para fechar o modal
function closeModal() {
    document.getElementById('modal').classList.remove('mostrar');
}

// Função para adicionar diagnóstico
function addDiagnostico(e){
    e.preventDefault();

    let doencaSelect = document.getElementById('doenca_id');
    let estadoSelect = document.getElementById('estado');

    let doencaId = doencaSelect.value;
    let doencaNome = doencaSelect.options[doencaSelect.selectedIndex].text;
    let estado = estadoSelect.value;

    if(!doencaId){
        alert("Selecione uma doença");
        return;
    }

    let estadoTexto = estado == 1 ? "Positivo" : "Negativo";
    let estadoClasse = estado == 1 ? "text-red-500" : "text-emerald-500";

    let container = document.getElementById('lista-diagnosticos');
    
    // Remove o aviso de "Nenhum teste efetuado" se existir
    let aviso = container.querySelector('p');
    if(aviso) aviso.remove();

    let item = document.createElement('div');
    item.className = "flex items-center justify-between p-3 bg-gray-50 dark:bg-[#181a1e] rounded-xl border border-gray-100 dark:border-gray-700";

    item.innerHTML = `
        <input type="hidden" name="doenca[]" value="${doencaId}">
        <input type="hidden" name="estado[]" value="${estado}">
        <div class="flex flex-col">
            <span class="text-xs font-bold">${doencaNome}</span>
            <span class="text-[9px] font-black uppercase ${estadoClasse}">
                ${estadoTexto}
            </span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-gray-300 hover:text-red-500">
            <span class="material-symbols-sharp text-lg">delete</span>
        </button>
    `;

    container.appendChild(item);
    closeModal();
    
    // Resetar o select após adicionar
    doencaSelect.value = "";
}
</script>


@endsection