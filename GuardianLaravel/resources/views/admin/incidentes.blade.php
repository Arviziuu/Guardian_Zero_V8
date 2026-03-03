@extends('layouts.admin')

@section('content')

<h2>Incidentes</h2>

<form class="row mb-3">

    <div class="col">
        <input type="date" class="form-control">
    </div>

    <div class="col">
        <select class="form-control">
            <option>Urgencia</option>
            <option>Alta</option>
            <option>Media</option>
            <option>Baja</option>
        </select>
    </div>

    <div class="col">
        <select class="form-control">
            <option>Estado</option>
            <option>Pendiente</option>
            <option>Atendido</option>
        </select>
    </div>

    <div class="col">
        <button class="btn btn-primary">Filtrar</button>
    </div>

</form>

<table class="table table-bordered">

<thead>
<tr>
    <th>ID</th>
    <th>Zona</th>
    <th>Urgencia</th>
    <th>Estado</th>
    <th>Acción</th>
</tr>
</thead>

<tbody>
<tr>
    <td>1</td>
    <td>Norte</td>
    <td>Alta</td>
    <td>Pendiente</td>
    <td>
        <select class="form-control">
            <option>Pendiente</option>
            <option>En proceso</option>
            <option>Resuelto</option>
        </select>
    </td>
</tr>
</tbody>

</table>

@endsection