<?php

namespace App\Models\catalogo;

use App\Models\cursos\Curso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estado';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    protected $guarded = [];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
