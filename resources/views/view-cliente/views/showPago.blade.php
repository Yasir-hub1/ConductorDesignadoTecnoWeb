<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container">
            <h1>Solicitud de Servicio</h1>

            <p><strong>ID de Solicitud:</strong> {{ $solicitud->id }}</p>
            <p><strong>Fecha de Solicitud:</strong> {{ $solicitud->fecha_solicitud }}</p>
            <p><strong>Origen:</strong> {{ $solicitud->origen }}</p>
            <p><strong>Destino:</strong> {{ $solicitud->destino }}</p>
            <p><strong>Estado:</strong> {{ $solicitud->estado }}</p>

            @if ($solicitud->transaccion)
                <h2>Transacción</h2>
                <p><strong>ID de Transacción:</strong> {{ $solicitud->transaccion->id }}</p>
                <p><strong>Fecha:</strong> {{ $solicitud->transaccion->fecha }}</p>
                <p><strong>Monto:</strong> {{ $solicitud->transaccion->monto }}</p>
                <p><strong>Estado:</strong> {{ $solicitud->transaccion->estado }}</p>

                @if ($solicitud->transaccion->metodoPago)
                    <h3>Método de Pago</h3>
                    <p><strong>Tipo de Método de Pago:</strong> {{ $solicitud->transaccion->metodoPago->tipo_de_metodo_de_pago }}</p>
                    <p><strong>Número de Tarjeta:</strong> {{ $solicitud->transaccion->metodoPago->numero_tarjeta }}</p>
                    <p><strong>Nombre en la Tarjeta:</strong> {{ $solicitud->transaccion->metodoPago->nombre_en_la_tarjeta }}</p>
                    <p><strong>Fecha de Vencimiento:</strong> {{ $solicitud->transaccion->metodoPago->fecha_vencimiento }}</p>
                    <p><strong>CVV/CVC:</strong> {{ $solicitud->transaccion->metodoPago->cvv_cvc }}</p>
                @else
                    <p>No se encontró información del método de pago.</p>
                @endif
            @else
                <p>No se encontró información de la transacción.</p>
            @endif
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
