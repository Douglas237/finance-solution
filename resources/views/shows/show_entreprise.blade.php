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
                <p> {{ $shows->nom_entreprise }}</p>
                <p> {{ $shows->nom_respon }}</p>
                <p> {{ $shows->type_entreprise }}</p>
                <p> {{ $shows->cni_respon }}</p>
            </div>
            <div class="inforight">
            </div>
        </div>
    </div>
@stop
