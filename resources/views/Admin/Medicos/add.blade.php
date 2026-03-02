@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    
    <!-- Cabeçalho -->
    <div class="flex items-center gap-4">
        <div class="p-3 bg-white dark:bg-[#202528] rounded-2xl shadow-sm border border-emerald-100 dark:border-gray-800">
            <span class="material-symbols-sharp text-emerald-500 text-3xl">person_add</span>
        </div>
        <div>
            <h1 class="text-2xl font-black text-[#363949] dark:text-white uppercase tracking-tight">Registo de Médico</h1>
            <p class="text-sm text-[#7d8da1]">Adicione um novo profissional ao corpo clínico do SiGEH.</p>
        </div>
    </div>

    <!-- Card do Formulário -->
    <div class="bg-white dark:bg-[#202528] rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-gray-50 dark:border-gray-800">
        
        <form action="{{ route('store-medicos') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nome Completo -->
                <div class="space-y-2 md:col-span-2">
                    <label for="nome" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Nome Completo</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">person</span>
                        <input type="text" name="nome" placeholder="Digite o nome completo do médico" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Email Profissional -->
                <div class="space-y-2">
                    <label for="email" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Email Profissional</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">mail</span>
                        <input type="email" name="email" placeholder="exemplo@sigeh.com" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Contacto -->
                <div class="space-y-2">
                    <label for="contacto" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Contacto Telefónico</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">call</span>
                        <input type="number" name="contacto" min="0" placeholder="Ex: 840000000" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Especialidade -->
                <div class="space-y-2">
                    <label for="especialidade" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Especialidade</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">clinical_notes</span>
                        <input type="text" name="especialidade" placeholder="Ex: Cardiologia, Pediatria..." required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-sm font-medium">
                    </div>
                </div>

                <!-- Upload de Foto -->
                <div class="space-y-2">
                    <label for="foto" class="text-[11px] font-black uppercase tracking-[0.2em] text-[#7d8da1] ml-2">Foto de Perfil</label>
                    <div class="relative group">
                        <span class="material-symbols-sharp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">image</span>
                        <input type="file" name="foto" accept="image/*"
                            class="w-full pl-12 pr-4 py-2.5 bg-gray-50 dark:bg-[#181a1e] border border-gray-100 dark:border-gray-700 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-xs text-gray-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-emerald-50 file:text-emerald-600 hover:file:bg-emerald-100 file:cursor-pointer">
                    </div>
                </div>

            </div>

            <!-- Botões de Ação -->
            <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-gray-50 dark:border-gray-700">
                <button type="submit" 
                    class="flex-1 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black rounded-2xl shadow-lg shadow-emerald-100 dark:shadow-none transition-all hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-2 tracking-widest uppercase text-xs">
                    CADASTRAR MÉDICO
                    <span class="material-symbols-sharp">how_to_reg</span>
                </button>
                
                <a href="{{ route('medicos') }}" 
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