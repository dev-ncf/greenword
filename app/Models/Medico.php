<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $fillable=[
        'nome',
        'email',
        'contacto',
        'especialidade',
        'foto'
    ];

    public function agendas(){
        return $this->hasMany(Agenda::class);
    }
}
