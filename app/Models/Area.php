<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si es necesario
    protected $table = 'areas';

    // Definir los campos que se pueden asignar de manera masiva
    protected $fillable = ['nombre', 'descripcion'];
}
