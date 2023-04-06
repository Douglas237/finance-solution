<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ModalEmployerController extends Controller
{
    //
    public function index(Request $request)
    {
        $employer =Employe::all();

        if($request->ajax()) {
            $allData = DataTables::of($employer)
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

        return view("employer.list_employer" ,compact('employer'));
    }

    public function toedite($id){
        $toedite = Employe::find($id);
        if (!$toedite) {
            # code...
            abort(404);
        }
        return $toedite;
    }

    public function edite(Request $request) {
        $new_employer = Employe::find($request->employer_id);
        if (! $new_employer) {
            # code...
            $validatedData = Validator::make($request->all(), [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'date_naissance' => 'required|date',
                'sexe' => 'required|string',
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

            $employer = Employe::create([
                'nom'=> $request->nom,
                'prenom'=> $request->prenom,
                'date_naissance'=>$request->date_naissance,
                'sexe'=> $request->sexe,
                'email'=>$request->email,
                'telephone'=>$request->telephone,
                'cni'=>$request->cni,
                'poste'=>$request->poste,
                'password'=>$request->password,
                'image'=>$image,
            ]);

            return $employer;
        }

        $validatedData = Validator::make($request->all(), [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'sexe' => 'required|string',
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

        $new_employer->update([
            'nom'=> $request->nom,
            'prenom'=> $request->prenom,
            'date_naissance'=>$request->date_naissance,
            'sexe'=> $request->sexe,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
            'cni'=>$request->cni,
            'poste'=>$request->poste,
            'password'=>$request->password,
            'image'=>$image,
        ]);

        return $new_employer;
    }
    public function destroy($id){
        $todelete = Employe::find($id);
        if (! $todelete) {
            # code...
            abort(404);
        }
        $todelete->delete();
        return $todelete;
    }

    public function toshow ($id){
        $toshow = Employe::find($id);
        if (!$toshow) {
            # code...
            abort(404);
        }

        return $toshow;
    }
    public function show ($id){
        $shows = Employe::find($id);
        if (!$shows) {
            # code...
            abort(404);
        }

        return view('shows.show_employer', compact('shows'));
    }
}
