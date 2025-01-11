<?php

namespace App\Models\cursos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenCurso extends Model
{
    use HasFactory;

    protected $table = 'examen_curso';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'fecha',
        'finalizado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getResposeText()
    {
        try {
            // Intentar obtener el resultado de la base de datos
            $resultado = ExamenCursoResultado::where('examen_curso_id', $this->id)
                ->where('pregunta_id', 80)
                ->first();

            // Verificar si se encontró el registro
            if ($resultado) {
                return $resultado->respuesta_text;
            } else {
                // Si no se encuentra el resultado, devolver null
                return null;
            }
        } catch (\Exception $e) {
            // En caso de cualquier excepción, devolver null
            return null;
        }
    }


    public function getAudio()
    {
        try {

            $resultado = ExamenCursoResultado::where('examen_curso_id', $this->id)->where('pregunta_id',85)->first();

            // Verificar si se encontró el registro
            if ($resultado) {
                return $resultado->audio;
            } else {
                // Si no se encuentra el resultado, devolver null
                return null;
            }
        } catch (\Exception $e) {
            // En caso de cualquier excepción, devolver null
            return null;
        }
    }
}
