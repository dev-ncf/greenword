@extends('layouts.admin')
@section('content')
    <div class="show">
        <div class="card" style="margin-top: 50px">
            <img src="{{ asset('img/1-intro-photo-final.webp') }}" alt=""
                style="width: 150px; height: 150px; border-radius: 50%">

            <div class="dados">
                @php
                    $ano = \Carbon\Carbon::parse($paciente->data_nascimento)->year;
                @endphp
                <div>
                    <h2>Dados Pessoais</h2>
                    <p>Nome: <b>{{ $paciente->nome }} </b></p>
                    <p>Apelido: <b>{{ $paciente->apelido }} </b></p>
                    <p>Idade: <b>{{ date('Y') - $ano }}
                        </b></p>
                    <p>Genero: <b>{{ $paciente->genero == 'M' ? 'Masculino' : 'Feminino' }}</b></p>
                    <p>Contacto: <b>{{ $paciente->contacto }}</b></p>
                    <h2>Doenças</h2>
                    @foreach ($paciente->doencas as $doenca)
                        <p>{{ $doenca->nome }}</p>
                    @endforeach
                </div>
                <div>
                    <h2>Ultimas consultas</h2>
                    @foreach ($paciente->consultas as $consulta)
                        <a href="{{ route('consultas', $consulta->data_consulta) }}">{{ $consulta->data_consulta }}</a>
                    @endforeach
                    <h2>Proxima Consulta</h2>
                    <p>{{ date('d/m/Y H:m') }}</p>

                </div>


            </div>
        </div>



    </div>
    <script>
        const dataInput = document.getElementById("dataNascimento");
        const hoje = new Date();
        hoje.setDate(hoje.getDate() - 1); // Subtrai um dia, definindo para ontem

        // Formata a data para o formato yyyy-mm-dd exigido pelo input de data
        const dia = String(hoje.getDate()).padStart(2, '0');
        const mes = String(hoje.getMonth() + 1).padStart(2, '0'); // Janeiro é 0!
        const ano = hoje.getFullYear();

        dataInput.max = `${ano}-${mes}-${dia}`; // Define o max para ontem
    </script>
@endsection
