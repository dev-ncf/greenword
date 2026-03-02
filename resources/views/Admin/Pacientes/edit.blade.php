@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    
    <!-- Cabeçalho de Identificação -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-white dark:bg-[#202528] rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800">
                <span class="material-symbols-sharp text-emerald-500 text-3xl">edit_note</span>
            </div>
            <div>
                <h1 class="text-2xl font-black text-[#363949] dark:text-white">Edição de Paciente</h1>
                <p class="text-sm text-[#7d8da1]">Atualizando os dados de: <span class="font-bold text-emerald-600">{{ $paciente->nome }} {{ $paciente->apelido }}</span></p>
            </div>
        </div>
        
        <a href="{{ route('pacientes') }}" class="hidden md:flex items-center gap-2 text-sm font-bold text-[#7d8da1] hover:text-emerald-500 transition-colors">
            <span class="material-symbols-sharp">arrow_back</span>
            Voltar à lista
        </a>
    </div>

    <!-- Card do Formulário -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-gray-50 dark:border-gray-800">
        
        <form action="{{ route('update-pacientes', $paciente->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nome -->
                <div class="space-y-2">
                    <label for="nome" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Nome</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">person</span>
                        <input type="text" name="nome" value="{{ $paciente->nome }}" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Apelido -->
                <div class="space-y-2">
                    <label for="apelido" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Apelido</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">badge</span>
                        <input type="text" name="apelido" value="{{ $paciente->apelido }}" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Genero -->
                <div class="space-y-2">
                    <label for="genero" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Gênero</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">wc</span>
                        <select name="genero" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 h-16 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium appearance-none cursor-pointer">
                            <option value="M" {{ $paciente->genero == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ $paciente->genero == 'F' ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>
                </div>

                <!-- Data de Nascimento -->
                <div class="space-y-2">
                    <label for="data_nascimento" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Data de Nascimento</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">calendar_today</span>
                        <input type="date" id="dataNascimento" name="data_nascimento" value="{{ $paciente->data_nascimento }}" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Contacto -->
                <div class="space-y-2 md:col-span-2">
                    <label for="contacto" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Contacto Telefónico</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">call</span>
                        <input type="number" name="contacto" value="{{ $paciente->contacto }}" min="0" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

            </div>

            <!-- Botões de Ação -->
            <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-gray-50 dark:border-gray-700">
                <button type="submit" 
                    class="flex-1 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black rounded-2xl shadow-lg shadow-emerald-100 dark:shadow-none transition-all hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-2 tracking-widest uppercase text-xs">
                    SALVAR ALTERAÇÕES
                    <span class="material-symbols-sharp">save</span>
                </button>
                
                <a href="{{ route('pacientes') }}" 
                    class="flex-1 py-4 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-bold rounded-2xl text-center hover:bg-gray-200 dark:hover:bg-gray-700 transition-all flex items-center justify-center gap-2 text-xs uppercase tracking-widest">
                    CANCELAR
                </a>
            </div>

        </form>
    </div>

    <!-- Mensagens de Erro/Sucesso (Estilizadas) -->
    <div class="fixed bottom-8 right-8 z-50">
        @if ($errors->any())
            @include('Admin.error')
        @endif
        @if (session('success'))
            @include('Admin.success')
        @endif
    </div>

</div>

<script>
    const dataInput = document.getElementById("dataNascimento");
    if(dataInput) {
        const hoje = new Date();
        hoje.setDate(hoje.getDate() - 1);
        const dia = String(hoje.getDate()).padStart(2, '0');
        const mes = String(hoje.getMonth() + 1).padStart(2, '0');
        const ano = hoje.getFullYear();
        dataInput.max = `${ano}-${mes}-${dia}`;
    }
</script>
@endsection