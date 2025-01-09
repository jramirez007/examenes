<?php

namespace App\Models\catalogo;

use App\Models\cursos\Curso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    
    protected $table = 'categoria';
    protected $primaryKey = 'id';
    //public $timestamps = false;

    protected $fillable = [
        'nombre',
        'activo',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
