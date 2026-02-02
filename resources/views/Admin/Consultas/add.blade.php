@extends('layouts.admin')
@section('content')
    <div class="add">
        <div class="head">
            <h1>Registo de Consultas</h1>
        </div>
        <form action="{{ route('store-consultas') }}" method="POST" class="form">
            @csrf
            <div class="card-control">
                <label for="nome">Nome</label>
                <select name="paciente_id" id="">
                    <option selected value="{{ $paciente->id }}">{{ $paciente->nome . ' ' . $paciente->apelido }}</option>

                </select>
            </div>

            <div class="card-control">
                <label for="contacto">Sintomas</label>
                <textarea name="sintomas" id="sintomas" min="0" placeholder="Principais queixas..."></textarea>
            </div>

            <div class="card-control">
                <label for="nivvel">Nível</label>
                <select type="date" name="nivel" id="nivel" required>
                    <option value="" selected disabled>Selecione o nível</option>
                    <option value="Verde">Verde</option>
                    <option value="Laranja">Laranja</option>
                    <option value="Amarelo">Amarelo</option>
                    <option value="Vermelho">Vermelho</option>
                </select>
            </div>
            <div class="card-control">
                <label for="medico">Medico</label>
                <select type="date" name="medico_id" id="medico" required>
                    <option value="" selected disabled>Selecione o Médico</option>
                    @foreach ($medicos as $medico)
                        <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="card-control">
                <label for="data_consulta">Data da Consulta</label>
                <input type="date" name="data_consulta" id="data_consulta" required>
            </div>
            @if ($diagnosticos->count() > 0)
                <div
                    class="bg-white dark:bg-[#202528] rounded-[2rem] p-6 shadow-sm border border-gray-100 dark:border-gray-800 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-sharp text-[#7380ec]">assignment_turned_in</span>
                        <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500">Diagnósticos Atuais</h3>
                    </div>

                    <div class="space-y-2">
                        @foreach ($diagnosticos as $item)
                            <div
                                class="flex items-center justify-between p-3 bg-gray-50 dark:bg-[#181a1e] rounded-xl border border-gray-100 dark:border-gray-700">

                                <!-- INPUTS HIDDEN (O que o back-end vai receber) -->
                                <input type="hidden" name="doenca[]" value="{{ $item->doenca->id }}">
                                <!-- Se precisar enviar o estado também: -->
                                <input type="hidden" name="estado[]" value="{{ $item->estado }}">

                                <!-- VISUAL (O que o usuário vê) -->
                                <div class="flex items-center gap-4">
                                    <span class="font-semibold text-sm">{{ $item->doenca->nome }}</span>

                                    @if ($item->estado == 1)
                                        <span
                                            class="text-[10px] font-bold text-red-500 bg-red-100 dark:bg-red-900/30 px-2 py-0.5 rounded-md uppercase">Positivo</span>
                                    @else
                                        <span
                                            class="text-[10px] font-bold text-blue-500 bg-blue-100 dark:bg-blue-900/30 px-2 py-0.5 rounded-md uppercase">Negativo</span>
                                    @endif
                                </div>

                                <!-- Botão de Excluir (Remove do Banco de Dados via Link) -->
                                <a href="{{ route('diagnostico-delete', $item->id) }}"
                                    class="text-gray-400 hover:text-red-500 transition-colors"
                                    onclick="return confirm('Excluir este diagnóstico permanentemente?')">
                                    <span class="material-symbols-sharp text-lg">delete</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-[10px] text-gray-400 italic font-medium">Estes itens serão incluídos no envio do
                        formulário.</p>
                </div>
            @endif

            <div class="card-control">
                <label for="contacto">Observação</label>
                <textarea name="observacoes" id="observacoes" min="0" placeholder="Descrição da consulta..."></textarea>
            </div>
            <div class="card-control">
                <button id="btnfazer" type="button" onclick="openModal({{ $paciente->id }})">Fazer teste</button>
            </div>
            <div class="card-control">
                <button type="submit">Registar</button>
            </div>
        </form>
    </div>
    @if ($errors->any())
        @include('Admin.error')
    @endif
    @if (session('success'))
        @include('Admin.success')
    @endif

    <div id="modal" style="">
        <form method="POST" action="{{ route('diagnostico') }}"
            style="background: white; padding: 30px; border-radius: 15px; width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-top: 5px solid #4CAF50;">
            @csrf
            <h2 style="color: #2e7d32; margin-top: 0; font-size: 1.5rem;">Dados do Paciente</h2>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #666; font-size: 0.9rem; margin-bottom: 5px;">Nome do Paciente</label>
                <input type="hidden" name='paciente_id' value="{{ $paciente->id }}">
                <p id="paciente-nome"
                    style="background: #f1f8e9; padding: 10px; border-radius: 8px; color: #333; font-weight: 600; margin: 0;">
                    {{ $paciente->nome }}
                </p>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #666; font-size: 0.9rem; margin-bottom: 5px;">Diagnóstico /
                    Doença</label>
                <select name="doenca_id"
                    style="width: 100%; padding: 0 10px; border: 1px solid #c8e6c9; border-radius: 8px; outline: none; background: white; cursor: pointer;">
                    @foreach ($doencas as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; color: #666; font-size: 0.9rem; margin-bottom: 5px;">Resultado do
                    Teste</label>
                <select name="estado"
                    style="width: 100%; padding: 0 10px; border: 1px solid #c8e6c9; border-radius: 8px; outline: none; background: white; cursor: pointer;">
                    <option value="0">⚪ Negativo</option>
                    <option value="1">🟢 Positivo</option>
                </select>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit"
                    style="flex: 2; background-color: #4CAF50; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: background 0.3s;">
                    Salvar
                </button>
                <button type="button" onclick="closeModal()"
                    style="flex: 1; background-color: #f5f5f5; color: #666; border: 1px solid #ddd; padding: 12px; border-radius: 8px; cursor: pointer;">
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
            /* Preto com 70% de transparência */
            z-index: 1000;
            /* Garante que fique na frente de tudo */
            justify-content: center;
            align-items: center;
        }

        #modal.mostrar {
            display: flex;
            /* Mostra quando a classe está presente */
        }

        #excluir {
            width: max-content;
            padding: 4px 4px 0 4px;
            margin: 0;

            background-color: #550000;
            color: white;
            border-radius: 5px;
            text-align: center
        }

        #excluir:hover {
            background-color: #880000
        }
    </style>
    <script>
        // Configurar data máxima para o input de nascimento
        const dataInput = document.getElementById("dataNascimento");
        const hoje = new Date();
        hoje.setDate(hoje.getDate() - 1);

        const dia = String(hoje.getDate()).padStart(2, '0');
        const mes = String(hoje.getMonth() + 1).padStart(2, '0');
        const ano = hoje.getFullYear();
        dataInput.max = `${ano}-${mes}-${dia}`;

        // Adicionar dinamicamente novos campos de seleção de doenças
        function addDiseaseField() {
            const newSelect = document.createElement("select");
            newSelect.name = "doenca[]";
            newSelect.className = "disease-select";

            const diseaseContainer = document.getElementById("disease-container");
            const firstSelect = diseaseContainer.querySelector(".disease-select");
            newSelect.innerHTML = firstSelect.innerHTML;

            diseaseContainer.appendChild(newSelect);
        }

        function openModal(paciente) {
            const mod = document.getElementById("modal");
            mod.classList.add("mostrar");
            
        }

        function closeModal() {
            const mod = document.getElementById("modal");

            mod.classList.remove("mostrar");
        }
    </script>
@endsection
