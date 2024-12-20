<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doenca extends Model
{
    use HasFactory;
    protected $fillable =[
        'nome',
        'descricao'
    ];
    public function truncateWords($text, $limit)
{
    $words = explode(' ', $text); // Divide o texto em palavras
    if (count($words) > $limit) {
        $words = array_slice($words, 0, $limit); // Mantém apenas as primeiras 5 palavras
        return implode(' ', $words) . '...'; // Junta as palavras e adiciona "..."
    }
    return $text; // Retorna o texto original se tiver 5 palavras ou menos
}

    public function pacientes()
    {
        return $this->belongsToMany(Paciente::class, 'doenca_pacientes')->withTimestamps();
    }

    public function consultas()
    {
        return $this->belongsToMany(Consulta::class, 'consulta_doencas')->withTimestamps();
    }
}
