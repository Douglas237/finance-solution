<?php

namespace App\Http\Controllers;


use App\Models\Transfert;
use App\Models\CompteBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TransfertController extends Controller
{
    //
    public function index(Request $request)
    {
        $compte_banks = Transfert::get();
        // dd($compte_banks);
        if ($request->ajax()) {
            $allData = DataTables::of($compte_banks)
                ->addIndexColumn()
                ->addColumn('nom_destinatair', function($compte_banks){
                    $destinatair = CompteBank::where('numero_compte', $compte_banks->compte_destinatair)->get();

                    if ($destinatair[0]->comptebankable_type == 'App\Models\Client') {
                        # code...
                        $destinatair = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', $compte_banks->compte_destinatair)
                            ->where('compte_banks.comptebankable_type', '=', 'App\Models\Client')
                            ->get();
                    }
                    elseif($destinatair[0]->comptebankable_type == 'App\Models\Entreprise'){
                        $destinatair = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', $compte_banks->compte_destinatair)
                            ->where('compte_banks.comptebankable_type', '=', 'App\Models\Entreprise')
                            ->get(array('entreprises.nom_respon as nom'));
                    }
                    return $destinatair[0]->nom;
                })
                ->addColumn('nom_destinateur', function($compte_banks){
                    $destinateur = CompteBank::where('numero_compte', $compte_banks->compte_destinateur)->get();
        
                    if ($destinateur[0]->comptebankable_type == 'App\Models\Client') {
                        # code...
                        $destinateur = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', $compte_banks->compte_destinateur)
                            ->where('compte_banks.comptebankable_type', '=', 'App\Models\Client')
                            ->get(array('clients.nom as nom'));
                    }
                    elseif($destinateur[0]->comptebankable_type == 'App\Models\Entreprise'){
                        $destinateur = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', $compte_banks->compte_destinateur)
                            ->where('compte_banks.comptebankable_type', '=', 'App\Models\Entreprise')
                            ->get(array('entreprises.nom_respon as nom'));
                    }
                    return $destinateur[0]->nom;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn_sm editCompte" id="edite">Edite</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delet">Del</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Detail" class="edit btn btn-warning btn_sm detailcompt" id="detail">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        return view("transactions.transferts",compact('compte_banks'));
    }

    public function edit(Request $request)
    {
        $transfert = Transfert::find($request->transfert_id);
        if (!$transfert) {
            # code...
            $request->validate([
                'compte_destinatair' => 'required|string',
                'montant_transfert' => 'required|string',
                'compte_destinateur' => 'required|string',
            ]);
            // $idcompte = CompteBank::where('numero_compte',$request->num_compte)->get();
            // $id = $idcompte[0];
            $destinatair = CompteBank::find($request->compte_destinatair);
            $destinateur = CompteBank::find($request->compte_destinateur);
            // dd($destinatair);
            if (!$destinatair) {
                # code...
                abort(405);
            }
            elseif(!$destinateur){
                abort(406);
            }
            DB::transaction(function () use ($request, $destinatair, $destinateur) {
                Transfert::create([
                    'compte_destinatair' => $request->compte_destinatair,
                    'montant_transfert' => $request->montant_transfert,
                    'compte_destinateur' => $request->compte_destinateur,
                    'comptebank_id' => $destinateur->id,
                ]);
                if ((int)$destinatair->solde < (int)request('montant_transfert')) {
                    # code...
                    abort(404);
                }
                $destinatair->update([
                    'solde' => $destinatair->solde - (int)request('montant_transfert'),
                ]);
                $destinateur->update([
                    'solde' => $destinateur->solde + (int)request('montant_transfert'),
                ]);
            });
            return response()->json(['message' => 'mise a jour avec succes'], 200);
        }

        $request->validate([
            'compte_destinatair' => 'required|string',
            'montant_transfert' => 'required|string',
            'compte_destinateur' => 'required|string',
        ]);

        $destinatair = CompteBank::find($request->compte_destinatair);
        $destinateur = CompteBank::find($request->compte_destinateur);
        // dd($destinatair);
        if (!$destinatair) {
            # code...
            abort(405);
        }
        elseif(!$destinateur){
            abort(406);
        }

        $initdestinatair = CompteBank::where('numero_compte', $request->compte_destinatair)->get();
        $initdestinateur = CompteBank::where('numero_compte', $request->compte_destinateur)->get();
        DB::transaction(function () use ($transfert, $request, $initdestinatair, $initdestinateur) {

            $initdestinatair[0]->update([
                'solde' => $initdestinatair[0]->solde + $transfert->montant_transfert,
            ]);
            
            $initdestinateur[0]->update([
                'solde' => $initdestinateur[0]->solde - $transfert->montant_transfert,
            ]);
            $newdestinatair = CompteBank::where('numero_compte', $request->compte_destinatair)->get();
            if ((int)$newdestinatair[0]->solde < (int)request('montant_transfert')) {
                # code...
                abort(404);
            }
            $newdestinateur = CompteBank::where('numero_compte', $request->compte_destinateur)->get();
            $transfert->update([
                'compte_destinatair' => $request->compte_destinatair,
                'montant_transfert' => $request->montant_transfert,
                'compte_destinateur' => $request->compte_destinateur,
                'comptebank_id' => $newdestinateur[0]->id,
            ]);

            $newdestinatair[0]->update([
                'solde' => $newdestinatair[0]->solde - (int)request('montant_transfert'),
            ]);
            $newdestinateur[0]->update([
                'solde' => $newdestinateur[0]->solde + (int)request('montant_transfert'),
            ]);
        });
        return response()->json(['message' => 'mise a jour avec succes'], 200);
    }

    public function toedite($id)
    {
        $toedite = Transfert::find($id);
        if (!$toedite) {
            # code...
            abort(404);
        }
        return $toedite;
    }

    public function destroy($id)
    {
        $todelete = Transfert::find($id);
        if (!$todelete) {
            # code...
            abort(404);
        }
        $todelete->delete();
        return $todelete;
    }
}
