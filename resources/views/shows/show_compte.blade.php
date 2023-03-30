@extends('layouts.dashboard')

@section('content')
    <div class="infoclient">
        <h1>Detail</h1>
        <div class="corpclient">
            <div class="row">
                <div class="col-3">
                    <label for="">N° Compte :</label>
                    <p> {{ $shows->numero_compte }}</p>
                </div>
                <div class="col-3">
                    <label for="">Solde :</label>
                    <p> {{ $shows->solde }}</p>
                </div>
                <div class="col-3">
                    <label for="">Solde :</label>
                    <p> {{ $shows->date_ouverture }}</p>
                </div>
                <div class="col-3">
                    <label for="">Code :</label>
                    <p> {{ $shows->code }}</p>
                </div>
                <div class="col-3">
                    <label for="">Statu :</label>
                    <p> {{ $shows->statut }}</p>
                </div>
                {{-- <div class="col-3">
                    <label for="">compte-bank :</label>
                    <p> {{ $shows->comptebankable_id  }} </p>
                </div>
                <div class="col-3">
                    <label for="">compte-bank type :</label>
                    <p> {{ $shows->comptebankable_type }}</p>
                </div> --}}
            </div>

        </div>
    </div>
@stop
