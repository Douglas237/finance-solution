@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
            <p><strong>Nouveau Compte bancaire entreprise</strong></p>
            <button style="margin-right: 7rem;height: 3.5rem;" type="button" class="btn btn-outline-success"><a href="{{ route('Client.create') }}">Client</a></button>
        </div>
        <form action="{{ route('entreprise') }}" id="oui"  class="form-control" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="note">
              <p><strong>Informations entrprise</strong></p>
            </div>
            <div class="row tout">
                <div class="col right">
                  <input type="text" name="nom_entreprise" class="form-control first" placeholder="nom de l'entreprise" aria-label="nom de l'entreprise">
                  <input type="text" name="type_entreprise" class="form-control first" placeholder="type entreprise" aria-label="type entreprise">
                  <input type="file" name="image" class="form-control first" aria-label="file example" required>
                </div>
                <div class="col gauche">
                    <input type="text" name="nom_respon" class="form-control first" placeholder="nom du responssable" aria-label="nom du responssable">
                    <input type="text" name="cni_respon" class="form-control first" placeholder="numero cni du responssable" aria-label="type entreprise">
                  <div class="col-12 envoi">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                  </div>
                </div>
            </div>
        </form>
    </div>
@endsection
