<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ciudadanos agrupados por ciudad
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-7xl mx-auto">

        {{-- Buscador --}}
        <form method="GET" action="{{ route('dashboard.agrupado') }}" class="mb-6">
            <input type="text" name="buscar" value="{{ $busqueda }}" placeholder="Buscar por nombre..."
                class="border rounded px-4 py-2 w-full md:w-1/3" />
        </form>

        {{-- Ciudadanos agrupados --}}
        @forelse ($ciudades as $ciudad)
            <div class="mb-6">
                <h3 class="text-lg font-bold text-blue-600">{{ $ciudad->name }}</h3>

                @if ($ciudad->citizens->isEmpty())
                    <p class="text-gray-500 italic">No hay ciudadanos registrados.</p>
                @else
                    <div class="overflow-x-auto mt-2">
                        <table class="table-auto w-full border mt-2 text-sm">
                            <thead class="bg-gray-100 text-left">
                                <tr>
                                    <th class="border px-4 py-2">Nombre</th>
                                    <th class="border px-4 py-2">Apellido</th>
                                    <th class="border px-4 py-2">Dirección</th>
                                    <th class="border px-4 py-2">Teléfono</th>
                                    <th class="border px-4 py-2">Fecha de nacimiento</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ciudad->citizens as $ciudadano)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $ciudadano->first_name }}</td>
                                        <td class="border px-4 py-2">{{ $ciudadano->last_name }}</td>
                                        <td class="border px-4 py-2">{{ $ciudadano->address }}</td>
                                        <td class="border px-4 py-2">{{ $ciudadano->phone }}</td>
                                        <td class="border px-4 py-2">{{ $ciudadano->birth_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-500">No hay ciudades registradas.</p>
        @endforelse
        
            {{-- Botón para enviar el reporte --}}
            <div class="text-right mt-8">
               <form id="form-enviar-reporte" action="{{ route('dashboard.enviar-reporte') }}" method="GET" onsubmit="return confirmarEnvioAgrupado()">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded shadow">
                        Enviar reporte por correo
                    </button>
                </form>
            </div>
    </div>
        <script>
        function confirmarEnvioAgrupado() {
        Swal.fire({
            title: '¿Enviar reporte?',
            text: "Se enviará un correo con el listado de ciudadanos agrupados por ciudad.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, enviar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-enviar-reporte').submit();
            }
        });

        return false;
    }

    </script>

    @if (session('success') || session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: '{{ session("success") ? "success" : "error" }}',
                    title: '{{ session("success") ? "Éxito" : "Error" }}',
                    text: '{{ session("success") ?? session("error") }}',
                    confirmButtonColor: '#2563eb'
                });
            });
        </script>
    @endif

</x-app-layout>