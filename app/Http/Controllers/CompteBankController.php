<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CompteBank;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ClientController;



class CompteBankController extends Controller
{
    public function index(Request $request)
    {
        $compte_banks = CompteBank::join('clients', 'clients.id', '=', 'compte_banks.comptebankable_id')
                                    ->where('compte_banks.comptebankable_type', '=', 'App\Models\Client')
                                    ->get();
        // dd($compte_banks);
        if ($request->ajax()) {
            $allData = DataTables::of($compte_banks)
                ->addIndexColumn()
                ->addColumn('proprietaire', function($compte_banks){
                    return $compte_banks->nom;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn_sm editCompte" id="edite">Edite</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delete">Del</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Detail" class="edit btn btn-warning btn_sm detailcompt" id="detail">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        } 
        return view("compte-bancaire.list-compt", compact('compte_banks'));
    }

    // nouveau : pour lister les comptes des entreprises

    public function entreprise(Request $request)
    {
        $compte_banks = CompteBank::join('entreprises', 'entreprises.id', '=', 'compte_banks.comptebankable_id')
                                    ->where('compte_banks.comptebankable_type', '=', 'App\Models\Entreprise')
                                    ->get();
        // dd($compte_banks);
        if ($request->ajax()) {
            $allData = DataTables::of($compte_banks) 
                ->addIndexColumn()
                ->addColumn('proprietaire', function($compte_banks){
                    return $compte_banks->nom_respon;
                })
                ->addColumn('non_entreprise', function($compte_banks){
                    return $compte_banks->nom_entreprise;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn_sm editCompte" id="edite">Edite</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delete">Del</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                ' . $row->id . '" data-original-title="Detail" class="edit btn btn-warning btn_sm detailcompt" id="detail">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        return view("entreprises.compte_entreprise", compact('compte_banks'));
    }
    //

        public function createclient()
        {
            $client = Client::all();
            return view('compte-bancaire.infos-compt', compact('client'));
        }

    public function storeclient(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'num' => 'required|string',
            'solde' => 'required|string',
            'code' => 'required|string',
            'type' => 'required|string',
            'date_ouverture' => 'required|date',
            'client_id' => 'required|integer',
            'statut' => 'required|boolean',
        ]);
        if ($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }
                # code...
                $client = Client::Find($request->client_id);
                $client->comptebanks()->create(
                    [
                        'numero_compte' => request('num'),
                        'solde' => (int) request('solde'),
                        'type_compte' => request('type'),
                        'date_ouverture' => request('date_ouverture'),
                        'code' => (int) request('code'),
                        'comptebankable_id' => (int)request('client_id'),
                        'statut' => request('statut'),
                    ]
                );
            // dd($client->comptebanks);
            return redirect()->route('compte.list');

    }

    public function createentreprise()
    {
        $entreprise = Entreprise::all();
        return view('entreprises.create', compact('entreprise'));
    }
    public function storeentreprise(Request $request){

        $validatedData = Validator::make($request->all(), [
            'num' => 'required|string',
            'solde' => 'required|string',
            'code' => 'required|string',
            'type' => 'required|string',
            'date_ouverture' => 'required|date',
            'entreprise_id' => 'required|integer',
            'statut' => 'required|boolean',
        ]);
        if ($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $entreprise = Entreprise::Find($request->entreprise_id);
                $entreprise->comptebanks()->create(
                    [
                        'numero_compte' => request('num'),
                        'solde' => (int) request('solde'),
                        'type_compte' => request('type'),
                        'date_ouverture' => request('date_ouverture'),
                        'code' => (int) request('code'),
                        'comptebankable_id' => (int)request('entreprise_id'),
                        'statut' => request('statut'),
                    ]
                );
                return redirect()->route('compte.entreprise');
    }
}
