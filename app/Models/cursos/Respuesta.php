<?php

namespace App\Models\cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $table = 'respuesta';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'pregunta_id',
        'correcta',
    ];

    protected $guarded = [];

      // Definir la relación con el modelo Pregunta
      public function pregunta()
      {
          return $this->belongsTo(Pregunta::class, 'pregunta_id', 'id');
      }

}
