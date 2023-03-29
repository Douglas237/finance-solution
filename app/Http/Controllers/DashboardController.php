<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('layouts.Accueil');
    }

    public function cal()
    {
        $clients = DB::table('clients')->count();
        $employes = DB::table('employes')->count();
        $entreprises = DB::table('entreprises')->count();
        return view ('layouts.Accueil',compact('clients','employes','entreprises'));

    }
}
