<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS-MEPI</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    @if (auth()->check() && auth()->user()->nivel == 'A')
        <!-- Conteúdo para administradores -->
        <div class="container">
            <!--aside section start-->
            <aside>

                <div class="top">
                    <div class="logo">
                        <h2 class="primary">CS- <span class="danger">MEPI</span></h2>
                    </div>
                    <div class="close" id="close_btn">
                        <span class="material-symbols-sharp">
                            close
                        </span>
                    </div>
                </div>
                <div class="sidebar">
                    <a href="{{ route('dashboard') }}" class="  {{ Route::is('dashboard') ? 'active' : '' }}">
                        <span class="material-symbols-sharp">grid_view</span>
                        <h3>Dashboard</h3>
                    </a>
                    <a href="{{ route('agendas') }} "
                        class="{{ Route::is('agendas') || Route::is('add-agendas') || Route::is('edit-agendas') || Route::is('show-agendas') ? 'active' : '' }}">
                        <span class="material-symbols-sharp">book_online</span>
                        <h3>Agendas</h3>
                    </a>
                    <a href="{{ route('pacientes') }} "
                        class="{{ Route::is('pacientes') || Route::is('add-pacientes') || Route::is('edit-pacientes') || Route::is('show-pacientes') ? 'active' : '' }}">
                        <span class="material-symbols-sharp">personal_injury</span>
                        <h3>Pacientes</h3>
                    </a>
                    <a href="{{ route('consultas') }}"
                        class="{{ Route::is('consultas') || Route::is('add-consulta') || Route::is('show-consulta') ? 'active' : '' }}">
                        <span class="material-symbols-sharp">medical_services</span>
                        <h3>Consultas</h3>
                    </a>
                    <a href="{{ route('medicos') }}"
                        class="{{ Route::is('medicos') || Route::is('add-medicos') ? 'active' : '' }}">
                        <span class="material-symbols-sharp">stethoscope</span>
                        <h3>Medicos</h3>
                    </a>
                    <a href="{{ route('doencas') }}"
                        class="{{ Route::is('doencas') || Route::is('add-doencas') ? 'active' : '' }}">
                        <span class="material-symbols-sharp">medical_information</span>
                        <h3>Doenças</h3>
                    </a>
                    <a href="{{ route('usuarios') }}"
                        class="{{ Route::is('usuarios') || Route::is('add-usuarios') ? 'active' : '' }}">
                        <span class="material-symbols-sharp">group</span>
                        <h3>Usuários</h3>
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <span class="material-symbols-sharp">logout</span>
                        <h3>Logout</h3>
                    </a>

                </div>
            </aside>
            <!--aside section end-->
            <!--main section start-->

            <main>
                <H1>Dashbord</H1>
                <form class="date" action="{{ route('pacientes') }}">
                    <input type="text" placeholder="Digite nome ou contacto" name="search">
                    <button style="background-color: transparent" id="btn-seach"
                        class="material-symbols-sharp ">search</button>
                </form>
                @yield('content')
            </main>
            <!--main section end-->
            <!--right section start-->
            <div class="right">
                <div class="top">
                    <button id="menu_bar">
                        <span class="material-symbols-sharp">menu</span>
                    </button>
                    <div class="theme-toggler">
                        <span class="material-symbols-sharp active">light_mode</span>
                        <span class="material-symbols-sharp">dark_mode</span>
                    </div>
                    <div class="profile">


                        <div class="profile-photo">
                            <img src="{{ asset('img/1-intro-photo-final.webp') }}" id="profile-foto" alt="">
                            <div class="infom" id="inform" status ='closed'>
                                <p> <b>MEPI</b></p>
                                <p>Admin</p>
                                <small class="text-muted"></small>
                            </div>
                        </div>


                    </div>
                </div>
                <!--end top-->
                <!--stat ultimas actualizacoes-->
                @if ($ultimasAtualizacoes->count() >= 1)

                    <div class="ultimas_actualizacoes">
                        <h2>Ultimas actualizacoes</h2>
                        <div class="actualizacoes">
                            @foreach ($ultimasAtualizacoes as $agenda)
                                {{-- @if ($agenda->estado === '0')
                                <div class="actualizacao">
                                    <div class="profile-photo">
                                        <img src="{{ asset('img/1-intro-photo-final.webp') }}" alt="">
                                    </div>
                                    <div class="message">
                                        @if ($agenda->estado == '0')
                                            <a href="{{ route('show-agendas', $agenda->id) }}"><b><span
                                                        class="text-primary">Centro</span> Recebeu uma nova
                                                    solicitacao de agenda de consulta</b></a>
                                        @else
                                            <a href="{{ route('show-agendas', $agenda->id) }}"><span
                                                    class="text-primary">Centro</span> Recebeu uma nova
                                                solicitacao de agenda de consulta</a>
                                        @endif
                                    </div>
                                </div>
                            @endif --}}
                                @if ($agenda->estado === '0')
                                    <div class="actualizacao">
                                        <div class="profile-photo">
                                            <img src="{{ asset('img/1-intro-photo-final.webp') }}" alt="">
                                        </div>
                                        <div class="message">
                                            @if ($agenda->estado == '0')
                                                <a href="{{ route('show-agendas', $agenda->id) }}"><b><span
                                                            class="text-primary">Centro</span> Recebeu uma nova
                                                        solicitacao de agenda de consulta</b></a>
                                            @else
                                                <a href="{{ route('show-agendas', $agenda->id) }}"><span
                                                        class="text-primary">Centro</span> Recebeu uma nova
                                                    solicitacao de agenda de consulta</a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach


                        </div>

                    </div>
                @endif
                <!--end ultimas actualizacoes-->
                <!--start analise consultas-->
                {{-- <div class="analise_consultas">
                <h2>analise de consultas</h2>
                <div class="item onlion">
                    <div class="icon">
                        <span class="material-symbols-sharp">medical_information</span>
                    </div>
                    <div class="right_text">
                        <div class="info">
                            <h3>Diabete</h3>
                            <small>Ultima consulta 2 meses</small>
                        </div>
                        <h5 class="danger">18%</h5>
                        <h3>150</h3>
                    </div>
                </div>
            </div> --}}
                <!--end analise consultas-->
                {{-- <div class="item add_pacientes">
                <div>
                    <span class="material-symbols-sharp">add</span>
                </div>

            </div> --}}
            </div>

            <!--right section end-->

        </div>
    @else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <script>
            alert('Ainda nao tens acesso a login! Entre em contacto com o administrador!')
            document.getElementById('logout-form').submit();
        </script>

    @endif


    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/error-success.js') }}"></script>
    <script>
        const btnSearch = document.getElementById('btn-seach')

        btnSearch.addEventListener("click", () => {
            alert('Ola')
        });
    </script>
</body>

</html>
