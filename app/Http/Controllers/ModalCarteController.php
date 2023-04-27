<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Carte_Comptebank;
use App\Models\CompteBank;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ModalCarteController extends Controller
{
    public function index(Request $request)
    {
        $cartes = Carte::with('comptebanks')->get();
        // foreach ($cartes as $item) {
        //     dd($item['comptebanks']);
        // }


        if ($request->ajax()) {
            $allData = DataTables::of($cartes)
                ->addIndexColumn()
                ->addColumn('compte', function ($item) {
                    $compte = $item['comptebanks'];

                    // dd($compte);
                    return $compte[0]->numero_compte;
                })
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

        return view('carte_compte.list', compact('cartes'));
    }

    public function toedit($id)
    {
        $carte = Carte::find($id);
        if (!$carte) {
            # code...
            abort(404);
        }
        return  $carte;
    }

    public function edit(Request $request)
    {
        $carte = Carte::find($request->carte_id);
        if (!$carte) {
            # code...
            abort(404);
        }
        $validatedData = Validator::make(
            $request->all(),
            [
                'numero_carte' => 'required|string',
                'codesecret' => 'required|string',
                'type' => 'required|string',
                'date_creation' => 'required|date',
                'date_expiration' => 'required|date',
                'statut' => 'required|boolean',
            ]
        );
        if ($validatedData->fails()) {
            Toastr::error('The field not be empty.');
            return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        $carte->update([
            'numero_carte' => request('numero_carte'),
            'codesecret' => request('codesecret'),
            'type' => request('type'),
            'date_creation' => request('date_creation'),
            'date_expiration' => request('date_expiration'),
            // 'comptebankable_id' => request('comptebank_id'),
            'statut' => request('statut'),
        ]);

        return $carte;
    }

    public function destroy($id)
    {
        $todelet = Carte::find($id);
        if (!$todelet) {
            # code...
            abort(404);
        }
        $todelet->delete();
        return $todelet;
    }

    public function toshow($id)
    {
        $toshow = Carte::find($id);
        if (!$toshow) {
            # code...
            abort(404);
        }

        return $toshow;
    }
    public function show($id)
    {
        $shows = Carte::find($id);
        if (!$shows) {
            # code...
            abort(404);
        }
        return view('shows.show_carte', compact('shows'));
    }
}
