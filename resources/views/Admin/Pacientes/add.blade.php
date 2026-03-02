@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    
    <!-- Cabeçalho -->
    <div class="flex items-center gap-4">
        <div class="p-3 bg-white dark:bg-[#202528] rounded-2xl shadow-sm">
            <span class="material-symbols-sharp text-[#7380ec] text-3xl">person_add</span>
        </div>
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white">Cadastro de Pacientes</h1>
            <p class="text-sm text-[#7d8da1]">Introduza os dados pessoais para registar um novo paciente no sistema.</p>
        </div>
    </div>

    <!-- Card do Formulário -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-gray-50 dark:border-gray-800">
        
        <form action="{{ route('store-pacientes') }}" method="POST" class="space-y-8">
            @csrf
            
            <!-- Seção: Informações Básicas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nome -->
                <div class="space-y-2">
                    <label for="nome" class="text-sm font-bold text-gray-600 dark:text-gray-400 ml-2 uppercase tracking-widest text-[11px]">Nome</label>
                    <div class="relative">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg">person</span>
                        <input type="text" name="nome" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-[#7380ec] transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Apelido -->
                <div class="space-y-2">
                    <label for="apelido" class="text-sm font-bold text-gray-600 dark:text-gray-400 ml-2 uppercase tracking-widest text-[11px]">Apelido</label>
                    <div class="relative">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg">badge</span>
                        <input type="text" name="apelido" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-[#7380ec] transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Genero -->
                <div class="space-y-2">
                    <label for="genero" class="text-sm font-bold text-gray-600 dark:text-gray-400 ml-2 uppercase tracking-widest text-[11px]">Gênero</label>
                    <div class="relative">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg">wc</span>
                        <select name="genero" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50  dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-[#7380ec] transition-all text-sm font-medium appearance-none">
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                </div>

                <!-- Data de Nascimento -->
                <div class="space-y-2">
                    <label for="data_nascimento" class="text-sm font-bold text-gray-600 dark:text-gray-400 ml-2 uppercase tracking-widest text-[11px]">Data de Nascimento</label>
                    <div class="relative">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg">calendar_today</span>
                        <input type="date" id="dataNascimento" name="data_nascimento" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-[#7380ec] transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Contacto -->
                <div class="space-y-2 md:col-span-2">
                    <label for="contacto" class="text-sm font-bold text-gray-600 dark:text-gray-400 ml-2 uppercase tracking-widest text-[11px]">Contacto Telefónico</label>
                    <div class="relative">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg">call</span>
                        <input type="number" name="contacto" min="0" required
                            placeholder="Ex: 840000000"
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-[#7380ec] transition-all text-sm font-medium">
                    </div>
                </div>

            </div>

            <!-- Botões de Ação -->
            <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-gray-50 dark:border-gray-700">
                <button type="submit" 
                    class="flex-1 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black rounded-2xl shadow-lg shadow-indigo-100 dark:shadow-none transition-all hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-2 tracking-widest">
                    FINALIZAR REGISTO
                    <span class="material-symbols-sharp">check_circle</span>
                </button>
                
                <a href="{{ route('pacientes') }}" 
                    class="flex-1 py-4 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-bold rounded-2xl text-center hover:bg-gray-200 dark:hover:bg-gray-700 transition-all flex items-center justify-center gap-2">
                    CANCELAR
                </a>
            </div>

        </form>
    </div>

    <!-- Alertas de Erro/Sucesso -->
    <div class="fixed bottom-8 right-8 space-y-4 z-50">
        @if ($errors->any())
            @include('Admin.error')
        @endif
        @if (session('success'))
            @include('Admin.success')
        @endif
    </div>

</div>

<script>
    // Configuração da data máxima (ontem)
    const dataInput = document.getElementById("dataNascimento");
    if (dataInput) {
        const hoje = new Date();
        hoje.setDate(hoje.getDate() - 1);
        const dia = String(hoje.getDate()).padStart(2, '0');
        const mes = String(hoje.getMonth() + 1).padStart(2, '0');
        const ano = hoje.getFullYear();
        dataInput.max = `${ano}-${mes}-${dia}`;
    }
</script>
@endsection