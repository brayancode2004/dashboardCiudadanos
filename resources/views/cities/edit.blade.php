<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar ciudad
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-xl mx-auto">
        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <form action="{{ route('cities.update', $city) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Nombre de la ciudad</label>
                <input type="text" name="name" value="{{ old('name', $city->name) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Descripción</label>
                <textarea name="descripcion" rows="3"
                    class="w-full border rounded px-3 py-2">{{ old('descripcion', $city->descripcion) }}</textarea>
            </div>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                Actualizar
            </button>
        </form>
    </div>
</x-app-layout>
