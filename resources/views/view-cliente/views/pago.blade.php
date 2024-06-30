<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <form action="{{ route('cliente.guardarPagoDeReserva') }}" method="POST">
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
                                <h5>Pagar reserva</h5>
                            </div>
                            <div class="pt-0 card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="estado" class="form-label">Seleccionar metodo</label>
                                            <select class="form-select" id="tipo_de_metodo_de_pago"
                                                name="tipo_de_metodo_de_pago" onchange="toggleCardFields()">
                                                <option disabled selected>Selecciona un metodo...</option>
                                                <option value="efectivo">Efectivo</option>
                                                <option value="tarjeta">Tarjeta</option>
                                            </select>
                                        </div>
                                        @error('tipo_de_metodo_de_pago')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4 card-fields">
                                        <label for="numero_tarjeta">Nro de tarjeta</label>
                                        <input type="text" name="numero_tarjeta" id="numero_tarjeta"
                                            value="{{ old('numero_tarjeta') }}" class="form-control">
                                        @error('numero_tarjeta')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4 card-fields">
                                        <label for="nombre_en_la_tarjeta">Titular de la tarjeta</label>
                                        <input type="text" name="nombre_en_la_tarjeta" id="nombre_en_la_tarjeta"
                                            value="{{ old('nombre_en_la_tarjeta') }}" class="form-control">
                                        @error('nombre_en_la_tarjeta')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 card-fields">
                                        <label for="fecha_vencimiento">Fecha vencimiento</label>
                                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                                            value="{{ old('fecha_vencimiento') }}" class="form-control">
                                        @error('fecha_vencimiento')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4 card-fields">
                                        <label for="cvv_cvc">CVV/CVC</label>
                                        <input type="text" name="cvv_cvc" id="cvv_cvc" value="{{ old('cvv_cvc') }}"
                                            class="form-control">
                                        @error('cvv_cvc')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label for="monto">Monto</label>
                                        <input type="numeric" name="monto" id="monto" value="{{ old('monto') }}"
                                            class="form-control">
                                        @error('monto')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="estado" class="form-label">Seleccionar estado</label>
                                        <select class="form-select" id="estado" name="estado">
                                            <option disabled selected>Selecciona un estado...</option>
                                            <option value="pendiente">Pendiente</option>
                                            <option value="completado">Completado</option>
                                        </select>
                                    </div>
                                    @error('estado')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <input type="hidden" name="id_reserva" id="id_reserva" value="{{ $id_reserva }}"
                                    class="form-control">
                            </div>

                            <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Guardar</button>
                            <a type="submit" href="{{ route('cliente.inicio') }}"
                                class="mt-6 mb-0 btn btn-white btn-sm float-end">Cancelar</a>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
    </main>

    <script>
        function toggleCardFields() {
            var paymentMethod = document.getElementById('tipo_de_metodo_de_pago').value;
            var cardFields = document.querySelectorAll('.card-fields');

            if (paymentMethod === 'tarjeta') {
                cardFields.forEach(function (field) {
                    field.style.display = 'block';
                });
            } else {
                cardFields.forEach(function (field) {
                    field.style.display = 'none';
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleCardFields(); // Llamar a la función al cargar la página para ocultar/mostrar campos según el valor seleccionado
        });
    </script>
</x-app-layout>
