<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Citizen;
use App\Mail\ReporteCiudadanos;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCiudades = City::count();
        $totalCiudadanos = Citizen::count();

        $ciudadanosPorCiudad = City::withCount('citizens')
            ->orderBy('name')
            ->get();

        return view('dashboard.index', compact(
            'totalCiudades',
            'totalCiudadanos',
            'ciudadanosPorCiudad'
        ));
    }
    public function vistaAgrupada(Request $request)
    {
        $busqueda = $request->input('buscar');

        $ciudades = City::with(['citizens' => function ($query) use ($busqueda) {
            if ($busqueda) {
                $query->where('first_name', 'like', "%$busqueda%")
                    ->orWhere('last_name', 'like', "%$busqueda%");
            }
        }])
        ->orderBy('name')
        ->get();

        return view('dashboard.agrupado', compact('ciudades', 'busqueda'));
    }
        public function enviarReporte()
    {
        $ciudades = \App\Models\City::with('citizens')->orderBy('name')->get();

        try {
            Mail::to('codebrayan2004@gmail.com')->send(new \App\Mail\ReporteCiudadanos($ciudades));
            return redirect()->route('dashboard.agrupado')->with('success', '¡Reporte enviado por correo correctamente!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.agrupado')->with('error', 'Error al enviar correo: ' . $e->getMessage());
        }
    }



}