<?php

namespace App\Models\cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $table = 'tema';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'curso_id',
    ];

    protected $guarded = [];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
}
