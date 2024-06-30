<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="d-md-flex align-items-center mb-3 mx-2">
                <div class="mb-md-0 mb-3">
                    <h3 class="font-weight-bold mb-0">{{ Auth::user()->nombre }}</h3>
                    <p class="mb-0">Visualiza tus designaciones</p>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Reserva</h6>
                                    <p class="text-sm mb-sm-0">Lista de reserva registrados</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <div class="input-group input-group-sm ms-auto me-2">
                                        <span class="input-group-text text-body">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                                </path>
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control form-control-sm" placeholder="Buscar">
                                    </div>

                                    {{-- <a type="button" href="{{ route('reserva.create') }}"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Agregar</span>
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                Fecha de soliciud</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                Fecha de servicio</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Costo</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Estado
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Tipo de servicio</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Cliente</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Servicio</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Conductor</th>



                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reservas as $reserva)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">

                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">{{ $reserva->fecha_solicitud }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        {{ $reserva->fecha_servicio }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        {{ $reserva->costo_adicional }}
                                                    </p>
                                                </td>
                                                <td>
                                                    @if ($reserva->estado == 'completado')
                                                        <span
                                                            class="badge badge-sm border border-success text-success bg-success">{{ $reserva->estado }}</span>
                                                    @elseif ($reserva->estado == 'pediente')
                                                        <span
                                                            class="badge badge-sm border border-info text-info bg-info">{{ $reserva->estado }}</span>
                                                    @elseif ($reserva->estado == 'cancelado')
                                                        <span
                                                            class="badge badge-sm border border-danger text-danger bg-danger">{{ $reserva->estado }}</span>
                                                    @elseif ($reserva->estado == 'en curso')
                                                        <span
                                                            class="badge badge-sm border border-info text-info bg-info">{{ $reserva->estado }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($reserva->tipo_servicio == 'con reserva')
                                                        <span
                                                            class="badge badge-sm border border-success text-success bg-success">

                                                            {{ $reserva->tipo_servicio }}
                                                        </span>
                                                    @else
                                                        <span
                                                            class="badge badge-sm border border-info text-info bg-info">

                                                            {{ $reserva->tipo_servicio }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex">

                                                        <div class="ms-2">
                                                            <p class="text-dark text-sm mb-0">
                                                                {{ $reserva->cliente->nombre }}</p>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex">

                                                        <div class="ms-2">
                                                            <p class="text-dark text-sm mb-0">
                                                                {{ $reserva->servicio->nombre }}</p>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex">

                                                        <div class="ms-2">
                                                            <p class="text-dark text-sm mb-0">
                                                                {{ $reserva->conductor->nombre }}</p>

                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- {{ var_dump($reserva->origen) }} --}}

                                                <td class="align-middle">
                                                    <a href="#" class="text-secondary font-weight-bold text-xs"
                                                        data-bs-toggle="modal" data-bs-target="#mapModal"
                                                        onclick="showMap('{{ $reserva->origen }}', '{{ $reserva->destino }}')">
                                                        <svg width="14" height="14" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM11 17H13V15H11V17ZM11 13H13V7H11V13Z"
                                                                fill="#64748B" />
                                                        </svg>
                                                    </a>
                                                </td>




                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                <!-- Botón Previous -->
                                @if ($reservas->onFirstPage())
                                    <button class="btn btn-sm btn-white d-sm-block d-none mb-0"
                                        disabled>Anterior</button>
                                @else
                                    <a href="{{ $reservas->previousPageUrl() }}"
                                        class="btn btn-sm btn-white d-sm-block d-none mb-0">Anterior</a>
                                @endif

                                <nav aria-label="..." class="ms-auto">
                                    <ul class="pagination pagination-light mb-0">
                                        <!-- Links a las páginas -->
                                        @for ($i = 1; $i <= $reservas->lastPage(); $i++)
                                            <li class="page-item {{ $reservas->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link border-0 font-weight-bold"
                                                    href="{{ $reservas->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                </nav>

                                <!-- Botón Next -->
                                @if ($reservas->hasMorePages())
                                    <a href="{{ $reservas->nextPageUrl() }}"
                                        class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Siguiente</a>
                                @else
                                    <button class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto"
                                        disabled>Siguiente</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <x-app.footer />

    </main>

</x-app-layout>
<!-- Modal del Mapa -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mapModalLabel">Mapa de Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 500px;"></div>
            </div>
        </div>
    </div>
</div>


<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -17.779877,
                lng: -63.178169
            },
            zoom: 15
        });
    }

    function parseLatLng(latLngStr) {
        const latLngArr = latLngStr.replace(/[()]/g, '').split(',');
        return {
            lat: parseFloat(latLngArr[0]),
            lng: parseFloat(latLngArr[1])
        };
    }

    function showMap(origin, dest) {
        console.log("Origen:", origin, "Destino:", dest);

        // Desglosar las coordenadas
        const [originLat, originLng] = origin.slice(1, -1).split(', ').map(Number);
        const [destLat, destLng] = dest.slice(1, -1).split(', ').map(Number);

        // Centra el mapa en el origen
        map.setCenter({
            lat: originLat,
            lng: originLng
        });

        // Agrega un marcador para el origen
        new google.maps.Marker({
            position: {
                lat: originLat,
                lng: originLng
            },
            map,
            label: 'Origen',
            title: "Origen"
        });

        // Agrega un marcador para el destino
        new google.maps.Marker({
            position: {
                lat: destLat,
                lng: destLng
            },
            map,

            label: 'Destino',
            title: "Destino"
        });

        // Muestra el modal del mapa
        $('#mapModal').modal('show');
    }



</script>

<!-- Agrega tu API key de Google Maps aquí -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABHJaLOgaxiB3mVzOaJpMd8VDDgxfCBHE&callback=initMap" async
    defer></script>
