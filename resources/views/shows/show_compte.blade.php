@extends('layouts.dashboard')

@section('content')
    <div class="infoclient">
        <div class="corpclient">
            <div class="infoleft">
                <p> {{ $shows->numero_compte }}</p>
                <p> {{ $shows->solde }}</p>
                <p> {{ $shows->date_ouverture }}</p>
                <p> {{ $shows->code }}</p>
                <p> {{ $shows->statut }}</p>
            </div>
            <div class="inforight">
                <p> {{ $shows->comptebankable_id  }} </p>
                <p> {{ $shows->comptebankable_type }}</p>
            </div>
        </div>
    </div>
@stop
