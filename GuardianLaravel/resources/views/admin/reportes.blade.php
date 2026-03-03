@extends('layouts.admin')

@section('content')

<h2>Exportar Reportes</h2>

<div class="card p-4">

    <form>

        <label>Rango de Fechas</label>
        <input type="date" class="form-control mb-2">
        <input type="date" class="form-control mb-2">

        <button class="btn btn-danger">Exportar PDF</button>
        <button class="btn btn-success">Exportar CSV</button>

    </form>

</div>

@endsection