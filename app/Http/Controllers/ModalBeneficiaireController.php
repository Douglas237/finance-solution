<?php

namespace App\Http\Controllers;

use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ModalBeneficiaireController extends Controller
{
    public function edit($id)
    {
        $beneficiaire = Beneficiaire::find($id);
        if(!$beneficiaire) {
            abort(404);
        }
        return $beneficiaire;
    } 
    public function editer(Request $request)
    {
        $beneficiaire = Beneficiaire::find($request->beneficiaire_id);
        if(!$beneficiaire){
            abort(404);
        }
        $this->validate($request,[
            'nom_beneficiaire'=> 'required|string',
            'prenom'=> 'required|string',
            'cni'=>'required|string',
            'telephone'=> array('required','regex:/(^6[25-9][0-9]([ ]([0-9]){3}){2}$)/u'),
            'sexe' => 'required|string',
        ]);
        // if($validatedData->fails()) {
        //     Toastr::error('The field not be empty.');
        //     return redirect()
        //     ->back()
        //     ->withErrors($validatedData)
        //     ->withInput();
        // }
        $beneficiaire->update([
            'nom_beneficiaire'=> request('nom_beneficiaire'),
            'prenom'=> request('prenom'),
            'cni'=>request('cni'),
            'telephone'=> request('telephone'),
            'sexe' => request('sexe'),
        ]);
        return $beneficiaire;
    }
    public function destroy($id) {
        $todelet = Beneficiaire::find($id);
        if(!$todelet) {
            abort(404);
        }
        $todelet->delete();
        return $todelet;
    }
    public function toshow($id) {
        $toshow = Beneficiaire::find($id);
        if(!$toshow) {
            abort(404);
        }
        return $toshow;
    }
    public function show($id) {
        $shows = Beneficiaire::find($id);
        if(!$shows) {
            abort(404);
        }
        return view('shows.show_beneficiaire', compact('shows'));
    }
}
