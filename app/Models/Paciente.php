<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable =[
        'nome',
        'apelido',
        'genero',
        'data_nascimento',
        'contacto'
    ];

    public function doencas()
    {
        return $this->belongsToMany(Doenca::class, 'doenca_pacientes')->withTimestamps();
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
}
