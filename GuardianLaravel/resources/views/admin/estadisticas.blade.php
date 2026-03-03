@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Estadísticas del Sistema</h2>


<div class="row mb-4">

    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6>Incidentes Hoy</h6>
                <h3 class="text-primary">32</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6>Incidentes Críticos</h6>
                <h3 class="text-danger">7</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6>Tiempo Promedio</h6>
                <h3 class="text-success">1.8 hrs</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6>Voluntarios Activos</h6>
                <h3 class="text-warning">21</h3>
            </div>
        </div>
    </div>

</div>


<div class="row">


    <div class="col-md-6 mb-4">
        <div class="card shadow-sm p-3">
            <h5 class="mb-3">Incidentes por Día</h5>

            <table class="table table-sm text-center">
                <thead class="table-light">
                    <tr>
                        <th>Día</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Lunes</td><td>5</td></tr>
                    <tr><td>Martes</td><td>7</td></tr>
                    <tr><td>Miércoles</td><td>6</td></tr>
                    <tr><td>Jueves</td><td>8</td></tr>
                    <tr><td>Viernes</td><td>6</td></tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-md-6 mb-4">
        <div class="card shadow-sm p-3">
            <h5 class="mb-3">Actividad de Voluntarios</h5>

            <table class="table table-sm text-center">
                <thead class="table-light">
                    <tr>
                        <th>Voluntario</th>
                        <th>Incidentes Atendidos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Ana López</td><td>12</td></tr>
                    <tr><td>Carlos Pérez</td><td>9</td></tr>
                    <tr><td>María Ruiz</td><td>15</td></tr>
                    <tr><td>Juan Torres</td><td>7</td></tr>
                </tbody>
            </table>
        </div>
    </div>

</div>


<div class="row">

    <div class="col-md-12">
        <div class="card shadow-sm p-4">

            <h5 class="mb-3">Resumen General</h5>

            <ul class="list-group">

                <li class="list-group-item">
                    ✔ Tiempo promedio de atención menor a 2 horas
                </li>

                <li class="list-group-item">
                    ✔ Incremento del 15% en atención mensual
                </li>

                <li class="list-group-item">
                    ✔ 95% de incidentes resueltos
                </li>

                <li class="list-group-item">
                    ⚠ 5% en proceso
                </li>

            </ul>

        </div>
    </div>

</div>

@endsection