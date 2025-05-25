<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Registrar nuevo ciudadano
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-xl mx-auto">

        {{-- Errores --}}
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
        <form action="{{ route('citizens.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Nombre</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Apellido</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Fecha de nacimiento</label>
                <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Dirección</label>
                <input type="text" name="address" value="{{ old('address') }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Teléfono</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Ciudad</label>
                <select name="city_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Seleccionar ciudad</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                Guardar
            </button>
        </form>
    </div>
</x-app-layout>
