<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <form action={{ route('promocion.store') }} method="POST">
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
                                <h5>Agregar promocion</h5>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-6">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="nombre" id="nombre"
                                        value="{{old('nombre')}}" class="form-control">
                                        @error('nombre')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>


                                        <div class="col-6">
                                            <label for="name">Descripcion</label>
                                            <input type="text" name="descripcion" id="descripcion"
                                            value="{{old('descripcion')}}" class="form-control">
                                            @error('descripcion')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                </div>
                                <div class="row">

                                    <div class="col-6">
                                        <label for="correo">Fecha Inicio</label>
                                        <input type="date" name="fecha_inicio" id="fecha_inicio"
                                        value="{{old('fecha_inicio')}}" class="form-control">
                                        @error('fecha_inicio')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="fecha_fin">Fecha Fin</label>
                                        <input type="date" name="fecha_fin" id="fecha_fin"

                                             value="{{old('fecha_fin')}}"
                                            class="form-control">
                                        @error('fecha_fin')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>







                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="descuento">Descuento</label>
                                        <input type="number" name="descuento" id="descuento" step="0.01" min="0"
                                        value="{{old('descuento')}}" class="form-control">
                                        @error('descuento')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>


                                         <div class="col-6">
                                             <div class="form-group">
                                                 <label for="servicio" class="form-label">Seleccionar servicio</label>
                                                 <select class="form-select" id="id_servicio" name="id_servicio">
                                                     <option disabled disabled selected>Selecciona un servicio...</option>

                                                     @foreach ($servicios as $servicio)
                                                         <option value="{{$servicio->id}} " >{{$servicio->nombre}}</option>
                                                     @endforeach

                                                 </select>
                                             </div>
                                             @error('id_servicio')
                                             <span class="text-danger text-sm">{{ $message }}</span>
                                         @enderror

                                     </div>
                                </div>

                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Guardar</button>
                                <a type="submit" href="{{route('promocion.index')}}" class="mt-6 mb-0 btn btn-white btn-sm float-end">Cancelar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-app-layout>
