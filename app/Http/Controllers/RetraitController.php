<?php

namespace App\Http\Controllers;

use App\Models\Retrai;
use App\Models\CompteBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RetraitController extends Controller
{
    //
    public function index(Request $request)
    {
        $compte_banks = Retrai::join('compte_banks', 'compte_banks.id', '=', 'retrais.comptebank_id')
                                     ->get();
        // dd($compte_banks);
        if ($request->ajax()) {
            $allData = DataTables::of($compte_banks)
                ->addIndexColumn()
                ->addColumn('Proprietaire', function($compte_banks){
                    $proprietair = CompteBank::where('numero_compte', $compte_banks->num_compte)->get();

                    if ($proprietair[0]->comptebankable_type == 'App\Models\Client') {
                        # code...
                        $proprietair = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', $compte_banks->num_compte)
                            ->where('compte_banks.comptebankable_type', '=', 'App\Models\Client')
                            ->get();
                    }
                    elseif($proprietair[0]->comptebankable_type == 'App\Models\Entreprise'){
                        $proprietair = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', $compte_banks->num_compte)
                            ->where('compte_banks.comptebankable_type', '=', 'App\Models\Entreprise')
                            ->get(array('entreprises.nom_respon as nom'));
                    }
                    return $proprietair[0]->nom;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delet">Del</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Detail" class="edit btn btn-warning btn_sm detailcompt" id="detail">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        return view("transactions.retraits",compact('compte_banks'));
    }

    public function edit(Request $request)
    {
        
        # code...
        $validatedData = Validator::make($request->all(), [
            'num_compte' => 'required|string',
            'montant_retrait' => 'required|string',
        ]);

        if ($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        // $idcompte = CompteBank::where('numero_compte',$request->num_compte)->get();
        // $id = $idcompte[0];
        $compte = CompteBank::where('numero_compte', $request->num_compte)->get();
        DB::transaction(function () use ($request, $compte) {

            Retrai::create([
                'num_compte' => $request->num_compte,
                'montant_retrait' => $request->montant_retrait,
                'comptebank_id' => $compte[0]->id,
            ]);
            $compte[0]->update([
                'solde' => $compte[0]->solde - (int)request('montant_retrait'),
            ]);
        });

        return response()->json(['message' => 'mise a jour avec succes'], 200);
        
    }

    public function destroy($id)
    {
        $todelete = Retrai::find($id);
        if (!$todelete) {
            # code...
            abort(404);
        }
        $todelete->delete();

        return $todelete;
    }
}
