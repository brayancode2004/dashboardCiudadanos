<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citizens = \App\Models\Citizen::with('city')->orderBy('first_name')->get();
        return view('citizens.index', compact('citizens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = \App\Models\City::orderBy('name')->get();
        return view('citizens.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city_id' => 'required|exists:cities,id',
        ]);

        \App\Models\Citizen::create($validated);

        return redirect()->route('citizens.index')->with('success', 'Ciudadano registrado exitosamente.');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Citizen $citizen)
    {
        $cities = \App\Models\City::orderBy('name')->get();
        return view('citizens.edit', compact('citizen', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Citizen $citizen)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city_id' => 'required|exists:cities,id',
        ]);

        $citizen->update($validated);

        return redirect()->route('citizens.index')->with('success', 'Ciudadano actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Citizen $citizen)
    {
        $citizen->delete();

        return redirect()->route('citizens.index')->with('success', 'Ciudadano eliminado exitosamente.');
    }
}
