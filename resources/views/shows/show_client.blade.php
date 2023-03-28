@extends('layouts.dashboard')

@section('content')
    <div class="infoclient">
        <div class="imgclient" id="imgclient">
            <div class="circle"> 
                <img src="{{ asset('uploads/images/client/'.$shows->image) }}" alt="" style="width: 8rem;height: 8rem; border-radius: 50%;float: right;">
            </div>
        </div>
        <div class="corpclient">
            <div class="infoleft">
                <p> {{ $shows->nom }}</p>
                <p> {{ $shows->email }}</p>
                <p> {{ $shows->ville }}</p>
                <p> {{ $shows->date_naissance }}</p>
                <p> {{ $shows->sexe }}</p>
            </div>
            <div class="inforight">
                <p> {{ $shows->prenom }}</p>
                <p> {{ $shows->telephone }}</p>
                <p> {{ $shows->cni }}</p>
                <p> {{ $shows->adress}}</p>
            </div>
        </div>
    </div>
@stop
