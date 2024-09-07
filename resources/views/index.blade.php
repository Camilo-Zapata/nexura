<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
 <br><br>
        
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
        <h1 class="my-5">Lista de Empleados</h1>

        <a href="{{ route('empleado.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-user-plus"></i> Crear Empleado
        </a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><i class="fas fa-user"></i> Nombre</th>
                    <th><i class="fa-solid fa-at"></i> Correo Electrónico</th>
                    <th><i class="fa-solid fa-venus-mars"> </i>Sexo</th>
                    <th><i class="fa-solid fa-briefcase"></i> Área</th>
                    <th><i class="fa-solid fa-envelope"></i> Boletín    </th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->sexo }}</td>
                    <td>{{ $empleado->area->nombre }}</td> <!-- Relación con el área -->
                    <td>{{ $empleado->boletin ? 'Sí' : 'No' }}</td>
                    <td>    <a href="{{ route('empleado.edit', $empleado->id) }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i></td>
                    <td> <form action="{{ route('empleado.destroy', $empleado->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
