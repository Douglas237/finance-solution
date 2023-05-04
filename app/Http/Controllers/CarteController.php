<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Carte;
use App\Models\CompteBank;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use App\Models\Carte_Comptebank;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class CarteController extends Controller
{
    public function create()
    {
        $count = CompteBank::all();
        return view('carte_compte.carte',compact('count'));
    }
    public function store(Request $request) {

        $this->validate($request,[
            'numero_carte'=> 'required|string',
            'codesecret'=>'required|string',
            'type'=>'required|string',
            'date_creation'=>'required|date',
            'date_expiration'=>'required|date',
            'statut'=>'required|boolean',
        ]);
        // if($validatedData->fails()) {
        //     Toastr::error('The field not be empty.');
        //     return redirect()
        //     ->back()
        //     ->withErrors($validatedData)
        //     ->withInput();
        // }
        $comptebank = CompteBank::Find($request->comptebank_id);
        try {
        DB::beginTransaction();
        $Cartes = Carte::create(
            [
                'numero_carte' => request('numero_carte'),
                'codesecret' => request('codesecret'),
                'type' => request('type'),
                'date_creation' => request('date_creation'),
                'date_expiration' => request('date_expiration'),
                'statut' => request('statut'),
            ]
        );

        $comptebank->cartes()->attach($Cartes->id);
        DB::Commit();
        Toastr::success('Enregistrement de la carte réussit');
        return redirect()->route('carte.list');

    } catch(Exception $e) {
        DB::Rollback();
        return redirect()->back();
    }
    }
}
