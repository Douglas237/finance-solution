<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardCcontroller extends Controller
{
    //
    public function index($id){
        return view('layout.Dashboard',compact("id"));
    }
}
