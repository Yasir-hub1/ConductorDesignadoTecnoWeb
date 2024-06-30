<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <form action={{ route('vehiculo.update', [$vehiculo->id]) }} method="POST">
                @csrf
                @method('PUT')

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
                                <h5>Actualizar Vehiculo</h5>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-4">
                                        <label for="name">Modelo</label>
                                        <input type="text" name="modelo" id="modelo"
                                            value="{{ $vehiculo->modelo }}" class="form-control">
                                        @error('modelo')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-4">
                                        <label for="name">Marca</label>
                                        <input type="text" name="marca" id="marca"
                                            value="{{ $vehiculo->marca }}" class="form-control">
                                        @error('marca')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="correo">Placa</label>
                                        <input type="placa" name="placa" id="placa"
                                            value="{{ $vehiculo->placa }}" class="form-control">
                                        @error('placa')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="numero_de_seguro">Numero de seguro</label>
                                        <input type="number" name="numero_de_seguro" id="numero_de_seguro"
                                            value="{{ $vehiculo->numero_de_seguro }}" class="form-control">
                                        @error('numero_de_seguro')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="fecha_vencimiento_seguro">fecha de vencimiento del seguro</label>
                                        <input type="date" name="fecha_vencimiento_seguro"
                                            id="fecha_vencimiento_seguro"
                                            value="{{ $vehiculo->fecha_vencimiento_seguro }}" class="form-control">
                                        @error('fecha_vencimiento_seguro')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>





                                </div>
                                <div class="row p-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="estado" class="form-label">Seleccionar estado</label>
                                                <select class="form-select" id="estado" name="estado">
                                                    <option disabled disabled selected>Selecciona un estado...</option>


                                                    <option value="activo"
                                                        {{ $vehiculo->estado == 'activo' ? 'selected' : '' }}>Activo
                                                    </option>
                                                    <option value="inactivo"
                                                        {{ $vehiculo->estado == 'inactivo' ? 'selected' : '' }}>
                                                        Inactivo</option>
                                                    <option value="en servicio"
                                                        {{ $vehiculo->estado == 'en servicio' ? 'selected' : '' }}>En
                                                        servicio</option>
                                                    <option value="fuera de servicio"
                                                        {{ $vehiculo->estado == 'fuera de servicio' ? 'selected' : '' }}>
                                                        Fuera de servicio</option>

                                                </select>
                                            </div>
                                            @error('estado')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="id_conductor" class="form-label">Seleccionar
                                                    conductor</label>
                                                <select class="form-select" id="id_conductor" name="id_conductor">
                                                    <option disabled disabled selected>Selecciona un conductor...
                                                    </option>
                                                    @if (empty($conductores))
                                                    <option {{ $vehiculo->conductor->id ? 'selected' : '' }} value="{{ $vehiculo->conductor->id }}">
                                                        {{ $vehiculo->conductor->nombre }}
                                                    </option>
                                                @else
                                                    @foreach ($conductores as $conductor)
                                                        <option {{ $vehiculo->id_conductor == $conductor->id ? 'selected' : '' }} value="{{ $conductor->id }}">
                                                            {{ $conductor->nombre }}
                                                        </option>
                                                    @endforeach
                                                @endif



                                                </select>
                                            </div>
                                            @error('id_conductor')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>




                                    </div>
                                </div>
                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Guardar</button>
                                <a type="submit" href="{{ route('vehiculo.index') }}"
                                    class="mt-6 mb-0 btn btn-white btn-sm float-end">Cancelar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-app-layout>
