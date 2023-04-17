@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title">
            <p><strong>Nouveau Compte bancaire</strong></p>
        </div>
        <div class="note">
          <p><strong>Informations du client</strong></p>
        </div>
        <form action="{{ route('compte.client') }}" id="" class="form-control" method="POST">
            @csrf
            <div class="row tout">
                <div class="col right">
                  <input type="text" name="num" class="form-control first" placeholder="numero du compte" aria-label="numero du compte">
                  {{-- <select class="form-select first" name="comptebankable_type" aria-label="Default select example">
                    <option selected>Nature du compte</option>
                    <option value="App\Models\client">Client</option>
                    <option value="App\Models\entreprise">Entreprise</option>
                  </select> --}}
                  <div class="col-8 max">
                    <select class="form-select first" name="client_id" aria-label="Default select example" style="width: 90%;">
                        <option selected>select client</option>
                        @foreach ( $client as $item )
                        <option value="{{$item->id}}">{{$item->nom}}</option>
                        @endforeach
                      </select>
                      <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal" style="border-radius: 25%; background-color:#02501c">
                        <i class="fa fa-plus" style="background-color: #fff"></i>
                      </button>
                  </div>
                  <input type="text" name="solde" class="form-control first" placeholder="solde" aria-label="solde">
                  <input type='text' name="code" class="form-control first" placeholder="code" aria-label="code" />
                </div>
                <div class="col gauche">
                  <select class="form-select first" name="type" aria-label="Default select example">
                    <option selected>Type de compte</option>
                    <option value="Compte courant">Compte courant</option>
                    <option value="Compte epagne">Compte epagne</option>
                  </select>
                  {{-- <select class="form-select first" name="comptebankable_id" aria-label="Default select example">
                    <option selected>select entreprise</option>
                    @foreach ( $entreprise as $item )
                    <option value="{{$item->id}}">{{$item->nom_entreprise}}</option>
                    @endforeach
                  </select> --}}
                  <input type='date' name="date_ouverture" class="form-control first" placeholder="Select Date" />
                  <div>
                    <p style="padding: 0;margin: 0;">Status</p>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" name="statut" id="actif" value="1" checked>
                        <label class="form-check-label" for="actif">
                          Actif
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" name="statut" id="inactif" value="0" >
                        <label class="form-check-label" for="inactif">
                          Inactif
                        </label>
                      </div>
                  </div>

                  {{-- <div>
                    <p style="padding: 0;margin: 0;">Lier a une carte</p>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" name="lier" id="oui" value="oui" checked>
                        <label class="form-check-label" for="oui">
                          oui
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" name="lier" id="non" value="non" >
                        <label class="form-check-label" for="non">
                          non
                        </label>
                      </div>
                  </div> --}}
                  <div class="col-12 envoi">
                    <button class="btn btn-primary" value="submit" name="envoi" type="submit">Submit form</button>
                  </div>
                  {{-- <p>{{$id}}</p> --}}
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #02501c">
          <h5 class="modal-title" id="exampleModalLabel" style="color: #fff">Ajout Client</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button  class="btn btn-success" value="submit" name="envoi" type="submit">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>
@endsection


