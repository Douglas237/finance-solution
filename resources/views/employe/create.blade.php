@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title" style="display: flex;flex-direction: row; justify-content: space-between;">
            <p><strong>Nouveau Employé</strong></p>
            {{-- <button style="margin-right: 7rem; height: 3.5rem ;" type="button" class="btn btn-outline-success"><a href="{{ route('entreprise') }}">Entreprise</a></button> --}}
        </div>
        <form action="{{route('employe.store')}}" method="POST" class="form-control" enctype="multipart/form-data">
            @csrf
            <div class="note">
                <p><strong>Informations de l'employé</strong></p>
            </div>
            <div class="row tout">
                <div class="col right">
                  <input type="text" name="nom" class="form-control first" placeholder="Votre Nom" aria-label="nom" required>
                  <input type="email" name="email" class="form-control first" placeholder="Email ex:email@gmail.com" aria-label="email" required>
                  <input type="password" name="password" class="form-control first" placeholder="Mot de pass" aria-label="Mot de pass" required>
                  <input type='date' name="date_naissance" class="form-control first" placeholder="Select Date" />
                  <div style="margin-top: -1.5rem">
                    <p style="padding: 0;margin: 0;">Sex</p>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" value="male" name="sexe" id="male">
                        <label class="form-check-label" for="male">
                          Homme
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" value="femelle" name="sexe"  id="femelle" checked>
                        <label class="form-check-label" for="femelle">
                          Femme
                        </label>
                      </div>
                  </div>
                </div>
                <div class="col gauche">
                  <input type="text" name="prenom" class="form-control first" placeholder="Votre Prenom" aria-label="prenom" required>
                  <input type="number" name="telephone" class="form-control first" placeholder="Telephone" aria-label="telephone" required>
                  <input type="text" name="cni" class="form-control first" placeholder="N° CNI" aria-label="cni" required>
                  <input type="text" name="poste" class="form-control first" placeholder="Poste" aria-label="poste" required>
                  <input type="file" name="image" class="form-control first" aria-label="file example" required>
                </div>
                <div class="col-12 envoi">
                  <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </div>
        </form>
    </div>
@endsection
