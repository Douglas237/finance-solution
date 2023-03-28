<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ModalEmployerController extends Controller
{
    //
    public function index(Request $request) 
    {
        $employer = Employe::all();

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

        return view("employer.list_employer",compact('employer'));
    }
    // public function toedit($id){
    //     $toedit = Employe::find($id);
    //     if (! $toedit) {
    //         # code...
    //         abort(404);
    //     }
    //     return $toedit;
    // }
}
