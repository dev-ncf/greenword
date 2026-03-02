@extends('layouts.admin')
@section('content')
    <div class="add">
        <div class="head">
            <h1>Registo de Agendas</h1>
        </div>
        <form action="{{ route('store-agendas','Interna') }}" method="POST" class="form">
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
                <label for="nome">Medico</label>
                <select name="medico_id" id="">
                    <option value="" disabled selected>Selecione um medico</option>
                    @foreach ($medicos as $medico)
                        <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="card-control">
                <label for="Data">Data</label>
                <input type="date" name="data" id="">

            </div>
            <div class="card-control">
                <label for="doenca">Doenças</label>
                <input type="time" name="hora" id="">

            </div>


            <div class="card-control">
                <label for="Descricao">Descrição</label>
                <textarea name="descricao" id="observacoes" min="0" placeholder="Fale um pouco das sintomas"></textarea>
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
