<?php

namespace App\Http\Controllers;

use App\Models\Empleado; 
use App\Models\Area; 
use App\Models\Role; 
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function store(Request $request)
    {


        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'sexo' => 'required|in:masculino,femenino',
            'area' => 'required|',
            'descripcion' => 'nullable|string',
            'boletin' => 'required',
            'roles' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'sexo.required' => 'Por favor, seleccione su sexo.',
            'area.required' => 'Debe seleccionar un área.',
            'boletin.required' => 'Debe seleccionar una opcion.',
            'roles.required' => 'Debe seleccionar al menos un rol.',
        ]);
    
        
        $empleado = Empleado::create([
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'sexo' => $validated['sexo'],
            'area_id' => $validated['area'],
            'descripcion' => $validated['descripcion'] ?? null, 
            'boletin' => $validated['boletin'] ?? 0, 
        ]);

        $roles = $validated['roles']; 
        $empleado->roles()->sync($roles);

        if ($empleado = true ) {
            return redirect()->back()->with('success', 'Empleado guardado exitosamente');
        }else{
            return redirect()->back()->with('error', 'Ocurrió un error al guardar el empleado');

        }
    }


    public function index()
    {
        $empleados = Empleado::all();
        return view('index', compact('empleados'));
    }





    public function edit($id)
    {
        // Obtener el empleado a editar
        $empleado = Empleado::findOrFail($id);

        // Obtener todas las áreas y roles
        $areas = Area::all();
        $roles = Role::all();

        // Pasar el empleado, áreas y roles a la vista
        return view('edit', compact('empleado', 'areas', 'roles'));
    }

    // Método para actualizar la información del empleado
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sexo' => 'required|in:masculino,femenino',
            'area' => 'required|exists:areas,id',
            'descripcion' => 'nullable|string',
            'boletin' => 'nullable|boolean',
            'roles' => 'required|array|min:1', // Validar que roles sea un array y tenga al menos un elemento
        'roles.*' => 'exists:roles,id', // Validar cada rol individualmente
        ]);

        // Obtener el empleado a actualizar
        $empleado = Empleado::findOrFail($id);

        // Actualizar la información del empleado
        $empleado->update([
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'sexo' => $validated['sexo'],
            'area_id' => $validated['area'],
            'descripcion' => $validated['descripcion'],
            'boletin' => $validated['boletin'],
        ]);

        // Sincronizar los roles del empleado
        $empleado->roles()->sync($validated['roles']);

        // Redirigir con un mensaje de éxito
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito');
    }


    public function destroy($id)
{
    $empleado = Empleado::find($id);
    
    if ($empleado) {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    } else {
        return redirect()->route('empleados.index')->with('error', 'Empleado no encontrado.');
    }
}


}
