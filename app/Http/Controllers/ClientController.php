<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Client;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view("client.index", compact('clients'));
    }

    public function create()
    {
        return view("client.create");
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'nom'=> 'required|string|unique:clients',
            'prenom'=> 'required|string',
            'date_naissance'=>'required|date',
            'sexe'=>'required|enum',
            'email'=>'required|string',
            'telephone'=>'required|numeric',
            'cni'=>'required|string',
            'ville'=>'required|string',
            'adress'=>'required|string',
            'image'=>'nullable','image','mimes:jpeg,jpg,png,gif', 'max:10000',
        ]);

        if($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
            ->back()
            ->withErrors($validatedData)
            ->withInput();
        }

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

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHi') . ucfirst($request->nom) . '.' . $extension;
                $file->move('uploads/images/client', $filename);
                $data->image = $filename;
            } else {
                $data->image = 'default.png';
            }
            $data->save();

            Toastr::success('Enregistrement du client r??ussit : ' . $request->nom);
            return redirect()->route('client.index');
        } catch(Exception $e) {

            Toastr::error(
                "Echec d'enregistrement du client : " . $request->nom
            );
            return redirect()->back();
        }

    }

    public function edit($id) {
        $client = Client::FindOrFail($id);
        return view('client.create', compact('clients'));
    }
    public function update(Request $request, $id) {
        $validatedData = Validator::make($request->all(),[
            'nom'=> 'required|string|unique:clients',
            'prenom'=> 'required|string',
            'date_naissance'=>'required|date',
            'sexe'=>'required|enum',
            'email'=>'required|string',
            'telephone'=>'required|numeric',
            'cni'=>'required|string',
            'ville'=>'required|string',
            'adress'=>'required|string',
            'image'=>'nullable','image','mimes:jpeg,jpg,png,gif', 'max:10000',
        ]);

        if($validatedData->fails()) {
            Toastr::error('The fiel not be empty.');
            return redirect()
            ->back()
            ->withErrors($validatedData)
            ->withInput();
        }

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

            if($request->hasFile('image')) {
                $destination = 'uploads/images/client/' . $data->image;
                $destination_default = 'uploads/images/client/default.png';
               if($destination_default != $destination && File::exists($destination)) {
                    File::delete($destination);
               }
               $file = $request->file('image');
               $extension = $file->getClientOriginalExtension();
               $filename = date('YmdHi') . ucfirst($request->nom);
               $file->move('uploads/images/client/', $filename);
               $data->image = $filename;
            }

            $data->update();
            Toastr::success('Enregistrement du client r??ussit : ' . $request->nom);
            return redirect()->route('client.index');
        } catch (Exception $e) {

            Toastr::error(
                "Echec d'entregistrement du client : " . $request->nom
            );
            return redirect()->back();
        }
    }

    public function destroy($id){

        try {
            $data = Client::findOrFail($id);
            $destination = 'uploads/images/client/' . $data->image;
            $destination_default = 'uploads/images/client/default.png';

            if($destination_default != $destination && File::exists($destination)) {
              File::delete($destination);
            }
            $data->delete();
            Toastr::success('suppression du client effectu??e avec succes');
        } catch(Exception $e) {
            Toastr::error('Echec de la suppression du client');
        }
        return redirect()->back();
    }
}
