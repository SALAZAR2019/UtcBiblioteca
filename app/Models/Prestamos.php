<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    use HasFactory;
    protected $table="prestamos";
    protected $primaryKey="id_prestamo";
    public $timestamps=false;
    public $incrementing=false;
    public $keyType = 'string';
    protected $with=['ejemplar','usuario'];

    protected $fillable=
    [
        'id_prestamo',
        'id_ejemplar',
        'id_usuario',
        'id_userlogin',
        'folio',
        'estado_prestamo',
        'fecha_prestamo',
        'describe_estado'
        
    ];
    public function ejemplar(){
        return $this-> belongsTo(ejemplares::class,'id_ejemplar');
    }
    public function usuario(){
        return $this-> belongsTo(Usuarios::class,'id_usuario');
    }
}
