<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <form action={{ route('gasto.store') }} method="POST">
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
                                <h5>Agregar gastos</h5>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-6">
                                        <label for="name">monto</label>
                                        <input type="text" name="monto" id="monto"
                                        value="{{old('monto')}}" class="form-control">
                                        @error('monto')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>


                                        <div class="col-6">
                                            <label for="name">fecha</label>
                                            <input type="date" name="fecha" id="fecha"
                                            value="{{old('fecha')}}" class="form-control">
                                            @error('fecha')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                </div>
                                <div class="row">

                                    <div class="col-6">
                                        <label for="correo">descripcion</label>
                                        <input type="text" name="descripcion" id="descripcion"
                                        value="{{old('descripcion')}}" class="form-control">
                                        @error('descripcion')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>



                                </div>

                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Guardar</button>
                                <a type="submit" href="{{route('gasto.index')}}" class="mt-6 mb-0 btn btn-white btn-sm float-end">Cancelar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-app-layout>
