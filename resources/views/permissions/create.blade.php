@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">

        <div class="bg-light p-4 rounded">
            <h2>Add new permission</h2>
            <div class="lead">
                Add new permission.
            </div>

            <div class="container mt-4">

                <form method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input value="{{ old('name') }}"
                            type="text"
                            class="form-control"
                            name="name"
                            placeholder="Name" required>

                        @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Save permission</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>

        </div>

        {{-- <div class="title">
            <p><strong>Nouveau beneficiaire pour une entreprise</strong></p>
        </div>
        <div class="note">
          <p><strong>Informations du beneficiaire</strong></p>
        </div>
        <form action="{{ route('beneficiaire.store') }}"  class="form-control" method="POST" style="height: 60%;">
            @csrf
            <div class="row tout" style="margin: 1rem;">
                <div class="col right" >
                  <input type="text" name="nom_beneficiaire" class="form-control first" placeholder="Nom beneficiaire" aria-label="Nom beneficiaire" value="{{old('nom_beneficiaire')}}">
                  {!!$errors->first('nom_beneficiaire','<p class="errors">:message</p>')!!}
                  <select class="form-select first" name="entreprise_id" aria-label="Default select example">
                    <option selected>Select entreprise</option>
                    @foreach ($entreprise as $item)
                    <option value="{{$item->id}}">{{$item->nom_entreprise}}</option>
                    @endforeach
                  </select>
                  <input type="text" name="prenom" class="form-control first" placeholder="Prenom" aria-label="Prenom" value="{{old('prenom')}}">
                  {!!$errors->first('prenom','<p class="errors">:message</p>')!!}
                </div>
                <div class="col gauche"  style="padding-right: 0;">
                  <select class="form-select first"  name="sexe" aria-label="Default select example">
                    <option selected>Select sexe</option>
                    <option value="male">Homme</option>
                    <option value="femmel">Femme</option>
                  </select>
                  <input type='text' name="telephone" id="telephone" class="form-control first" placeholder="Telephone" value="{{old('telephone')}}"/>
                  {!!$errors->first('telephone','<p class="errors">:message</p>')!!}
                  <input type='text' name="cni" class="form-control first" placeholder="N° CNI" aria-label="cni" value="{{old('cni')}}"/>
                  {!!$errors->first('cni','<p class="errors">:message</p>')!!}
                  <div class="col-12 envoi">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                  </div>
                </div>
            </div>
        </form> --}}
    </div>
@endsection
