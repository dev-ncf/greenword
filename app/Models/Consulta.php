<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable=['paciente_id','observacoes','data_consulta','estado'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doencas()
    {
        return $this->belongsToMany(Doenca::class, 'consulta_doencas')->withTimestamps();
    }
}
