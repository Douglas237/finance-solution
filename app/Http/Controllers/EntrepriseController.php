<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EntrepriseController extends Controller
{
    public function create()
    {
        return view('compte-bancaire.info-entrprise');
    }


    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nom_entreprise' => 'required|string',
            'nom_respon' => 'required|string',
            'type_entreprise' => 'required|string',
            'cni_respon' => 'required|string',
            'image' => 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:10000',
        ]);
        
        if ($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        
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
        $entreprise = Entreprise::create(
            [
                'nom_entreprise' => request('nom_entreprise'),
                'nom_respon' => request('nom_respon'),
                'type_entreprise' => request('type_entreprise'),
                'cni_respon' => request('cni_respon'),
                'image' => $image,
            ]
        );
        return redirect()->route('compte', ['id' => $entreprise->id]);
    }
}
