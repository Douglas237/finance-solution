<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employe;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EmployeController extends Controller
{
    public function index()
    {
        $employe = Employe::all();
        return view('employe.index', compact('employ'));
    }

    public function create()
    {
        return view('employe.create');
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nom' => 'required|string|unique:clients',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'sexe' => 'required|enum',
            'cni' => 'required|string',
            'email' => 'required|string',
            'telephone' => 'required|number',
            'poste' => 'required|string',
            'password' => 'required|string',
            'image' => 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:10000',
        ]);

        if ($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        try {

            $data = new Employe();
            $data->nom = ucfirst($request->nom);
            $data->prenom = $request->prenom;
            $data->date_naissance = $request->date_naissance;
            $data->sexe = $request->sexe;
            $data->cni = $request->cni;
            $data->email = $request->email;
            $data->telephone = $request->telephone;
            $data->poste = $request->poste;
            $data->password = $request->password;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHi') . ucfirst($request->nom) . '.' . $extension;
                $file->move('uploads/images/employe', $filename);
                $data->image = $filename;
            } else {
                $data->image = 'default.png';
            }
            $data->save();

            Toastr::success("Employé enregistré avec success : " . $request->nom);
            return redirect()->route('employe.index');
        } catch (Exception $e) {

            Toastr::error(
                "Echec d'enregistrement de l'employé : " . $request->nom
            );
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $employe = Employe::FindOrfail($id);
        return view('employe.create', compact('employes'));
    }

    public function update(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nom' => 'required|string|unique:clients',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'sexe' => 'required|enum',
            'cni' => 'required|string',
            'email' => 'required|string',
            'telephone' => 'required|numeric',
            'poste' => 'required|string',
            'password' => 'required|string',
            'image' => 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:10000',
        ]);

        if ($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        try {

            $data = new Employe();
            $data->nom = ucfirst($request->nom);
            $data->prenom = $request->prenom;
            $data->date_naissance = $request->date_naissance;
            $data->sexe = $request->sexe;
            $data->cni = $request->cni;
            $data->email = $request->email;
            $data->telephone = $request->telephone;
            $data->poste = $request->poste;
            $data->password = $request->password;

            if ($request->hasFile('image')) {
                $destination = 'uploads/images/employe/' . $data->image;
                $destination_default = 'uploads/images/employe/default.png';
                if ($destination_default != $destination && File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHi') . ucfirst($request->nom) . '.' . $extension;
                $file->move('uploads/images/employe/', $filename);
                $data->image = $filename;
            }

            $data->update();
            Toastr::success("Employé enregistré avec success : " . $request->nom);
            return redirect()->route('employe.index');
        } catch (Exception $e) {

            Toastr::error(
                "Echec d'enregistrement de l'employé : " . $request->nom
            );
            return redirect()->back();
        }
    }

    public function destroy($id)
    {

        try {

            $data = Employe::findOrFail($id);
            $destination = 'uploads/images/employe/' . $data->image;
            $destination_default = 'uploads/images/employe/default.png';

            if ($destination_default !=  $destination && File::exists($destination)) {
                File::delete($destination);
            }
            $data->delete();
            Toastr::success("suppression de l'employé reussit");
        } catch (Exception $e) {
            Toastr::error('Echec de la suppression');
        }
        return redirect()->back();
    }
}
