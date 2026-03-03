<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function incidentes(){
        return view('admin.incidentes');
    }

    public function usuarios(){
        return view('admin.usuarios');
    }

    public function estadisticas(){
        return view('admin.estadisticas');
    }

    public function reportes(){
        return view('admin.reportes');
    }
}