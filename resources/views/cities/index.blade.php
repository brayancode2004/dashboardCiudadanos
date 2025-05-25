<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de Ciudades
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-7xl mx-auto space-y-6">

        {{-- Botón crear ciudad --}}
        <div class="text-right">
            <a href="{{ route('cities.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                + Agregar nueva ciudad
            </a>
        </div>

        {{-- Tabla de ciudades --}}
        <div class="overflow-x-auto">
            <table class="table-auto w-full border text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="border px-4 py-2">Nombre</th>
                        <th class="border px-4 py-2">Descripción</th>
                        <th class="border px-4 py-2">Ciudadanos</th>
                        <th class="border px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cities as $city)
                        <tr>
                            <td class="border px-4 py-2">{{ $city->name }}</td>
                            <td class="border px-4 py-2">{{ $city->descripcion }}</td>
                            <td class="border px-4 py-2">{{ $city->citizens_count }}</td>
                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('cities.edit', $city) }}"
                                    class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('cities.destroy', $city) }}" method="POST" class="inline-block form-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 italic text-gray-500">
                                No hay ciudades registradas.
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


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.form-eliminar');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // Evita que el formulario se envíe de inmediato

                    Swal.fire({
                        title: '¿Estás seguro de eliminar esta ciudad?',
                        text: 'Esta acción no se puede deshacer.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Solo se envía si el usuario confirma
                        }
                    });
                });
            });
        });
    </script>


</x-app-layout>
