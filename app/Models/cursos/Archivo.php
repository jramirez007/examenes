<?php

namespace App\Models\cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $table = 'archivo';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'tema_id',
    ];

    protected $guarded = [];
}
