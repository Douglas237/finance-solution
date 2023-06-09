<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Client::select('id','created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });

        $months=[];
        $monthCount=[];

        foreach($data as $month => $values){
            $months[]=$month;
            $monthCount[]=count($values);
        }
        // $table = ;
        // dd($table);
        $clients = DB::table('clients')->count();
        $employes = DB::table('employes')->count();
        $entreprises = DB::table('entreprises')->count();
        $compte = DB::table('compte_banks')->count();
        return view('layouts.Accueil', compact('clients', 'employes', 'entreprises', 'compte' ),['data'=>$data,'months'=>$months,'monthCount'=>$monthCount]);
        // return view('layouts.Accueil',compact('table'));
    }

    // public function cal()
    // {
        
        
    // }
}
