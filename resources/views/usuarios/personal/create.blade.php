<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <form action={{ route('personal.store') }} method="POST">
                @csrf
                @method('POST')

                <div class="row justify-content-center">
                    <div class="col-lg-9 col-12">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert" id="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert" id="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-5 row justify-content-center">
                    <div class="col-lg-9 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header">
                                <h5>Agregar Personal</h5>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-4">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="nombre" id="nombre"
                                            value="{{ old('nombre') }}" class="form-control">
                                        @error('nombre')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>


                                        <div class="col-4">
                                            <label for="name">Apellido</label>
                                            <input type="text" name="apellido" id="apellido"
                                                value="{{ old('apellido') }}" class="form-control">
                                            @error('apellido')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    <div class="col-4">
                                        <label for="correo">correo</label>
                                        <input type="correo" name="correo" id="correo"
                                            value="{{ old('correo') }}" class="form-control">
                                        @error('correo')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="celular">Celular</label>
                                        <input type="text" name="celular" id="celular"

                                            value="{{ old('celular') }}"
                                            class="form-control">
                                        @error('celular')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label for="fecha_de_nacimiento">Fecha de Nacimiento</label>
                                        <input type="date" name="fecha_de_nacimiento" id="fecha_de_nacimiento"
                                            value="{{ old('fecha_de_nacimiento') }}" class="form-control">
                                        @error('fecha_de_nacimiento')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="genero" class="form-label">Seleccionar genero</label>
                                            <select class="form-select" id="genero" name="genero">
                                                <option disabled selected>Selecciona un genero...</option>


                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>

                                            </select>
                                        </div>
                                        @error('genero')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                    </div>



                                </div>
                                <div class="row p-2">
                                   <div class="row">


                                    <div class="col-4">
                                        <label for="salario">Salario</label>
                                        <input type="number" name="salario" id="salario"
                                            value="{{ old('salario') }}" class="form-control">
                                        @error('salario')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="cargo" class="form-label">Seleccionar cargo</label>
                                            <select class="form-select" id="cargo" name="cargo">
                                                <option disabled selected>Selecciona un cargo...</option>


                                                    <option value="Administrativo">Administrativo</option>
                                                    <option value="Empleado">Empleado</option>

                                            </select>
                                        </div>
                                        @error('cargo')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="estado" class="form-label">Seleccionar Estado</label>
                                            <select class="form-select" id="estado" name="estado">
                                                <option disabled selected>Selecciona un estado...</option>


                                                    <option value="activo">Activo</option>
                                                    <option value="inactivo">Inactivo</option>

                                            </select>
                                        </div>
                                        @error('estado')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                    </div>








                                   </div>
                                </div>
                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Guardar</button>
                                <a type="submit" href="{{route('personal.index')}}" class="mt-6 mb-0 btn btn-white btn-sm float-end">Cancelar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-app-layout>
