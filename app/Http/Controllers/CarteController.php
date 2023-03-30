<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Carte_Comptebank;
use App\Models\CompteBank;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class CarteController extends Controller
{
    public function create($id)
    {
        # code...
        // dd($id);
        return view('carte_compte.carte',compact('id'));
    }
    public function store(Request $request , $id) {

        $validatedData = Validator::make($request->all(),[
            'numero_carte'=> 'required|string',
            'codesecret'=>'required|string',
            'type'=>'required|string',
            'date_creation'=>'required|date',
            'date_expiration'=>'required|date',
            'statut'=>'required|boolean',
        ]);
        if($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
            ->back()
            ->withErrors($validatedData)
            ->withInput();
        }
        $compte = CompteBank::find($id);
        $new_carte = Carte::create(
            [
                'numero_carte' => request('numero_carte'),
                'codesecret' => request('codesecret'),
                'type' => request('type'),
                'date_creation' => request('date_creation'),
                'date_expiration' => request('date_expiration'),
                'statut' => request('statut'),
            ]
        );
        $compte->cartes()->attach($new_carte);
        return redirect()->route('beneficiaire.create', [$id]);
    }
}
