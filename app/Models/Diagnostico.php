<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;
     protected $fillable=['paciente_id','doenca_id','estado'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
   

    public function doenca()
    {
        return $this->belongsTo(Doenca::class);
    }
}
