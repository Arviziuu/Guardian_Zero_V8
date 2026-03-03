@extends('layouts.admin')

@section('content')

<h2>Dashboard</h2>

<div class="row">

    <div class="col-md-3">
        <div class="card p-3">
            <h5>Incidentes Hoy</h5>
            <h3>25</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <h5>Críticos</h5>
            <h3>5</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <h5>Tiempo Promedio</h5>
            <h3>2h</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <h5>Voluntarios</h5>
            <h3>18</h3>
        </div>
    </div>

</div>

@endsection