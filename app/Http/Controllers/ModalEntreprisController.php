<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ModalEntreprisController extends Controller
{
    //
    public function index(Request $request)
    {
        $entreprise = Entreprise::all();
        if($request->ajax()) {
            $allData = DataTables::of($entreprise)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                '.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn_sm editCompte" id="edite">Edite</a>';
                $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                '.$row->id.'" data-original-title="Delete" class="edit btn btn-danger btn_sm deleteCompte" id="delet">Del</a>';
                $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="
                '.$row->id.'" data-original-title="Detail" class="edit btn btn-warning btn_sm detailcompt" id="detail">Detail</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
            return $allData;
        }
        return view("entreprises.list_entreprise",compact('entreprise'));
    }
    public function toedit($id){
        $toedit = Entreprise::find($id);
        if (! $toedit) {
            # code...
            abort(404);
        }
        return $toedit;
    }
    public function edit(Request $request) {
        $edit = Entreprise::find($request->entreprise_id);
        if (!$edit) {
            # code...
            abort(404);
        }
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
        $edit->update([
            'nom_entreprise' => request('nom_entreprise'),
            'nom_respon' => request('nom_respon'),
            'type_entreprise' => request('type_entreprise'),
            'cni_respon' => request('cni_respon'),
            'image' => $image,
        ]);
        return $edit;
    }
    public function destroy($id) {
        $destroy = Entreprise::find($id);
        if (! $destroy) {
            # code...
            abort(404);
        }
        $destroy->delete();
        return $destroy;
    }

    public function toshow($id){
        $toshow = Entreprise::find($id);
        if (! $toshow) {
            # code...
            abort(404);
        }

        return $toshow;
    }
    public function show($id){
        $shows = Entreprise::find($id);
        if (!$shows) {
            # code...
            abort(404);
        }
        return view('shows.show_entreprise', compact('shows'));
    }
}
