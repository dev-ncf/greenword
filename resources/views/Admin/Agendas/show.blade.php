@extends('layouts.admin')
@section('content')
    <div class="show">
        <div class="card" style="margin-top: 50px">


            <div class="dados">

                <div>
                    <h2>Detalhes da agenda</h2>
                    <p>Nome: <b>{{ $agenda->paciente }} </b></p>
                    <p>Contacto: <b>{{ $agenda->contacto }} </b></p>
                    <p>Email: <b>{{ $agenda->email }}
                        </b></p>
                    <p>Medico: <b>{{ $agenda->medico->nome }}</b></p>
                    <p>Data: <b>{{ $agenda->data }}</b></p>
                    <p>Hora: <b>{{ $agenda->hora }}</b></p>
                    {{-- <h2>Hora</h2> --}}

                </div>
                <div>
                    <h2>Descrição</h2>
                    <p>{{ $agenda->descricao }}</p>
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
