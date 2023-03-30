@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title">
            <p><strong>Nouveau beneficiaire</strong></p>
        </div>
        <form action="{{ route('beneficiaire.store',[$id]) }}"  class="form-control" method="POST">
            @csrf
            <div class="note">
              <p><strong>Informations du beneficiaire</strong></p>
            </div>
            <div class="row tout">
                <div class="col right">
                  <input type="text" name="nom" class="form-control first" placeholder="Nom beneficiaire" aria-label="Nom beneficiaire">
                  <select class="form-select first" name="type" aria-label="Default select example">
                    <option selected>Type de propriétaire</option>
                    <option value="client">Client</option>
                    <option value="entreprise">Entreprise</option>
                  </select>
                  <input type="text" name="prenom" class="form-control first" placeholder="Prenom" aria-label="Prenom">
                  <input type='text' name="cni" class="form-control first" placeholder="N° CNI" aria-label="cni" />
                </div>
                <div class="col gauche">
                  <select class="form-select first" name="sexe" aria-label="Default select example">
                    <option selected>Select sexe</option>
                    <option value="male">Homme</option>
                    <option value="femmel">Femme</option>
                  </select>
                  <input type='number' name="telephone" class="form-control first" placeholder="Telephone" />
                  <div class="col-12 envoi">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                  </div>
                </div>
            </div>
            <p>{{$id}}</p>
        </form>
    </div>
@endsection
