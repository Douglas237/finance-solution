@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title">
            <p><strong>Nouvelle carte</strong></p>
        </div>
        <div class="note">
          <p><strong>Informations de la carte</strong></p>
        </div>
        <form action="{{ route('carte') }}"  class="form-control" method="POST" style="height: 60%;"> 
            @csrf
            <div class="row tout" style="margin: 1rem;">
                <div class="col right">
                  <input type="text" name="numero_carte" class="form-control first" placeholder="numero de la carte" aria-label="numero de la carte" value="{{old('email')}}">
                  {!!$errors->first('numero_carte','<p class="errors">:message</p>')!!}
                  <input type='date' name="date_creation" class="form-control first" placeholder="Select Date" value="{{old('email')}}"/>
                  {!!$errors->first('date_creation','<p class="errors">:message</p>')!!}
                  <select class="form-select first" name="type" aria-label="Default select example">
                    <option selected>type de carte</option>
                    <option value="carte electron">Carte electron</option>
                    <option value="carte visa">Carte visa</option>
                    <option value="master carte">Master carte</option>
                  </select>
                  {{-- <p>{{$count}}</p> --}}
                  <select class="form-select select 2" name ="comptebank_id" aria-label="Default select example">
                    <option selected>Select Numero compte</option>
                    @foreach ( $count as $rest )
                    <option value="{{$rest->id}}">{{$rest->numero_compte}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col gauche" style="padding-right: 0;">
                  <input type="password" name="codesecret" class="form-control first" placeholder="code secret" aria-label="code secret" value="{{old('email')}}">
                  {!!$errors->first('codesecret','<p class="errors">:message</p>')!!}
                  <input type='date' name="date_expiration" class="form-control first" placeholder="Select Date" value="{{old('email')}}"/>
                  {!!$errors->first('date_expiration','<p class="errors">:message</p>')!!}
                  <div class="modalsex" style="padding-top: 1rem;">
                    <p style="padding: 0;margin: 0;">Status</p>
                      <div class="form-check" style="padding-left: 2.5em;" class="form-check">
                        <input class="form-check-input sex" type="radio" name="statut" id="actif" value="1" checked>
                        <label class="form-check-label" for="actif">
                          Actif
                        </label>
                      </div>
                      <div class="form-check" style="padding-left: 2.5em;">
                        <input class="form-check-input sex" type="radio" name="statut" id="inactif" value="0" >
                        <label class="form-check-label" for="inactif">
                          Inactif
                        </label>
                      </div>
                  </div>
                  <div class="col-12 envoi" style="margin-top: 1.75rem;">
                    <button class="btn btn-primary" value="submit" name="envoi" type="submit">Submit form</button>
                  </div>
                  {{-- <p>{{$id}}</p> --}}
                </div>
            </div>
        </form>
    </div>
@endsection
