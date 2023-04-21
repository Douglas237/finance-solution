<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Dotenv\Parser\Entry;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BeneficiaireController extends Controller
{
    public function index(Request $request)
    {

        $beneficiaires = Beneficiaire::join('entreprises', 'entreprises.id', '=', 'beneficiaires.beneficiaireable_id')
                                    ->where('beneficiaires.beneficiaireable_type', '=', 'App\Models\Entreprise')
                                    ->get('beneficiaires.*','entreprises.*');

        if($request->ajax()) {
            $allData = DataTables::of($beneficiaires)
            ->addIndexColumn()
            ->addColumn('entreprise', function($beneficiaires){
                $nam_entreprise = Entreprise::where('id', $beneficiaires->beneficiaireable_id)->get();
                return $nam_entreprise[0]->nom_entreprise;
            })
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
        return view('beneficiaire.list', compact('beneficiaires'));
    }

    public function list(Request $request)
    {

        $beneficiaires = Beneficiaire::join('clients', 'clients.id', '=', 'beneficiaires.beneficiaireable_id')
                                    ->where('beneficiaires.beneficiaireable_type', '=', 'App\Models\Client')
                                    ->get('beneficiaires.*','clients.*');
        if($request->ajax()) {
            $allData = DataTables::of($beneficiaires)
            ->addIndexColumn()
            ->addColumn('client', function($beneficiaires){
                $nam_client = Client::where('id', $beneficiaires->beneficiaireable_id)->get();
                return $nam_client[0]->nom;
            })
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
        return view('beneficiaire.beneficiaire_client', compact('beneficiaires'));
    }

    public function create()
    {
        $entreprise = Entreprise::all();
        return view('beneficiaire.create',compact('entreprise'));
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'nom_beneficiaire'=> 'required|string',
            'prenom'=> 'required|string',
            'cni'=>'required|string',
            'telephone'=>'required|string',
            'entreprise_id'=>'required',
            'sexe' => 'required|string',
        ]);

        if($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
            ->back()
            ->withErrors($validatedData)
            ->withInput();
        }
            # code...
            $entreprise = Entreprise::Find($request->entreprise_id);
            $entreprise->beneficiaire()->create(
                [
                    'nom_beneficiaire'=> request('nom_beneficiaire'),
                    'prenom'=> request('prenom'),
                    'cni'=>request('cni'),
                    'telephone'=> request('telephone'),
                    'beneficiaireable_id'=> (int)request('entreprise_id'),
                    'sexe' => request('sexe'),
                ]);
        return redirect()->route('beneficiaire.entreprise');

    }

    public function tocreate()
    {
        $client = Client::all();
        return view('beneficiaire.create_client', compact('client'));
    }

    public function storebeneclient(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'nom_beneficiaire'=> 'required|string',
            'prenom'=> 'required|string',
            'cni'=>'required|string',
            'telephone'=>'required|numeric',
            'client_id'=>'required',
            'sexe' => 'required|string',
        ]);

        if($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
            ->back()
            ->withErrors($validatedData)
            ->withInput();
        }
        $client = Client::Find($request->client_id);
            $client->beneficiaire()->create(
                [
                    'nom_beneficiaire'=> request('nom_beneficiaire'),
                    'prenom'=> request('prenom'),
                    'cni'=>request('cni'),
                    'telephone'=> request('telephone'),
                    'beneficiaireable_id'=> (int)request('client_id'),
                    'sexe' => request('sexe'),
                ]
            );
            return redirect()->route('beneficiaire.client');
    }
}
