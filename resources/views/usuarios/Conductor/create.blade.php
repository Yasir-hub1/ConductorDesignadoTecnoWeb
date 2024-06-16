<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <form action={{ route('conductor.store') }} method="POST">
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
                                <h5>Agregar Conductor</h5>
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
                                        <label for="numero_de_licencia_de_conducir">Nro de licencia</label>
                                        <input type="text" name="numero_de_licencia_de_conducir" id="numero_de_licencia_de_conducir"
                                            value="{{ old('numero_de_licencia_de_conducir') }}" class="form-control">
                                        @error('numero_de_licencia_de_conducir')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label for="tipo_de_licencia">Tipo de Licencia</label>
                                        <input type="text" name="tipo_de_licencia" id="tipo_de_licencia"
                                            value="{{ old('tipo_de_licencia') }}" class="form-control">
                                        @error('tipo_de_licencia')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-4">
                                        <label for="fecha_de_vencimiento_de_la_licencia">Vencimiento de licencia</label>
                                        <input type="date" name="fecha_de_vencimiento_de_la_licencia" id="fecha_de_vencimiento_de_la_licencia"
                                            value="{{ old('fecha_de_vencimiento_de_la_licencia') }}" class="form-control">
                                        @error('fecha_de_vencimiento_de_la_licencia')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>





                                   </div>
                                </div>
                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Guardar</button>
                                <a type="submit" href="{{route('conductor.index')}}" class="mt-6 mb-0 btn btn-white btn-sm float-end">Cancelar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-app-layout>
