<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable =[
        
        'paciente_id',
        'descricao',
        'prioridade',
        'estado',
    ];
    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
