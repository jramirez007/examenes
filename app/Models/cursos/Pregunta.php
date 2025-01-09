<?php

namespace App\Models\cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $table = 'pregunta';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];

    protected $guarded = [];

     // Definir la relación con el modelo Respuesta
     public function respuestas()
     {
         return $this->hasMany(Respuesta::class);
     }
}
