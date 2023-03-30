<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\CompteBank;
use App\Models\Entreprise;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ClientController;



class CompteBankController extends Controller
{
    public function index(Request $request)
    {
        $compte_banks = CompteBank::all();
        if($request->ajax()) {
            $allData = DataTables::of($compte_banks)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                '.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn_sm editCompte" id="edite">Edite</a>';
                $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                '.$row->id.'" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delete">Del</a>';
                $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                '.$row->id.'" data-original-title="Detail" class="edit btn btn-warning btn_sm detailcompt" id="detail">Detail</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
            return $allData;
        }
        return view("compte-bancaire.list-compt", compact('compte_banks'));
    }
    //
    public function create($id)
    {
        return view('compte-bancaire.infos-compt',compact('id'));
    }

    public function store(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(),[
            'num'=> 'required|string',
            'solde'=> 'required|string',
            'code'=>'required|string',
            'type'=>'required|string',
            'nature'=>'required|string',
            'date_ouverture'=>'required|date',
            'statut'=>'required|boolean',
            'lier'=>'required|string',
        ]);
        if($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
            ->back()
            ->withErrors($validatedData)
            ->withInput();
        }
        if (request('lier') == 'non') {
            # code...
            if (request('nature') == 'client') {
                # code...
                $client=Client::Find($id);
                $client->comptebanks()->create(
                    [
                        'numero_compte' => request('num'),
                        'solde' => (int) request('solde'),
                        'type_compte' => request('type'),
                        'date_ouverture' => request('date_ouverture'),
                        'code' => (int) request('code'),
                        'statut' => request('statut'),
                    ]
                );
            }
            elseif(request('nature') == 'entreprise')
            {
                $client = Entreprise::find($id);
                $client->comptebanks()->create(
                    [
                        'numero_compte' => request('num'),
                       'solde' => (int) request('solde'),
                        'type_compte' => request('type'),
                        'date_ouverture' => request('date_ouverture'),
                        'code' => (int) request('code'),
                       'statut' => request('statut'),
                    ]
                );
            }

            // dd($client->comptebanks);
            return redirect()->route('compte.list');
        }
        elseif(request('lier') == 'oui')
        {
            if (request('nature') == 'client') {
                # code...
                $client=Client::Find($id);
                $compte = $client->comptebanks()->create(
                    [
                        'numero_compte' => request('num'),
                        'solde' => (int) request('solde'),
                        'type_compte' => request('type'),
                        'date_ouverture' => request('date_ouverture'),
                        'code' => (int) request('code'),
                        'statut' => request('statut'),
                    ]
                );
            }
            elseif(request('nature') == 'entreprise')
            {
                $client = Entreprise::find($id);
                $compte = $client->comptebanks()->create(
                    [
                        'numero_compte' => request('num'),
                       'solde' => (int) request('solde'),
                        'type_compte' => request('type'),
                        'date_ouverture' => request('date_ouverture'),
                        'code' => (int) request('code'),
                       'statut' => request('statut'),
                    ]
                );

            }

            // dd($client->comptebanks);
            return redirect()->route('carte',[$compte]);
        }
    }
}
