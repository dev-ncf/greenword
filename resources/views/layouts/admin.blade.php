<!DOCTYPE html>
<html lang="pt-pt" class="light"> <!-- Classe 'dark' alterna o tema -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiGEH - Dashboard</title>
    
    <!-- Tailwind CDN (Para produção, use o compilado) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Esconder scrollbar padrão mantendo funcionalidade */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Variáveis de cores originais adaptadas */
        :root {
            --primary: #41f1b6;
            --danger: #ff7782;
            --success: #7380ec;
            --dark-variant: #677483;
            --bg-color: #f6f6f9;
        }
        .dark {
            --bg-color: #181a1e;
        }
    </style>
</head>

<body class="bg-[#f6f6f9] dark:bg-[#181a1e] text-[#363949] dark:text-[#edeffd] antialiased overflow-hidden">

    @if (auth()->check() && auth()->user()->nivel == 'A')
    <div class="flex h-screen overflow-hidden">
        
        <!-- ================= SIDEBAR FIXA ================= -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-[#202528] transition-transform duration-300 transform -translate-x-full lg:translate-x-0 border-r border-gray-200 dark:border-gray-800">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-between h-20 px-8">
                    <h2 class="text-2xl font-extrabold tracking-tight text-[#41f1b6]">
                        SiGEH<span class="text-[#ff7782]">.</span>
                    </h2>
                    <button onclick="toggleSidebar()" class="lg:hidden text-[#ff7782]">
                        <span class="material-symbols-sharp">close</span>
                    </button>
                </div>

                <!-- Menu Nav -->
                <nav class="flex-1 px-4 space-y-2 overflow-y-auto hide-scrollbar">
                    @php $route = Route::currentRouteName(); @endphp
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all group {{ $route == 'dashboard' ? 'bg-gray-100 dark:bg-gray-700 text-[#41f1b6] border-l-4 border-[#41f1b6]' : 'text-[#7d8da1] hover:text-[#41f1b6]' }}">
                        <span class="material-symbols-sharp">grid_view</span>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('pacientes') }}" class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all group {{ str_contains($route, 'pacientes') ? 'bg-gray-100 dark:bg-gray-700 text-[#41f1b6] border-l-4 border-[#41f1b6]' : 'text-[#7d8da1] hover:text-[#41f1b6]' }}">
                        <span class="material-symbols-sharp">personal_injury</span>
                        <span class="font-medium">Pacientes</span>
                    </a>

                    <a href="{{ route('consultas') }}" class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all group {{ request()->routeIs('consultas','add-consulta','show-consulta')? 'bg-gray-100 dark:bg-gray-700 text-[#41f1b6] border-l-4 border-[#41f1b6]' : 'text-[#7d8da1] hover:text-[#41f1b6]' }}">
                        <span class="material-symbols-sharp">medical_services</span>
                        <span class="font-medium">Triagem</span>
                    </a>

                    <a href="{{ route('medicos') }}" class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all group {{ str_contains($route, 'medicos') ? 'bg-gray-100 dark:bg-gray-700 text-[#41f1b6] border-l-4 border-[#41f1b6]' : 'text-[#7d8da1] hover:text-[#41f1b6]' }}">
                        <span class="material-symbols-sharp">stethoscope</span>
                        <span class="font-medium">Médicos</span>
                    </a>

                    <a href="{{ route('usuarios') }}" class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all group {{ str_contains($route, 'usuarios') ? 'bg-gray-100 dark:bg-gray-700 text-[#41f1b6] border-l-4 border-[#41f1b6]' : 'text-[#7d8da1] hover:text-[#41f1b6]' }}">
                        <span class="material-symbols-sharp">group</span>
                        <span class="font-medium">Usuários</span>
                    </a>
                </nav>

                <!-- Logout -->
                <div class="p-4 border-t border-gray-100 dark:border-gray-800">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="flex items-center gap-4 px-4 py-3 text-[#7d8da1] hover:text-[#ff7782] transition-colors">
                        <span class="material-symbols-sharp">logout</span>
                        <span class="font-medium">Sair</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- ================= CONTEÚDO À DIREITA ================= -->
        <div class="flex flex-col flex-1 w-full lg:pl-64">
            
            <!-- HEADER FIXO -->
            <header class="h-20 bg-white/80 dark:bg-[#202528]/80 backdrop-blur-md sticky top-0 z-40 border-b border-gray-200 dark:border-gray-800 px-4 lg:px-12 flex items-center justify-between">
                <!-- Left: Burger & Title -->
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
                        <span class="material-symbols-sharp">menu</span>
                    </button>
                    <h1 class="text-xl font-bold hidden md:block">Banco de Socorro</h1>
                </div>

                <!-- Right: Theme, Search, Profile -->
                <div class="flex items-center gap-4 md:gap-8">
                    <!-- Barra de Busca (Mini) -->
                    <form action="{{ route('pacientes') }}" class="hidden sm:flex items-center bg-gray-100 dark:bg-[#181a1e] rounded-full px-4 py-1.5 shadow-inner">
                        <input type="text" name="search" placeholder="Buscar..." class="bg-transparent border-none focus:ring-0 text-sm w-32 md:w-48 outline-none">
                        <button type="submit" class="material-symbols-sharp text-gray-400 text-lg">search</button>
                    </form>

                    <!-- Theme Toggler -->
                    <div onclick="toggleTheme()" class="flex bg-gray-100 dark:bg-gray-800 rounded-lg p-1 cursor-pointer w-14 h-8 relative items-center transition-all">
                        <span class="material-symbols-sharp text-sm w-1/2 flex justify-center z-10">light_mode</span>
                        <span class="material-symbols-sharp text-sm w-1/2 flex justify-center z-10">dark_mode</span>
                        <div id="theme-ball" class="absolute bg-[#41f1b6] w-6 h-6 rounded-md shadow-sm transition-transform transform translate-x-0"></div>
                    </div>

                    <!-- Profile -->
                    <div class="flex items-center gap-3 border-l pl-4 border-gray-200 dark:border-gray-700">
                        <div class="text-right hidden sm:block leading-tight">
                            <p class="text-sm font-bold">Admin</p>
                            <small class="text-xs text-[#7d8da1]">Administrador</small>
                        </div>
                        <div class="w-10 h-10 rounded-full border-2 border-[#41f1b6] p-0.5">
                            <img src="{{ asset('img/1-intro-photo-final.webp') }}" class="w-full h-full rounded-full object-cover shadow-sm">
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT AREA -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-12 mt-0">
                
                <div class="grid grid-cols-1 xl:grid-cols- gap-8">
                    
                                         
                        
                        <!-- Onde entra o conteúdo das outras páginas -->
                        <section class="min-h-[500px]">
                            @yield('content')
                        </section>
                    

                </div>
            </main>
        </div>

        <!-- Overlay for Mobile Sidebar -->
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden opacity-0 transition-opacity duration-300"></div>

    </div>
    @else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <script>
            alert('Acesso negado! Contacte o administrador.');
            document.getElementById('logout-form').submit();
        </script>
    @endif

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

    <!-- Scripts de Interatividade -->
    <script>
        // Menu Lateral Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isClosed = sidebar.classList.contains('-translate-x-full');

            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.add('opacity-100'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-100');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        // Alternador de Tema
        function toggleTheme() {
            const html = document.documentElement;
            const ball = document.getElementById('theme-ball');
            
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                ball.style.transform = 'translateX(0)';
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                ball.style.transform = 'translateX(24px)';
                localStorage.theme = 'dark';
            }
        }

        // Carregar tema salvo
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.getElementById('theme-ball').style.transform = 'translateX(24px)';
        }
    </script>
</body>
</html>