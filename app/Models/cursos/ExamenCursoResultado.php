<?php

namespace App\Models\cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenCursoResultado extends Model
{
    use HasFactory;

    protected $table = 'examen_curso_resultado';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'pregunta_id',
        'respuesta_id',
        'correcta',
        'examen_curso_id',
        'fecha',
        'respuesta_text',
        'audio',
        'observacion_seccion8',
        'puntos_seccion8',
        'observacion_seccion9',
        'puntos_seccion9',
        'audio_actual',
        'number_words'
    ];

    // Relación belongsTo con ExamenCurso
    public function examenCurso()
    {
        return $this->belongsTo(ExamenCurso::class, 'examen_curso_id');
    }

    // Relación belongsTo con ExamenCurso
    public function respuesta()
    {
        return $this->belongsTo(Respuesta::class, 'respuesta_id');
    }
}
