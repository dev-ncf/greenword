@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    
    <!-- Cabeçalho de Identificação -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-white dark:bg-[#202528] rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800">
                <span class="material-symbols-sharp text-emerald-500 text-3xl">manage_accounts</span>
            </div>
            <div>
                <h1 class="text-2xl font-black text-[#363949] dark:text-white uppercase tracking-tight">Editar Utilizador</h1>
                <p class="text-sm text-[#7d8da1]">Modificando a conta de: <span class="font-bold text-emerald-600">{{ $user->name }}</span></p>
            </div>
        </div>
        
        <a href="{{ route('usuarios') }}" class="hidden md:flex items-center gap-2 text-sm font-bold text-[#7d8da1] hover:text-emerald-500 transition-colors">
            <span class="material-symbols-sharp">arrow_back</span>
            Voltar à lista
        </a>
    </div>

    <!-- Card do Formulário -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-gray-50 dark:border-gray-800">
        
        <form action="{{ route('update-usuarios', $user->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Nome -->
                <div class="space-y-2">
                    <label for="name" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Nome Completo</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors text-lg">person</span>
                        <input type="text" name="name" value="{{ $user->name }}" required
                            class="w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Endereço de Email</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors text-lg">mail</span>
                        <input type="email" name="email" value="{{ $user->email }}" required
                            class="w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Nível de Acesso -->
                <div class="space-y-2">
                    <label for="nivel" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Nível de Permissão</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors text-lg">shield_person</span>
                        <select name="nivel" required
                            class="w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-bold appearance-none cursor-pointer">
                            <option value="A" {{ $user->nivel == 'A' ? 'selected' : '' }}>Administrador (Acesso Total)</option>
                            <option value="B" {{ $user->nivel == 'B' ? 'selected' : '' }}>Operador Clínico (B)</option>
                            <option value="C" {{ $user->nivel == 'C' ? 'selected' : '' }}>Consulta / Visualização (C)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-gray-50 dark:border-gray-700">
                <button type="submit" 
                    class="flex-1 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black rounded-2xl shadow-lg shadow-emerald-100 dark:shadow-none transition-all hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-2 tracking-widest uppercase text-xs">
                    GUARDAR ALTERAÇÕES
                    <span class="material-symbols-sharp">save</span>
                </button>
                
                <a href="{{ route('usuarios') }}" 
                    class="flex-1 py-4 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-bold rounded-2xl text-center hover:bg-gray-200 dark:hover:bg-gray-700 transition-all flex items-center justify-center gap-2 text-xs uppercase tracking-widest">
                    CANCELAR
                </a>
            </div>

        </form>
    </div>

    <!-- Alertas Flutuantes -->
    <div class="fixed bottom-8 right-8 z-50">
        @if ($errors->any())
            @include('Admin.error')
        @endif
        @if (session('success'))
            @include('Admin.success')
        @endif
    </div>

</div>
@endsection