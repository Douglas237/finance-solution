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

        if($request->ajax()) {
            $allData = DataTables::of($versement)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary  btn_sm editCompte" id="edite">Edite</a>';
                $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delet">Del</a>';
                $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Detail" class="edit btn btn-warning btn_sm deleteCompte" id="detail">Detail</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
            return $allData;
        }
        // return view("compte-bancaire.list-compt", compact('compte_banks'));

        return view("transactions.versement");
    }

    public function edit(Request $request) {
        $payment = Versement::find($request->payment_id);
        if (! $payment) {
            # code...
            $request->validate([
                'nom_versant' => 'required|string',
                'prenom_versant' => 'required|string',
                'num_cni' => 'required|string', 
                'montant' => 'required|string',
                'num_compte' => 'required|string',
            ]);
    
            
            // $idcompte = CompteBank::where('numero_compte',$request->num_compte)->get();
            // $id = $idcompte[0];
            $destinateur = CompteBank::find($request->num_compte);
            // dd($destinatair);
            if (!$destinateur) {
                # code...
                abort(405);
            }
            $idcompte = CompteBank::where('numero_compte',$request->num_compte)->get();
            DB::transaction(function () use ($request, $idcompte) {
               
                Versement::create([
                    'nom_versant'=> $request->nom_versant,
                    'prenom_versant'=> $request->prenom_versant,
                    'num_cni'=>$request->num_cni,
                    'montant'=> $request->montant,
                    'num_compte'=>$request->num_compte,
                    'comptebank_id'=>$idcompte[0]->id,
                ]);
                $idcompte[0]->update([
                    'solde' =>$idcompte[0]->solde+(int)request('montant'),
                ]);
                
            });
            return response()->json(['message' => 'mise a jour avec succes'], 200);
    
        }

        $request->validate([
            'nom_versant' => 'required|string',
            'prenom_versant' => 'required|string',
            'num_cni' => 'required|string',
            'montant' => 'required|string',
            'num_compte' => 'required|string',
        ]);

        $destinateur = CompteBank::find($request->num_compte);
            // dd($destinatair);
        if (!$destinateur) {
            # code...
            abort(405);
        }

        $initsolde = CompteBank::where('numero_compte',$payment->num_compte)->get();
        
        $newsolde = CompteBank::where('numero_compte',$request->num_compte)->get();
        DB::transaction(function () use ($payment, $request, $newsolde, $initsolde){
            $initsolde[0]-> update([
                'solde' => $initsolde[0]->solde - $payment->montant,
            ]);
            $payment->update([
                'nom_versant'=> $request->nom_versant,
                'prenom_versant'=> $request->prenom_versant,
                'num_cni'=>$request->num_cni,
                'montant'=> $request->montant,
                'num_compte'=>$request->num_compte,
            ]);
            $newsolde[0]->update([
                'solde' =>$newsolde[0]->solde+(int)request('montant'),
            ]);
        });
        return response()->json(['message' => 'mise a jour avec succes'], 200);
    }

    public function toedite($id){
        $toedite = Versement::find($id);
        if (!$toedite) {
            # code...
            abort(404);
        }
        return $toedite;
    }

    public function destroy($id){
        $todelete = Versement::find($id);
        if (! $todelete) {
            # code...
            abort(404);
        }
        $todelete->delete();
        return $todelete;
    }
}
