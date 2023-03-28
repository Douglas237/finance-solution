<?php

namespace App\Http\Controllers;

use App\Models\CompteBank;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class ModalCompteController extends Controller
{
    //
    public function editer($id){
        $compte = CompteBank::find($id);
        if (!$compte) {
            # code...
            abort(404);
        }
        return $compte;
    }

    public function edition(Request $request){
        $compte = CompteBank::find($request->compte_id);
        if (! $compte) {
            # code...
            abort(404);
        }      
        $validatedData = Validator::make($request->all(),[
            'num'=> 'required|string',
            'solde'=> 'required|string',
            'code'=>'required|string',
            'type'=>'required|string',
            'nature'=>'required|string',
            'date_ouverture'=>'required|date',
            'statut'=>'required|boolean',
        ]);
        if($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
            ->back()
            ->withErrors($validatedData)
            ->withInput();
        }

        $compte->update([
            'solde' => (int) request('solde'),
            'type_compte' => request('type'),
            'date_ouverture' => request('date_ouverture'),
            'code' => (int) request('code'),
            'statut' => request('statut'),
        ]);

        return $compte;
    }
    public function destroy($id){
        $todelet = CompteBank::find($id);
        if (! $todelet) {
            # code...
            abort(404);
        }
        $todelet->delete();

        return $todelet;
    }
    public function toshow($id){
        $toshow = CompteBank::find($id);
        if (! $toshow) {
            # code...
            abort(404);
        }

        return $toshow;
    }
    public function show($id){
        $shows = CompteBank::find($id);
        if (!$shows) {
            # code...
            abort(404);
        }
        return view('shows.show_compte', compact('shows'));
    }
}
