<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <!-- Filtros -->
            <form method="GET" action="{{ route('reporte.inicio') }}">
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"
                            value="{{ old('fecha_inicio', $fecha_inicio) }}">
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="fecha_fin" class="form-label">Fecha fin</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"
                            value="{{ old('fecha_fin', $fecha_fin) }}">
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="metodo_pago" class="form-label">Método de pago</label>
                        <select class="form-select" id="metodo_pago" name="metodo_pago">
                            <option value="">Todos</option>
                            <option value="efectivo">Efectivo</option>
                            <option value="tarjeta">Tarjeta</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 align-self-end">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </form>

            <!-- Gráfico -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <!-- Título y descripción -->
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Transacciones</h6>
                                    <p class="text-sm mb-sm-0 mb-2">Estadísticas y reporte de las transacciones de los
                                        clientes</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                        Ver reporte
                                    </button>
                                </div>
                            </div>
                            <!-- Total y porcentaje -->
                            <div class="d-sm-flex align-items-center">
                                <h3 class="mb-5 font-weight-semibold">
                                    Bs {{ number_format($transacciones->sum('total_monto'), 2) }}</h3>

                            </div>
                        </div>
                        <!-- Cuerpo del card -->
                        <div class="card-body p-3">
                            <div class="chart mt-n6">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Gráfico de gastos operativos -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <!-- Título y descripción -->
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Gastos Operativos</h6>
                                    <p class="text-sm mb-sm-5 mb-2">Estadísticas y reporte de los gastos operativos</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                        View report
                                    </button>
                                </div>
                            </div>

                        </div>
                        <!-- Cuerpo del card -->
                        <div class="card-body p-3">
                            <div class="chart mt-n6">
                                <canvas id="chart-line-gastos-operativos" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Footer -->
            <x-app.footer />
        </div>
    </main>
</x-app-layout>

<script>
    var ctx2 = document.getElementById("chart-line").getContext("2d");

    // Datos dinámicos desde PHP
    var labels = @json($labels);
    var data = @json($data);

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(45,168,255,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(45,168,255,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(45,168,255,0)'); //blue colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(119,77,211,0.4)');
    gradientStroke2.addColorStop(0.7, 'rgba(119,77,211,0.1)');
    gradientStroke2.addColorStop(0, 'rgba(119,77,211,0)'); //purple colors

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "Volumen",
                tension: 0,
                borderWidth: 2,
                pointRadius: 3,
                borderColor: "#2ca8ff",
                pointBorderColor: '#2ca8ff',
                pointBackgroundColor: '#2ca8ff',
                fill: true,
                backgroundColor: gradientStroke1,
                data: data,
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#9ca2b7'
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 20,
                        color: '#9ca2b7'
                    }
                },
            },
        },
    });



     // Datos para el gráfico de gastos operativos
     var labelsGastosOperativos = @json($labelsGastosOperativos);
        var dataGastosOperativos = @json($dataGastosOperativos);

        var ctxGastosOperativos = document.getElementById("chart-line-gastos-operativos").getContext("2d");

        var gradientStrokeGastosOperativos = ctxGastosOperativos.createLinearGradient(0, 230, 0, 50);
        gradientStrokeGastosOperativos.addColorStop(1, 'rgba(119,77,211,0.4)');
        gradientStrokeGastosOperativos.addColorStop(0.7, 'rgba(119,77,211,0.1)');
        gradientStrokeGastosOperativos.addColorStop(0, 'rgba(119,77,211,0)'); // purple colors

        new Chart(ctxGastosOperativos, {
            type: "line",
            data: {
                labels: labelsGastosOperativos,
                datasets: [{
                    label: "Monto",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    borderColor: "#832bf9",
                    pointBorderColor: '#832bf9',
                    pointBackgroundColor: '#832bf9',
                    fill: true,
                    backgroundColor: gradientStrokeGastosOperativos,
                    data: dataGastosOperativos,
                    maxBarThickness: 6
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#9ca2b7'
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 20,
                            color: '#9ca2b7'
                        }
                    },
                },
            },
        });
</script>
