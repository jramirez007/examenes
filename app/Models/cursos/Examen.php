<?php

namespace App\Models\cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $table = 'examen';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'curso_id',
        'fecha_inicio',
        'fecha_final',
    ];


    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}
