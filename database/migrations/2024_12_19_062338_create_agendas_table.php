<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('paciente',60);
            $table->string('email',60)->nullable();
            $table->string('contacto',60)->nullable();
            $table->foreignId('medico_id')->nullable()->constrained();
            $table->foreignId('paciente_id')->nullable()->constrained();
            $table->date('data');
            $table->time('hora');
            $table->text('descricao')->nullable();
            $table->enum('tipo',['Interna','Externa'])->nullable();
            $table->enum('estado',['0','1'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
