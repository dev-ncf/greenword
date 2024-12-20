<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable =[
        'paciente',
        'email',
        'contacto',
        'data',
        'hora',
        'medico_id',
        'paciente_id',
        'descricao',
        'tipo',
        'estado',
    ];
    public function medico(){
        return $this->belongsTo(Medico::class);
    }
}
