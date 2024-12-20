@extends('layouts.admin')
@section('content')
    <div class="insights">
        <!--inicio atendimento-->
        <div class="atendimentos">
            <span class="material-symbols-sharp">trending_up</span>
            <div class="middle">
                <div class="left">
                    <h3>Total</h3>
                    <h1>150</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle r="30" cx="40" cy="40"></circle>
                    </svg>
                    <div class="number">80%</div>
                </div>
            </div>
            <small>Ultimas 24h</small>
        </div>
        <!--fim atendimento-->
        <!--inicio atendimento-->
        <div class="atendimentos">
            <span class="material-symbols-sharp">trending_up</span>
            <div class="middle">
                <div class="left">
                    <h3>Total</h3>
                    <h1>150</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle r="30" cx="40" cy="40"></circle>
                    </svg>
                    <div class="number">80%</div>
                </div>
            </div>
            <small>Ultimas 24h</small>
        </div>
        <!--fim atendimento-->
    </div>
    <!-- end inside -->
    <!-- inicio ultimos atendimentos -->
    <div class="ultimo_atendimento">
        <h1>Ultimos atendimentos</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Doenças</th>
                    <th>Genero</th>
                    <th>Idade</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultas as $consulta)
                    <tr>
                        <td>{{ $consulta->paciente->nome . ' ' . $consulta->paciente->apelido }} </td>
                        @php
                            $doencas = null;
                            foreach ($consulta->doencas as $doenca) {
                                // Se já houver algum valor, adiciona a vírgula antes do próximo nome
                                if ($doencas) {
                                    $doencas .= ', ';
                                }
                                // Concatena o nome da doença
                                $doencas .= $doenca->nome;
                            }

                            $ano = \Carbon\Carbon::parse($consulta->paciente->data_nascimento)->year;

                        @endphp
                        <td>{{ $doencas }}</td>
                        <td>{{ $consulta->paciente->genero == 'M' ? 'Masculino' : 'Feminino' }}</td>
                        <td>{{ date('Y') - $ano }}</td>
                        <td
                            class="{{ $consulta->estado == 'Pendente' ? 'warning' : ($consulta->estado == 'Atendido' ? 'primary' : 'red') }}">
                            {{ $consulta->estado }}</td>


                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <!-- fim ultimos atendimentos -->
@endsection
