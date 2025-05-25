<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de Ciudadanos
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-7xl mx-auto space-y-6">

        {{-- Botón crear ciudadano --}}
        <div class="text-right">
            <a href="{{ route('citizens.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                + Agregar nuevo ciudadano
            </a>
        </div>

        {{-- Tabla de ciudadanos --}}
        <div class="overflow-x-auto">
            <table class="table-auto w-full border text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="border px-4 py-2">Nombre</th>
                        <th class="border px-4 py-2">Apellido</th>
                        <th class="border px-4 py-2">Ciudad</th>
                        <th class="border px-4 py-2">Dirección</th>
                        <th class="border px-4 py-2">Fecha de Nacimiento</th>
                        <th class="border px-4 py-2">Teléfono</th>
                        <th class="border px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($citizens as $citizen)
                        <tr>
                            <td class="border px-4 py-2">{{ $citizen->first_name }}</td>
                            <td class="border px-4 py-2">{{ $citizen->last_name }}</td>
                            <td class="border px-4 py-2">{{ $citizen->city->name }}</td>
                            <td class="border px-4 py-2">{{ $citizen->address }}</td>
                            <td class="border px-4 py-2">{{ $citizen->birth_date}}</td>
                            <td class="border px-4 py-2">{{ $citizen->phone }}</td>
                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('citizens.edit', $citizen) }}"
                                    class="text-blue-600 hover:underline">Editar</a>

                                <form action="{{ route('citizens.destroy', $citizen) }}" method="POST" class="inline-block form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 italic text-gray-500">
                                No hay ciudadanos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

        </div>
    </div>

    {{-- SweetAlert2: confirmación al eliminar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.form-eliminar');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro de eliminar este ciudadano?',
                        text: 'Esta acción no se puede deshacer.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

</x-app-layout>
