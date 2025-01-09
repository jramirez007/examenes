<?php

namespace App\Models\cursos;

use App\Models\catalogo\Estado;
use App\Models\catalogo\Categoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;


    protected $table = 'curso';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'categoria_id',
        'imagen',
        'descripcion',
        'estado_id',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function examenes()
    {
        return $this->hasMany(Examen::class);
    }

    public function temas()
    {
        return $this->hasMany(Tema::class);
    }
}
