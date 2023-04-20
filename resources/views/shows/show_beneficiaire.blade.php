@extends('layouts.dashboard')

@section('content')
    <div class="infoclient">
        <h1>Detail</h1>
        <div class="corpclient">
            <div class="row">
                <div class="col-3">
                    <label for="">Nom :</label>
                    <p> {{ $shows->nom_beneficiaire }}</p>
                </div>
                <div class="col-3">
                    <label for="">Prenom :</label>
                    <p> {{ $shows->prenom }}</p>
                </div>
                <div class="col-3">
                    <label for="">Sexe :</label>
                    <p> {{ $shows->sexe }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="">N° CNI :</label>
                    <p> {{ $shows->cni }}</p>
                </div>
                <div class="col-3">
                    <label for="">Telephone :</label>
                    <p> {{ $shows->telephone }}</p>
                </div>
                <div class="col-3">
                    <label for="">Entreprise :</label>
                    <p> {{ $shows->entreprise }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
