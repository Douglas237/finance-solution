@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
            <p><strong>Nouveau beneficiaire pour un client</strong></p> 
        </div>
        <div class="note">
          <p><strong>Informations du beneficiaire</strong></p>
        </div>
        <form action="{{ route('clientben.storebeneclient') }}"  class="form-control" method="POST" style="height: 60%;">
            @csrf
            <div class="row tout" style="margin: 1rem;">
                <div class="col right">
                  <input type="text" name="nom_beneficiaire" class="form-control first" placeholder="Nom beneficiaire" aria-label="Nom beneficiaire" value="{{old('nom_beneficiaire')}}">
                  {!!$errors->first('nom_beneficiaire','<p class="errors">:message</p>')!!}
                  <select class="form-select first" name="client_id" aria-label="Default select example">
                    <option selected>Select client</option>
                    @foreach ($client as $item)
                    <option value="{{$item->id}}">{{$item->nom}}</option>
                    @endforeach
                  </select>
                  <input type="text" name="prenom" class="form-control first" placeholder="Prenom" aria-label="Prenom" value="{{old('prenom')}}">
                  {!!$errors->first('prenom','<p class="errors">:message</p>')!!}
                </div>
                <div class="col gauche" style="padding-right: 0;">
                  <select class="form-select first" name="sexe" aria-label="Default select example">
                    <option selected>Select sexe</option>
                    <option value="male">Homme</option>
                    <option value="femmel">Femme</option>
                  </select>
                  <input type='text' name="telephone" id="telephone" class="form-control first" placeholder="Telephone" value="{{old('telephone')}}" />
                  {!!$errors->first('telephone','<p class="errors">:message</p>')!!}
                  <input type='text' name="cni" class="form-control first" placeholder="N° CNI" aria-label="cni" value="{{old('cni')}}" />
                  {!!$errors->first('cni','<p class="errors">:message</p>')!!}
                  <div class="col-12 envoi">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                  </div>
                </div>
            </div>
            {{-- <p>{{$id}}</p> --}}
        </form>
    </div>
@endsection
