<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BeneficiaireController extends Controller
{
    public function index(Request $request)
    {
        $beneficiaires = Beneficiaire::all();
        if($request->ajax()) {
            $allData = DataTables::of($beneficiaires)
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
        return view('beneficiaire.list', compact('beneficiaires'));
    }

    public function create($id)
    {
        return view('beneficiaire.create',compact('id'));
    }

    public function store(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(),[
            'nom'=> 'required|string',
            'prenom'=> 'required|string',
            'cni'=>'required|string',
            'telephone'=>'required|numeric',
            'sexe' => 'required|string',
            'type'=>'required|string',
        ]);

        if($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
            ->back()
            ->withErrors($validatedData)
            ->withInput();
        }
        if (request('type') == 'client') {
            # code...
            $client = Client::Find($id);
            $client->beneficiaire()->create(
                [
                    'nom'=> ucfirst($request->nom),
                    'prenom'=> $request->prenom,
                    'cni'=>$request->cni,
                    'telephone'=>$request->telephone,
                    'sexe' => $request->sexe,
                ]);
        }

        elseif(request('type') == 'entreprise')
        {
            $client = Entreprise::find($id);
            $client->beneficiaire()->create(
                [
                    'nom'=> ucfirst($request->nom),
                    'prenom'=> $request->prenom,
                    'cni'=>$request->cni,
                    'telephone'=>$request->telephone,
                    'sexe' => $request->sexe,
                ]
            );
        }
        return redirect()->route('Client.index');

    }
}
