<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar ciudadano
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
        <form action="{{ route('citizens.update', $citizen) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Nombre</label>
                <input type="text" name="first_name" value="{{ old('first_name', $citizen->first_name) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Apellido</label>
                <input type="text" name="last_name" value="{{ old('last_name', $citizen->last_name) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Fecha de nacimiento</label>
                <input type="date" name="birth_date" value="{{ old('birth_date', $citizen->birth_date) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Dirección</label>
                <input type="text" name="address" value="{{ old('address', $citizen->address) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Teléfono</label>
                <input type="text" name="phone" value="{{ old('phone', $citizen->phone) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold">Ciudad</label>
                <select name="city_id" class="w-full border rounded px-3 py-2" required>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id', $citizen->city_id) == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                Actualizar
            </button>
        </form>
    </div>
</x-app-layout>
