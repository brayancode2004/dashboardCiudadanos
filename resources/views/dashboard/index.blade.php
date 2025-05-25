<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10 px-6 max-w-7xl mx-auto space-y-8">

        {{-- Tarjetas con métricas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h3 class="text-lg font-semibold mb-2">Total de ciudades</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $totalCiudades }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h3 class="text-lg font-semibold mb-2">Total de ciudadanos</h3>
                <p class="text-3xl font-bold text-green-600">{{ $totalCiudadanos }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h3 class="text-lg font-semibold mb-2">Ciudades con ciudadanos</h3>
                <ul class="text-sm mt-2 text-gray-700 space-y-1 text-left">
                    @forelse ($ciudadanosPorCiudad as $ciudad)
                        <li><strong>{{ $ciudad->name }}:</strong> {{ $ciudad->citizens_count }} ciudadanos</li>
                    @empty
                        <li class="italic text-gray-500">No hay ciudades registradas.</li>
                    @endforelse
                </ul>
            </div>
        </div>
</x-app-layout>
