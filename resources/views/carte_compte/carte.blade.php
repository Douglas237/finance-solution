@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title">
            <p><strong>Nouvelle carte</strong></p>
        </div>
        <div class="note">
          <p><strong>Informations de la carte</strong></p>
        </div>
        <form action="{{ route('carte') }}"  class="form-control" method="POST">
            @csrf
            <div class="row tout">
                <div class="col right">
                  <input type="text" name="numero_carte" class="form-control first" placeholder="numero de la carte" aria-label="numero de la carte">
                  <input type='date' name="date_creation" class="form-control first" placeholder="Select Date" />
                  <select class="form-select first" name="type" aria-label="Default select example">
                    <option selected>type de carte</option>
                    <option value="carte electron">Carte electron</option>
                    <option value="carte visa">Carte visa</option>
                    <option value="master carte">Master carte</option>
                  </select>
                  {{-- <p>{{$count}}</p> --}}
                  <select class="select 2" name="comptebank_id" aria-label="Default select example">
                    <option selected>Select Numero compte</option>
                    @foreach ( $count as $rest )
                    <option value="{{$rest->id}}">{{$rest->numero_compte}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col gauche">
                  <input type="text" name="codesecret" class="form-control first" placeholder="code secret" aria-label="code secret">
                  <input type='date' name="date_expiration" class="form-control first" placeholder="Select Date" />
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
                  <div class="col-12 envoi">
                    <button class="btn btn-primary" value="submit" name="envoi" type="submit">Submit form</button>
                  </div>
                  {{-- <p>{{$id}}</p> --}}
                </div>
            </div>
        </form>
    </div>
@endsection
