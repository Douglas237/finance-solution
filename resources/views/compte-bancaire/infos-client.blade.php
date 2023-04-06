@extends('layouts.dashboard')
@section('content')
  <div class="formcompte">
    <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
      <p><strong>Nouveau Client</strong></p>
      <a
      href="{{ route('entreprise') }}"><button style="margin-right: 7rem;height: 3.5rem;width: 10rem" type="button" class="btn btn-outline-success">Entreprise</button></a>
    </div>
    <div class="note">
      <p><strong>Informations du client</strong></p>
    </div>
    <form action="{{ route('Client.store') }}" method="POST" id="oui" class="form-control"
      enctype="multipart/form-data">
      @csrf
      <div class="row tout">
        <div class="col right">
          <input type="text" name="nom" class="form-control first" placeholder="nom" aria-label="nom"
            required>
          <input type="text" name="email" class="form-control first" placeholder="email" aria-label="email"
            required>
          <input type="text" name="ville" class="form-control first" placeholder="ville" aria-label="ville"
            required>
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
              <input class="form-check-input sex" type="radio" value="femelle" name="sexe" id="femelle"
                checked>
              <label class="form-check-label" for="femelle">
                Femme
              </label>
            </div>
          </div>
        </div>
        <div class="col gauche">
          <input type="text" name="prenom" class="form-control first" placeholder="prenom" aria-label="prenom"
            required>
          <input type="text" name="telephone" class="form-control first" placeholder="telephone"
            aria-label="telephone" required>
          <input type="text" name="cni" class="form-control first" placeholder="num_cni"
            aria-label="num_cni" required>
          <input type="text" name="adress" class="form-control first" placeholder="adress" aria-label="adress"
            required>
          <input type="file" name="image" class="form-control first" aria-label="file example" required>
        </div>
        <div class="col-12 envoi">
          <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
      </div>
    </form>
  </div>
@endsection
