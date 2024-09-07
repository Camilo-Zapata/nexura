<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Area;


class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'nombre',
        'email',
        'sexo',
        'area_id',
        'descripcion',
        'boletin',
       
    ];

    // Si roles es un array JSON
    protected $casts = [
        'roles' => 'array'  ];

        public function rols()
{
    return $this->belongsToMany(Role::class);
}

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'empleado_rol');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
