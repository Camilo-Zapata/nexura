<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-5">Editar Empleado</h1>
        

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

        <form action="{{ route('empleado.update', $empleado->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nombre Completo -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo *</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" value="{{ old('nombre', $empleado->nombre) }}">
                @error('nombre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Correo Electrónico -->
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico *</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $empleado->email) }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Sexo (Radio Buttons) -->
            <div class="mb-3">
                <label class="form-label">Sexo</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('sexo') is-invalid @enderror" type="radio" name="sexo" id="masculino" value="masculino" {{ old('sexo', $empleado->sexo) == 'masculino' ? 'checked' : '' }}>
                        <label class="form-check-label" for="masculino">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('sexo') is-invalid @enderror" type="radio" name="sexo" id="femenino" value="femenino" {{ old('sexo', $empleado->sexo) == 'femenino' ? 'checked' : '' }}>
                        <label class="form-check-label" for="femenino">Femenino</label>
                    </div>
                </div>
                @error('sexo')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Área (Select) -->
            <div class="mb-3">
                <label for="area" class="form-label">Área</label>
                <select class="form-select @error('area') is-invalid @enderror" id="area" name="area" required>
                    <option value="">Seleccione un área</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area', $empleado->area_id) == $area->id ? 'selected' : '' }}>
                            {{ $area->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('area')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Descripción (Textarea) -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $empleado->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Radio Buttons para recibir información -->
            <div class="mb-3">
                <label class="form-label">¿Desea recibir boletín informativo?</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input @error('boletin') is-invalid @enderror" type="radio" name="boletin" id="boletin-si" value="1" {{ old('boletin', $empleado->boletin) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="boletin-si">Sí</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('boletin') is-invalid @enderror" type="radio" name="boletin" id="boletin-no" value="0" {{ old('boletin', $empleado->boletin) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="boletin-no">No</label>
                    </div>
                </div>
                @error('boletin')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Roles (Checkbox Group) -->
<div class="mb-3">
    <label class="form-label">Roles</label>
    @foreach($roles as $rol)
        <div class="form-check">
            <input class="form-check-input @error('roles') is-invalid @enderror" 
                type="checkbox" 
                id="rol{{ $rol->id }}" 
                name="roles[]" 
                value="{{ $rol->id }}" 
                >
            <label class="form-check-label" for="rol{{ $rol->id }}">
                {{ $rol->nombre }}
            </label>
        </div>
    @endforeach
    @error('roles')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>


            <!-- Botón de Enviar -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
            </div>
        </form>
    </div>
</body>
</html>
