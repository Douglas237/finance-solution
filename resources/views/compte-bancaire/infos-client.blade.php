@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
            <p><strong>Nouveau Client</strong></p>
        </div>
        <div class="note">
            <p><strong>Informations du client</strong></p> 
        </div>
        <form action="{{ route('Client.store') }}" method="POST" id="oui" class="form-control" enctype="multipart/form-data">
            @csrf
            <div class="row tout" style="margin: 1rem;"> 
                <div class="col right">
                    <input type="text" name="nom" class="form-control first" placeholder="nom" aria-label="nom" value="{{old('nom')}}"/>
                        {!!$errors->first('nom','<p class="errors">:message</p>')!!}
                    <input type="email" name="email" class="form-control first" placeholder="Ex: Non@mail.com"
                        aria-label="email" value="{{old('email')}}"/>
                        {!!$errors->first('email','<p class="errors">:message</p>')!!}
                    <input type="text" name="ville" class="form-control first" placeholder="ville" aria-label="ville" value="{{old('ville')}}"/>
                        {!!$errors->first('ville','<p class="errors">:message</p>')!!}
                    <input type='date' name="date_naissance" class="form-control first" placeholder="Select Date" value="{{old('date_naissance')}}"/>
                    {!!$errors->first('date_naissance','<p class="errors">:message</p>')!!}
                    <div class="modalsex" style="padding-top: 1rem;">
                        <p style="padding: 0;margin: 0;">Sex :</p>
                        <div style="padding-left: 2.5em;" class="form-check">
                            <input class="form-check-input sex" type="radio" value="male" name="sexe" id="male" value="{{old('male')}}"/>
                            <label class="form-check-label" for="male">
                                Homme
                            </label>
                        </div>
                        <div style="padding-left: 2.5em;" class="form-check">
                            <input class="form-check-input sex" type="radio" value="femelle" name="sexe" id="femelle"
                                checked value="{{old('femelle')}}">
                            <label class="form-check-label" for="femelle">
                                Femme
                            </label>
                        </div>
                    </div> 
                </div>
                <div class="col gauche" style="padding-right: 0;">
                    <input type="text" name="prenom" class="form-control first" placeholder="prenom" aria-label="prenom" value="{{old('prenom')}}">
                        {!!$errors->first('prenom','<p class="errors">:message</p>')!!}
                    <input type="tel" name="telephone" id="telephone" class="form-control first telephone"
                        placeholder="Tel : 6xx xxx xxx" aria-label="telephone" value="{{old('telephone')}}">
                        {!!$errors->first('telephone','<p class="errors">:message</p>')!!}
                    <input type="text" name="cni" class="form-control first" placeholder="num_cni"
                        aria-label="num_cni" value="{{old('cni')}}">
                        {!!$errors->first('cni','<p class="errors">:message</p>')!!}
                    <input type="text" name="adress" class="form-control first" placeholder="adress" aria-label="adress" value="{{old('adress')}}">
                        {!!$errors->first('adress','<p class="errors">:message</p>')!!}
                    <input type="file" name="image" class="form-control first" aria-label="file example">
                    {!!$errors->first('image','<p class="errors">:message</p>')!!}
                </div>
                <div class="col-12 envoi">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </div>
        </form>
    </div>
@endsection
