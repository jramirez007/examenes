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

    public function respuestasArray()
    {
        // Obtener las respuestas asociadas con la pregunta
        $repuestas = Respuesta::where('pregunta_id', $this->id)->get();

        // Crear el arreglo de IDs con el prefijo 'container-'
        $idArray = $repuestas->pluck('id')->map(function ($id) {
            return 'container-' . $id;
        })->toArray();

        return $idArray; // Regresar el arreglo de IDs con el prefijo
    }



    public function getRespuesta($respuesta_id)
    {
        // Buscar el primer registro que coincida con 'respuesta_id' y 'pregunta_id'
        $registro = ExamenCursoResultado::where('respuesta_id', $respuesta_id)
            ->where('pregunta_id', $this->id)
            ->whereHas('examenCurso', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->first();

        $respuesta_id = null;

        if ($registro) {
            $respuesta_id = $registro->respuesta_id;
        }


        // Si no se encuentra el registro, puede devolver null, o un valor predeterminado
        return  $respuesta_id;
    }

    public function getRespuestaAdmin($respuesta_id, $examen_curso_id)
    {
        // Buscar el primer registro que coincida con 'respuesta_id' y 'pregunta_id'
        $registro = ExamenCursoResultado::where('respuesta_id', $respuesta_id)
            ->where('pregunta_id', $this->id)
            ->where('examen_curso_id', $examen_curso_id)
            ->first();

        $respuesta_id = null;

        if ($registro) {
            $respuesta_id = $registro->respuesta_id;
        }

        // Si no se encuentra el registro, puede devolver null, o un valor predeterminado
        return  $respuesta_id;
    }
}
