<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::all();

        if ($request->ajax()) {
            $allData = DataTables::of($clients)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary  btn_sm editCompte" id="edite">Edite</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delet">Del</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Detail" class="edit btn btn-warning btn_sm deleteCompte" id="detail">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        // return view("compte-bancaire.list-compt", compact('compte_banks'));

        return view("compte-bancaire.list_clients");
    }

    public function create()
    {
        return view("compte-bancaire.infos-client");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'sexe' => 'required|string',
            'email' => 'required|string',
            'telephone' => array('required', 'regex:/(^6[25-9][0-9]([ ]([0-9]){3}){2}$)/u'),
            'cni' => 'required|string',
            'ville' => 'required|string',
            'adress' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        // if($validatedData->fails()) {
        //     Toastr::error('The field not be empty.');
        //     return redirect()
        //     ->back()
        //     ->withErrors($validatedData)
        //     ->withInput();
        // }

        try {

            $data = new Client();
            $data->nom = ucfirst($request->nom);
            $data->prenom = $request->prenom;
            $data->date_naissance = $request->date_naissance;
            $data->sexe = $request->sexe;
            $data->email = $request->email;
            $data->telephone = $request->telephone;
            $data->cni = $request->cni;
            $data->ville = $request->ville;
            $data->adress = $request->adress;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHi') . ucfirst($request->nom) . '.' . $extension;
                $file->move('uploads/images/client', $filename);
                $data->image = $filename;
            } else {
                $data->image = 'default.png';
            }
            $data->save();
            Toastr::success('Enregistrement du client réussit : ' . $request->nom);
            return redirect()->route('Client.index', [$data->id]);
        } catch (Exception $e) {
            dd($e);
            Toastr::error(
                "Echec d'enregistrement du client : " . $request->nom
            );
            return redirect()->back();
        }
    }

    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'sexe' => 'required',
            'email' => 'required|string',
            'telephone' => array('required', 'regex:/(^6[25-9][0-9]([ ]([0-9]){3}){2}$)/u'),
            'cni' => 'required|string',
            'ville' => 'required|string',
            'adress' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        // if($validatedData->fails()) {
        //     Toastr::error('The fiel not be empty.');
        //     return redirect()
        //     ->back()
        //     ->withErrors($validatedData)
        //     ->withInput();
        // }

        try {

            $data = Client::FindOrFail($id);
            $data->nom = $request->nom;
            $data->prenom = $request->prenom;
            $data->date_naissance = $request->date_naissance;
            $data->sexe = $request->sexe;
            $data->email = $request->email;
            $data->telephone = $request->telephone;
            $data->cni = $request->cni;
            $data->ville = $request->ville;
            $data->adress = $request->adress;

            if ($request->hasFile('image')) {
                $destination = 'uploads/images/client/' . $data->image;
                $destination_default = 'uploads/images/client/default.png';
                if ($destination_default != $destination && File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHi') . ucfirst($request->nom);
                $file->move('uploads/images/client/', $filename);
                $data->image = $filename;
            }

            $data->update();
            Toastr::success('Enregistrement du client réussit : ' . $request->nom);
            return redirect()->route('client.index');
        } catch (Exception $e) {

            Toastr::error(
                "Echec d'entregistrement du client : " . $request->nom
            );
            return redirect()->back();
        }
    }

    public function destroy($id)
    {

        try {
            $data = Client::findOrFail($id);
            $destination = 'uploads/images/client/' . $data->image;
            $destination_default = 'uploads/images/client/default.png';

            if ($destination_default != $destination && File::exists($destination)) {
                File::delete($destination);
            }
            $data->delete();
            Toastr::success('suppression du client effectuée avec succes');
        } catch (Exception $e) {
            Toastr::error('Echec de la suppression du client');
        }
        return redirect()->back();
    }
}
