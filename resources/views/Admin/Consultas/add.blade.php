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
                    <option value="" disabled selected>Selecione um paciente</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->id }}">{{ $paciente->nome . ' ' . $paciente->apelido }}</option>
                    @endforeach
                </select>
            </div>
            <div class="card-control">
                <label for="doenca">Doenças</label>
                <div id="disease-container">
                    <select name="doenca[]" class="disease-select">
                        <option value="" disabled selected>Selecione uma doença</option>
                        @foreach ($doencas as $doenca)
                            <option value="{{ $doenca->id }}">{{ $doenca->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" id="adicionar-campo" onclick="addDiseaseField()">+</button>
            </div>
            <div class="card-control">
                <label for="nivvel">Nível</label>
                <select type="date" name="nivel" id="nivel" required>
                    <option value="" selected disabled>Selecione o nível</option>
                    <option value="Normal (-)">Normal (-)</option>
                    <option value="Pouco anormal(+)">Pouco anormal(+)</option>
                    <option value="Moderadamente anormal (++)">Moderadamente anormal (++)</option>
                    <option value="Severamente anormal (+++)">Severamente anormal (+++)</option>
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

            <div class="card-control">
                <label for="contacto">Observação</label>
                <textarea name="observacoes" id="observacoes" min="0" placeholder="Descrição da consulta..."></textarea>
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
    </script>
@endsection
