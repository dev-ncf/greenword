<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiGEH - Login</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DUWn80at.css') }}">
    <script src="{{ asset('build/assets/app-B_RiR9mH.js') }}"></script>
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
    {{-- @vite('resources/css/app.css') --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f6f6f9] text-[#363949]">

    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Container Principal -->
        <div class="max-w-[1000px] w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">
            
            <!-- LADO ESQUERDO: Branding/Imagem (Oculto no Mobile) -->
            <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-[#7380ec] to-[#41f1b6] p-12 flex-col justify-between relative overflow-hidden">
                <!-- Círculos decorativos de fundo -->
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-black/10 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <h1 class="text-white text-4xl font-black leading-tight">
                        Gestão Hospitalar <br>
                        <span class="text-[#363949]">Inteligente e Humana.</span>
                    </h1>
                    <p class="text-white/80 mt-4 font-medium italic">
                        "Tecnologia a favor da vida e da organização médica."
                    </p>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-white">
                        <span class="material-symbols-sharp">verified_user</span>
                        <span class="text-sm font-bold tracking-widest uppercase">Sistema Seguro SiGEH</span>
                    </div>
                </div>
            </div>

            <!-- LADO DIREITO: Formulário de Login -->
            <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center">
                
                <!-- Logo -->
                <div class="mb-10">
                    <h2 class="text-3xl font-black text-[#363949]">
                        SiGEH<span class="text-[#ff7782]">.</span>
                    </h2>
                    <p class="text-[#7d8da1] text-sm mt-2 font-medium">Faça login para gerir a sua unidade.</p>
                </div>

                <!-- Formulário -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Campo Email/Username -->
                    <div class="space-y-2">
                        <label for="email" class="text-[11px] font-black uppercase tracking-widest text-[#7d8da1] ml-2">Email ou Utilizador</label>
                        <div class="relative group">
                            <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#7380ec] transition-colors">person</span>
                            <input type="email" name="email" id="email" required autofocus
                                class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-[#7380ec]/20 focus:border-[#7380ec] transition-all text-sm font-medium"
                                placeholder="exemplo@sigeh.com">
                        </div>
                        @error('email')
                            <span class="text-[10px] text-[#ff7782] font-bold ml-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo Senha -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-2">
                            <label for="password" class="text-[11px] font-black uppercase tracking-widest text-[#7d8da1]">Palavra-passe</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-[#7380ec] hover:underline">Esqueceu-se?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#7380ec] transition-colors">lock</span>
                            <input type="password" name="password" id="password" required
                                class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-[#7380ec]/20 focus:border-[#7380ec] transition-all text-sm font-medium"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center ml-2">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-300 text-[#7380ec] focus:ring-[#7380ec]">
                        <label for="remember" class="ml-2 text-xs font-bold text-[#7d8da1] cursor-pointer">Lembrar-me neste dispositivo</label>
                    </div>

                    <!-- Botão Entrar -->
                    <button type="submit" 
                        class="w-full py-4 bg-[#7380ec] hover:bg-[#5a65c1] text-white font-black rounded-2xl shadow-xl shadow-indigo-100 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2">
                        ENTRAR NO SISTEMA
                        <span class="material-symbols-sharp">login</span>
                    </button>
                </form>

                <!-- Footer do Login -->
                <div class="mt-12 text-center">
                    <p class="text-[10px] text-[#7d8da1] font-medium uppercase tracking-widest">
                        &copy; {{ date('Y') }} SiGEH - Todos os direitos reservados
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>