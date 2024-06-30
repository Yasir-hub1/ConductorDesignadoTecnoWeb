<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Servicio</h6>
                                    <p class="text-sm mb-sm-0">Lista de servicios registrados</p>
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

                                    <a type="button" href="{{ route('servicio.create') }}"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Agregar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                Nombre</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                    Descripcion</th>

                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            </th>

                                        </tr>
                                    </thead>
                             <tbody>
                                        @foreach ($servicios as $servicio)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">

                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $servicio->nombre }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-normal mb-0">{{ $servicio->descripcion }}
                                                    </p>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="{{ route('servicio.edit',["id_servicio"=>$servicio->id] ) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-bs-toggle="tooltip" data-bs-title="Editar">
                                                        <svg width="14" height="14" viewBox="0 0 15 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z"
                                                                fill="#64748B" />
                                                        </svg>
                                                    </a>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="{{ route('servicio.delete',$servicio->id ) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                                        <svg width="14" height="14" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M7 7V6C7 5.44772 7.44772 5 8 5H16C16.5523 5 17 5.44772 17 6V7H19V6C19 4.34315 17.6569 3 16 3H8C6.34315 3 5 4.34315 5 6V7H7ZM19 9H5V19C5 20.6569 6.34315 22 8 22H16C17.6569 22 19 20.6569 19 19V9ZM9 12C9 11.4477 9.44772 11 10 11H14C14.5523 11 15 11.4477 15 12C15 12.5523 14.5523 13 14 13H10C9.44772 13 9 12.5523 9 12Z"
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
                                @if ($servicios->onFirstPage())
                                    <button class="btn btn-sm btn-white d-sm-block d-none mb-0"
                                        disabled>Anterior</button>
                                @else
                                    <a href="{{ $servicios->previousPageUrl() }}"
                                        class="btn btn-sm btn-white d-sm-block d-none mb-0">Anterior</a>
                                @endif

                                <nav aria-label="..." class="ms-auto">
                                    <ul class="pagination pagination-light mb-0">
                                        <!-- Links a las páginas -->
                                        @for ($i = 1; $i <= $servicios->lastPage(); $i++)
                                            <li class="page-item {{ $servicios->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link border-0 font-weight-bold"
                                                    href="{{ $servicios->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                </nav>

                                <!-- Botón Next -->
                                @if ($servicios->hasMorePages())
                                    <a href="{{ $servicios->nextPageUrl() }}"
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
