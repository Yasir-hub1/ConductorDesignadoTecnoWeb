<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <form action="{{ route('reserva.update', [$reserva->id]) }}" method="POST">
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
                    <div class="col-lg-9 col-12">
                        <div class="card" id="basic-info">
                            <div class="card-header">
                                <h5>Editar reserva</h5>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-4">
                                        <label for="fecha_solicitud">Fecha de solicitud</label>
                                        <input type="datetime-local" name="fecha_solicitud" id="fecha_solicitud"
                                            value="{{ $reserva->fecha_solicitud }}" class="form-control">
                                        @error('fecha_solicitud')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label for="fecha_servicio">Fecha de Servicio</label>
                                        <input type="datetime-local" name="fecha_servicio" id="fecha_servicio"
                                            value="{{ $reserva->fecha_servicio }}" class="form-control">
                                        @error('fecha_servicio')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label for="costo_adicional">Costo</label>
                                        <input type="text" name="costo_adicional" id="costo_adicional"
                                            value="{{ $reserva->costo_adicional }}" class="form-control">
                                        @error('costo_adicional')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="estado" class="form-label">Seleccionar estado</label>
                                            <select class="form-select" id="estado" name="estado">
                                                <option disabled selected>Selecciona un estado...</option>
                                                <option value="pendiente" {{ $reserva->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="en curso" {{ $reserva->estado == 'en curso' ? 'selected' : '' }}>En curso</option>
                                                <option value="completado" {{ $reserva->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                                                <option value="cancelado" {{ $reserva->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                            </select>
                                        </div>
                                        @error('estado')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="tipo_servicio" class="form-label">Seleccionar Tipo Servicio</label>
                                            <select class="form-select" id="tipo_servicio" name="tipo_servicio">
                                                <option disabled selected>Selecciona un tipo de servicio...</option>
                                                <option value="con reserva" {{ $reserva->tipo_servicio == 'con reserva' ? 'selected' : '' }}>Con reserva</option>
                                                <option value="sin reserva" {{ $reserva->tipo_servicio == 'sin reserva' ? 'selected' : '' }}>Sin reserva</option>
                                            </select>
                                        </div>
                                        @error('tipo_servicio')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="id_cliente" class="form-label">Seleccionar cliente</label>
                                            <select class="form-select" id="id_cliente" name="id_cliente">
                                                <option disabled selected>Selecciona un cliente...</option>
                                                @foreach ($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}" {{ $reserva->id_cliente == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('id_cliente')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row p-2">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id_conductor" class="form-label">Seleccionar conductor</label>
                                            <select class="form-select" id="id_conductor" name="id_conductor">
                                                <option disabled selected>Selecciona un conductor...</option>
                                                @foreach ($conductores as $conductor)
                                                    <option value="{{ $conductor->id }}" {{ $reserva->id_conductor == $conductor->id ? 'selected' : '' }}>{{ $conductor->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('id_conductor')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id_servicio" class="form-label">Seleccionar servicio</label>
                                            <select class="form-select" id="id_servicio" name="id_servicio">
                                                <option disabled selected>Selecciona un servicio...</option>
                                                @foreach ($servicios as $servicio)
                                                    <option value="{{ $servicio->id }}" {{ $reserva->id_servicio == $servicio->id ? 'selected' : '' }}>{{ $servicio->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('id_servicio')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div id="map" style="height: 400px;"></div>
                                        <input type="hidden" name="origen" id="origen" value="{{ $reserva->origen }}">
                                        <input type="hidden" name="destino" id="destino" value="{{ $reserva->destino }}">
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a href="{{ route('reserva.index') }}" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABHJaLOgaxiB3mVzOaJpMd8VDDgxfCBHE&callback=initMap" async defer></script>
<script>
    let map;
    let origenMarker;
    let destinoMarker;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -17.779877, lng: -63.178169 },
            zoom: 15
        });

        // Parse LatLng from string format
        function parseLatLng(latLngStr) {
            const latLngArr = latLngStr.replace(/[()]/g, '').split(',');
            return { lat: parseFloat(latLngArr[0]), lng: parseFloat(latLngArr[1]) };
        }

        // Set existing markers if they exist
        const origen = document.getElementById('origen').value;
        const destino = document.getElementById('destino').value;

        if (origen) {
            const origenLatLng = parseLatLng(origen);
            origenMarker = new google.maps.Marker({
                position: origenLatLng,
                map: map,
                label: 'Origen',
                draggable: true
            });
            google.maps.event.addListener(origenMarker, 'dragend', function(event) {
                document.getElementById('origen').value = event.latLng.toString();
            });
        }

        if (destino) {
            const destinoLatLng = parseLatLng(destino);
            destinoMarker = new google.maps.Marker({
                position: destinoLatLng,
                map: map,
                label: 'Destino',
                draggable: true
            });
            google.maps.event.addListener(destinoMarker, 'dragend', function(event) {
                document.getElementById('destino').value = event.latLng.toString();
            });
        }

        // Add click event to map to create new markers
        map.addListener('click', function(event) {
            if (!origenMarker) {
                origenMarker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                    label: 'Origen',
                    draggable: true
                });
                document.getElementById('origen').value = event.latLng.toString();
                google.maps.event.addListener(origenMarker, 'dragend', function(event) {
                    document.getElementById('origen').value = event.latLng.toString();
                });
            } else if (!destinoMarker) {
                destinoMarker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                    label: 'Destino',
                    draggable: true
                });
                document.getElementById('destino').value = event.latLng.toString();
                google.maps.event.addListener(destinoMarker, 'dragend', function(event) {
                    document.getElementById('destino').value = event.latLng.toString();
                });
            }
        });
    }
</script>
<style>
    #map {
        height: 400px;
        width: 100%;
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #form {
        position: absolute;
        top: 10px;
        left: 10px;
        background: white;
        padding: 10px;
        border-radius: 3px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
</style>
