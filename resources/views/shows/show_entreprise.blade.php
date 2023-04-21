@extends('layouts.dashboard')

@section('content')
    <div class="infoclient">
        <div class="imgclient" id="imgclient">
            {{-- <div class="circle">
                <img src="{{ asset('uploads/images/client/'.$shows->image) }}" alt="" style="width: 8rem;height: 8rem; border-radius: 50%;float: right;">
            </div> --}}
        </div>
        <div class="corpclient">
            <div class="row">
                <div class="col-3">
                    <label for="">Nom Entreprise :</label>
                    <p> {{ $shows->nom_entreprise }}</p>
                </div>
                <div class="col-3">
                    <label for="">Nom du responsable :</label>
                    <p> {{ $shows->nom_respon }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="">Type entreprise :</label>
                    <p> {{ $shows->type_entreprise }}</p>
                </div>
                <div class="col-3">
                    <label for="">N° CNI :</label>
                    <p> {{ $shows->cni_respon }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
