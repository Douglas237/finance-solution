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
        $compte_banks = Retrai::get();
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
                            // ->where('compte_banks.comptebankable_type', '=', 'App\Models\Client')
                            ->get('clients.nom');
                    }
                    elseif($proprietair[0]->comptebankable_type == 'App\Models\Entreprise'){
                        $proprietair = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', $compte_banks->num_compte)
                            // ->where('compte_banks.comptebankable_type', '=', 'App\Models\Entreprise')
                            ->get('entreprises.nom_respon as nom');
                    }
                    return $proprietair[0]->nom;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delet"><i class="fa-solid fa-trash"></i></a>'."  ";
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Detail" class="edit btn btn-warning btn_sm detailcompt" id="detail"><i class="fa-solid fa-circle-info"></i></a>'."  ";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        return view("transactions.retraits",compact('compte_banks'));
    }


    public function showtoredraw(Request $request)
    {

        $request->validate([
            'num_compte' => 'required|string',
            'montant_retrait' => 'required'
        ]);

        // $destinateur = CompteBank::find($request->num_compte);
        $compte = CompteBank::where('numero_compte',$request->num_compte)->get();
        // $destinatair = CompteBank::where('numero_compte',$request->compte_destinatair)->get();
        // $destinateur = CompteBank::where('numero_compte',request('num_compte'))->get();
        // dd($destinateur);
        if ($compte->isEmpty()) {
            # code...
            abort(405);
        }
        // if ($destinatair->isEmpty()) {
        //     # code...
        //     abort(406);
        // }

        if ($compte[0]->comptebankable_type == 'App\Models\Client') {
            # code...
            $infodestinateur = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
                ->where('compte_banks.comptebankable_type', '=', 'App\Models\Client')
                ->where('numero_compte',request('num_compte'))
                ->get();
        } elseif ($compte[0]->comptebankable_type =="App\\Models\\Entreprise") {
            $infodestinateur = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
                ->where('compte_banks.comptebankable_type', '=', 'App\Models\Entreprise')
                ->where('numero_compte',request('num_compte'))
                ->get();
        }
        // dd($infodestinateur);
        return $infodestinateur[0];
    }

    public function edit(Request $request)
    {
        
        # code...
        $request->validate([
            'num_compte' => 'required|string',
            'montant_retrait' => 'required|string',
        ]);

        
        $compte = CompteBank::where('numero_compte',$request->num_compte)->get();
        // $id = $idcompte[0];
        // $destinateur = CompteBank::find($request->num_compte);
            // dd($destinateur);
        if ($compte->isEmpty()) {
            # code...
            abort(405);
        }
        if ((float)$compte[0]->solde < 25000 ) {
            # code...
            abort(501);
        }
        // $compte = CompteBank::where('numero_compte', $request->num_compte)->get();
        DB::transaction(function () use ($request, $compte) {
            if ((float)$compte[0]->solde < (float)request('montant_retrait')) {
                # code...
                abort(404);
            }

            if (((float)$compte[0]->solde - (float)request('montant_retrait')) < 25000) {
                # code...
                abort(501);
            }
            Retrai::create([
                'num_compte' => $request->num_compte,
                'montant_retrait' =>(float) $request->montant_retrait,
                'comptebank_id' => $compte[0]->id,
            ]);
            $compte[0]->update([
                'solde' => $compte[0]->solde - (float)request('montant_retrait'),
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
