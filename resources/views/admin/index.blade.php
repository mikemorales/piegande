@extends('layouts.app')

@section('content')
    @include('layouts.menu')
    <div class="container mt-4">
        <div class="row justify-content-center my-5">
            <div class="col text-center">
                Bienvenido a su panel de gestión de los eventos con preregistro de Baja Wines. Para iniciar, elija alguna de las opciones del menú superior.
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-3 text-center border border-4 p-3 rounded-3">
                <i class="fa-solid fa-calculator fa-4x"></i>
                <h2 class="text-danger mt-3">{{ $totalrecords }}</h2>
                <p>Registros totales</p>
            </div>
            <div class="col-12 col-md-3 text-center border border-4 p-3 rounded-3">
                <i class="fa-solid fa-flag fa-4x"></i>
                <h2 class="text-danger mt-3">{{ $totalevents }}</h2>
                <p>Eventos totales</p>
            </div>
        </div>
    </div>
@endsection
