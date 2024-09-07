<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empleado;




class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre', 
    ];

    // Definir la relación con el modelo Empleado
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_rol');
    }
}
