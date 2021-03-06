<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table="libros";
    protected $primaryKey="ISBN";
    //protected $with=['carrera'];
    public $timestamps=false;
    public $incrementing=false;

    protected $fillable=
    [
        'editoriales',
        //'id_libro',
        'ISBN',
        'titulo',
        'autor',
        'id_editorial',
        'edicion',
        'id_materia',
        'id_clasifidewey',
        'paginas',
        'ejemplares',
        'resenia',
        'columna',
        'fila',
        'describe_estado',
        'foto',
        'activo',
    ];



    public function materias()
    {
        return $this->belongsTo(MateriaController::class, 'id_materia');
    }
}
