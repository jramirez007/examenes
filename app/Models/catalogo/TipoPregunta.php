<?php

namespace App\Models\catalogo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPregunta extends Model
{
    use HasFactory;

    protected $table = 'tipo_pregunta';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];

    protected $guarded = [];
}
