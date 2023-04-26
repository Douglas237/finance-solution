<?php

namespace App\Http\Controllers;

use App\Models\Versement;
use App\Models\CompteBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class VersementController extends Controller
{
    //
    public function index(Request $request)
    {
        $versement = Versement::all();

        if ($request->ajax()) {
            $allData = DataTables::of($versement)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary  btn_sm editCompte" id="edite">Edite</a>';
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delet">Del</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Detail" class="edit btn btn-warning btn_sm deleteCompte" id="detail">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        // return view("compte-bancaire.list-compt", compact('compte_banks'));

        return view("transactions.versement");
    }

    public function showclient(Request $request)
    {

        $request->validate([
            'nom_versant' => 'required|string',
            'prenom_versant' => 'required|string',
            'num_cni' => 'required|string',
            'montant' => 'required',
            'num_compte' => 'required|string',
        ]);

        // $destinateur = CompteBank::find($request->num_compte);
        $destinateur = CompteBank::where('numero_compte', $request->num_compte)->get();
        // dd($destinatair);
        if ($destinateur->isEmpty()) {
            # code...
            abort(405); 
        }

        // if ($destinateur[0]->comptebankable_type == 'App\Models\Client') {
        //     # code...
        //     $infodestinateur = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
        //         ->where('compte_banks.comptebankable_type', '=', 'App\Models\Client')
        //         ->get();
        // } elseif ($destinateur[0]->comptebankable_type == 'App\Models\Entreprise') {
        //     $infodestinateur = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
        //         ->where('compte_banks.comptebankable_type', '=', 'App\Models\Entreprise')
        //         ->get();
        // }

        if ($destinateur[0]->comptebankable_type == 'App\Models\Client') { 
            # code...
            $infodestinateur = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
                ->where('compte_banks.comptebankable_type', '=', 'App\Models\Client')
                ->where('numero_compte',request('num_compte'))
                ->get();
        } elseif ($destinateur[0]->comptebankable_type =="App\\Models\\Entreprise") {
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
        // $request->validate([
        //     'nom_versant' => 'required|string',
        //     'prenom_versant' => 'required|string',
        //     'num_cni' => 'required|string',
        //     'montant' => 'required',
        //     'num_compte' => 'required|string', 
        // ]);


        // $idcompte = CompteBank::where('numero_compte',$request->num_compte)->get();
        // $id = $idcompte[0];
        // $destinateur = CompteBank::find($request->num_compte);
        $destinateur = CompteBank::where('numero_compte',$request->num_compte)->get();
        // dd($destinatair);
        if ($destinateur->isEmpty()) {
            # code...
            abort(405);
        }
        // $idcompte = CompteBank::find($request->num_compte);
        DB::transaction(function () use ($request, $destinateur) {

            Versement::create([
                'nom_versant' => $request->nom_versant,
                'prenom_versant' => $request->prenom_versant,
                'num_cni' => $request->num_cni,
                'montant' =>(float) $request->montant,
                'num_compte' => $request->num_compte,
                'comptebank_id' => $destinateur[0]->id,
            ]);
            $destinateur[0]->update([
                'solde' => $destinateur[0]->solde + (float)request('montant'),
            ]);
        });
        return response()->json(['message' => 'mise a jour avec succes'], 200);
    }

    public function toedite($id)
    {
        $toedite = Versement::find($id);
        if (!$toedite) {
            # code...
            abort(404);
        }
        return $toedite;
    }

    public function destroy($id)
    {
        $todelete = Versement::find($id);
        if (!$todelete) {
            # code...
            abort(404);
        }
        $todelete->delete();
        return $todelete;
    }
}
