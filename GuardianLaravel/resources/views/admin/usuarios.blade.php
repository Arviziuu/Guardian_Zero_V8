@extends('layouts.admin')

@section('content')

<h2>Usuarios</h2>

<table class="table">

<tr>
    <th>Nombre</th>
    <th>Rol</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>

<tr>
    <td>Ana López</td>
    <td>Voluntario</td>
    <td>Activo</td>
    <td>
        <button class="btn btn-warning btn-sm">Desactivar</button>
        <button class="btn btn-info btn-sm">Cambiar Rol</button>
    </td>
</tr>

</table>

@endsection