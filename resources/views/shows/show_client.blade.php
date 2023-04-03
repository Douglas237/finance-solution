@extends('layouts.dashboard')

@section('content')
    <div class="infoclient">
        <h1>Detail</h1>
        <div class="imgclient" id="imgclient">
            <div class="circle">
                <img src="{{ asset('uploads/images/client/'.$shows->image) }}" alt="">
            </div>
        </div>
        <button style="margin-right: 7rem; height: 3.5rem ; float:right; " type="button" class="btn btn-outline-success"><a href="{{ route('beneficiaire.create',[$id]) }}">Beneficiaire</a></button>
        <div class="corpclient">
            <div class="row">
                <div class="col-3">
                    <label for="">Nom :</label>
                    <p> {{ $shows->nom }}</p>
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
                    <label for="">Adress-Mail :</label>
                    <p> {{ $shows->email }}</p>
                </div>
                <div class="col-3">
                    <label for="">Telephone :</label>
                    <p> {{ $shows->telephone }}</p>
                </div>
                <div class="col-3">
                    <label for="">Date Naissance :</label>
                    <p> {{ $shows->date_naissance }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="">N° CNI :</label>
                    <p> {{ $shows->cni }}</p>
                </div>
                <div class="col-3">
                    <label for="">Ville :</label>
                    <p> {{ $shows->ville }}</p>
                </div>
                <div class="col-3">
                    <label for="">Adress :</label>
                    <p> {{ $shows->adress}}</p>
                </div>
            </div>
        </div>
    </div>
@stop
