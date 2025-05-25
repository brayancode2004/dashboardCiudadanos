@component('mail::message')
# Reporte de Ciudadanos por Ciudad

@foreach ($ciudades as $ciudad)
## {{ $ciudad->name }}

@if ($ciudad->citizens->isEmpty())
*No hay ciudadanos registrados.*
@else
<ul>
    @foreach ($ciudad->citizens as $citizen)
        <li>{{ $citizen->first_name }} {{ $citizen->last_name }} – {{ $citizen->phone }}</li>
    @endforeach
</ul>
@endif

@endforeach

@endcomponent
