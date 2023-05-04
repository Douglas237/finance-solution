<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Client;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
 
class ModalClientController extends Controller
{
    //edit client
    public function edit($id){
        $result = Client::find($id);
        if (! $result) {
            # code...
            abort(404);
        }
        return $result;
    }
    // update client
    public function modif(Request $request){
        $new_client = Client::find($request->client_id);
        if (! $new_client) {
            # code...
            $this->validate($request,[
                'nom'=> 'required|string',
                'prenom'=> 'required|string',
                'date_naissance'=>'required|date',
                'sexe'=>'required',
                'email'=>'required|string',
                'telephone'=> array('required','regex:/(^6[25-9][0-9]([ ]([0-9]){3}){2}$)/u'),
                'cni'=>'required|string',
                'ville'=>'required|string',
                'adress'=>'required|string',
                'image'=>'required|image|mimes:jpeg,jpg,png,gif|max:10000',
            ]);

            try {

                $data = new Client();
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
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = date('YmdHi').ucfirst($request->nom).'.'.$extension;
                    $file->move('uploads/images/client', $filename);
                    $data->image = $filename;
                } else {
                    $data->image = 'default.png';
                }
                $data->save();
                Toastr::success('Enregistrement du client réussit : ' . $request->nom);
                return $data;
            } catch(Exception $e) {
    
                Toastr::error(
                    "Echec d'enregistrement du client : " . $request->nom
                );
                return redirect()->route('compte_client');
            }
        }

        $this->validate($request,[
            'nom'=> 'required|string',
            'prenom'=> 'required|string',
            'date_naissance'=>'required|date',
            'sexe'=>'required',
            'email'=>'required|string',
            'telephone'=> array('required','regex:/(^6[25-9][0-9]([ ]([0-9]){3}){2}$)/u'),
            'cni'=>'required|string',
            'ville'=>'required|string',
            'adress'=>'required|string',
            'image'=>'required|image|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        // if($validatedData->fails()) {
        //     Toastr::error('The field not be empty.');
        //     return redirect()
        //     ->back()
        //     ->withErrors($validatedData)
        //     ->withInput();
        // }

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHi') . ucfirst($request->nom) . '.' . $extension;
            $file->move('uploads/images/client', $filename);
            $image = $filename;
        }
        else
        {
            $image = 'default.png';
        }

        $new_client->update([
            'nom'=> $request->nom,
            'prenom'=> $request->prenom,
            'date_naissance'=>$request->date_naissance,
            'sexe'=> $request->sexe,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
            'cni'=>$request->cni,
            'ville'=>$request->ville,
            'adress'=>$request->adress,
            'image'=>$image,
        ]);

        return $new_client;
    }

    public function destroy($id){
        $todelete = Client::find($id);
        if (! $todelete) {
            # code...
            abort(404);
        }
        $todelete->delete();
        return $todelete;
    }

    public function toshow ($id){
        $toshow = Client::find($id);
        if (!$toshow) {
            # code...
            abort(404);
        }

        return $toshow;
    }
    public function show ($id){
        $shows = Client::find($id);
        if (!$shows) {
            # code...
            abort(404);
        }

        return view('shows.show_client', compact('shows', 'id'));
    }
}
