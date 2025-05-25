<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = \App\Models\City::withCount('citizens')->orderBy('name')->get();
        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'name' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:500',
    ]);

        \App\Models\City::create($validated);

        return redirect()->route('cities.index')->with('success', 'Ciudad registrada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\City $city)
    {
         return view('cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\City $city)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $city->update($validated);

        return redirect()->route('cities.index')->with('success', 'Ciudad actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( \App\Models\City $city)
    {
         if ($city->citizens()->count() > 0) {
            return redirect()->route('cities.index')->with('error', 'No se puede eliminar esta ciudad porque tiene ciudadanos registrados.');
        }

        $city->delete();

        return redirect()->route('cities.index')->with('success', 'Ciudad eliminada exitosamente.');
    }
}
