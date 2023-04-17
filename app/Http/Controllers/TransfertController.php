<?php

namespace App\Http\Controllers;


use App\Models\Transfert;
use App\Models\CompteBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;

class TransfertController extends Controller
{
    //
    public function index(Request $request)
    {
        $transfert = Transfert::all();
        // $destinatair = CompteBank::where('numero_compte', $transfert[0]->compte_destinatair)->get();
        // dd($transfert);
        if ($request->ajax()) {
            $allData = DataTables::of($transfert)
                ->addIndexColumn()
                ->addColumn('nom_destinatair', function($transfert){
                    $destinatair = CompteBank::where('numero_compte', $transfert->compte_destinatair)->get();

                    if ($destinatair[0]->comptebankable_type =='App\Models\Client') {
                        # code...
                        $ndestinatair = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', $transfert->compte_destinatair)
                            ->get('clients.nom');
                    }
                    elseif($destinatair[0]->comptebankable_type =='App\Models\Entreprise'){

                        $ndestinatair = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', '=',$transfert->compte_destinatair)
                            ->get('entreprises.nom_respon as nom');
                    }
                    return $ndestinatair[0]->nom;
                })
                ->addColumn('nom_destinateur', function($transfert){
                    $destinateur = CompteBank::where('numero_compte', $transfert->compte_destinateur)->get();
        
                    if ($destinateur[0]->comptebankable_type =='App\Models\Client') {
                        # code...
                        $ndestinateur = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte','=', $transfert->compte_destinateur)
                            ->get(array('clients.nom'));
                    }
                    elseif($destinateur[0]->comptebankable_type =='App\Models\Entreprise'){
                        $ndestinateur = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
                            ->where('numero_compte', '=',$transfert->compte_destinateur)
                            ->get('entreprises.nom_respon as nom');
                    }
                    return $ndestinateur[0]->nom;
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
                ->rawColumns(['action','nom_destinatair','nom_destinateur'])
                ->make(true);
            return $allData;
        }
        return view("transactions.transferts",compact('transfert'));
    }


    public function showtotransfert(Request $request)
    {

        $request->validate([
            'compte_destinatair' => 'required|string',
            'montant_transfert' => 'required|string',
            'compte_destinateur' => 'required|string',
        ]);

        // $destinateur = CompteBank::find($request->num_compte);
        $destinatair = CompteBank::where('numero_compte',$request->compte_destinatair)->get();
        $destinateur = CompteBank::where('numero_compte',request('compte_destinateur'))->get();
        // dd($destinateur);
        if ($destinateur->isEmpty()) {
            # code...
            abort(405);
        }
        if ($destinatair->isEmpty()) {
            # code...
            abort(406);
        }

        if ($destinateur[0]->comptebankable_type == 'App\Models\Client') {
            # code...
            $infodestinateur = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
                ->where('compte_banks.comptebankable_type', '=', 'App\Models\Client')
                ->where('numero_compte',request('compte_destinateur'))
                ->get();
        } elseif ($destinateur[0]->comptebankable_type =="App\\Models\\Entreprise") {
            $infodestinateur = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
                ->where('compte_banks.comptebankable_type', '=', 'App\Models\Entreprise')
                ->where('numero_compte',request('compte_destinateur'))
                ->get();
        }
        // dd($infodestinateur);
        return $infodestinateur[0];
    }





    public function edit(Request $request)
    {
        $transfert = Transfert::find($request->transfert_id);
        if (!$transfert) {
            # code...
            // $request->validate([
            //     'compte_destinatair' => 'required|string',
            //     'montant_transfert' => 'required|string',
            //     'compte_destinateur' => 'required|string',
            // ]);
            // $idcompte = CompteBank::where('numero_compte',$request->num_compte)->get();
            // $id = $idcompte[0];
            $destinatair = CompteBank::where('numero_compte',$request->compte_destinatair)->get();
            $destinateur = CompteBank::where('numero_compte',$request->compte_destinateur)->get();
            // dd($destinatair);
            if ($destinatair->isEmpty()) {
                # code...
                abort(406);
            }
            elseif($destinateur->isEmpty()) {
                abort(405);
            }
            DB::transaction(function () use ($request, $destinatair, $destinateur) {
                Transfert::create([
                    'compte_destinatair' => $request->compte_destinatair,
                    'montant_transfert' => $request->montant_transfert,
                    'compte_destinateur' => $request->compte_destinateur,
                    'comptebank_id' => $destinateur[0]->id,
                ]);
                if ((int)$destinatair[0]->solde < (int)request('montant_transfert')) {
                    # code...
                    abort(404);
                }
                $destinatair[0]->update([
                    'solde' => $destinatair[0]->solde - (int)request('montant_transfert'),
                ]);
                $destinateur[0]->update([
                    'solde' => $destinateur[0]->solde + (int)request('montant_transfert'),
                ]);
            });
            return response()->json(['message' => 'mise a jour avec succes'], 200);
        }

        // $request->validate([
        //     'compte_destinatair' => 'required|string',
        //     'montant_transfert' => 'required|string',
        //     'compte_destinateur' => 'required|string',
        // ]);

        $destinatair = CompteBank::where('numero_compte',$request->compte_destinatair)->get();
        $destinateur = CompteBank::where('numero_compte',$request->compte_destinateur)->get();
        // dd($destinatair);
        if ($destinatair->isEmpty()) {
            # code...
            abort(408);
        }
        elseif($destinateur->isEmpty()){
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
