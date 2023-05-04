@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
            <p><strong>Nouveau Compte bancaire entreprise</strong></p>
            {{-- <a href="{{ route('Client.create') }}"><button style="margin-right: 7rem;height: 3.5rem;width: 10rem" type="button" class="btn btn-outline-success">Client</button></a> --}}
        </div>
        <div class="note">
          <p><strong>Informations entrprise</strong></p>
        </div>
        <form action="{{ route('entreprise') }}" id="oui"  style="height: 56%;" class="form-control" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="row tout" style="margin: 1rem;">
                <div class="col right">
                  <input type="text" name="nom_entreprise" class="form-control first" placeholder="nom de l'entreprise" aria-label="nom de l'entreprise" value="{{old('nom_entreprise')}}">
                  {!!$errors->first('nom_entreprise','<p class="errors">:message</p>')!!}
                  <input type="text" name="type_entreprise" class="form-control first" placeholder="type entreprise" aria-label="type entreprise" value="{{old('type_entreprise')}}">
                  {!!$errors->first('type_entreprise','<p class="errors">:message</p>')!!}
                  <input type="file" name="image" class="form-control first" aria-label="file example">
                  {!!$errors->first('image','<p class="errors">:message</p>')!!}
                </div>
                <div class="col gauche" style="padding-right: 0;">
                    <input type="text" name="nom_respon" class="form-control first" placeholder="nom du responssable" aria-label="nom du responssable"  value="{{old('nom_respon')}}">
                    {!!$errors->first('nom_respon','<p class="errors">:message</p>')!!}
                    <input type="text" name="cni_respon" class="form-control first" placeholder="numero cni du responssable" aria-label="type entreprise" value="{{old('cni_respon')}}">
                    {!!$errors->first('cni_respon','<p class="errors">:message</p>')!!}
                  <div class="col-12 envoi">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                  </div>
                </div>
            </div>
        </form>
    </div>
@endsection
