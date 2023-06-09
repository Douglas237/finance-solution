@extends('layouts.dashboard')

@section('content')
<div class="formcompte">
    <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
        <p><strong>Nouveau Utilisateur</strong></p>
    </div>
    <div class="note">
        <p><strong>Informations de l'utilisateur</strong></p>
    </div>

            <form method="POST" action="{{ route('users.store') }}" id="oui" class="form-control" enctype="multipart/form-data">
                @csrf
                <div class="row tout" style="margin: 1rem;">
                    <div class="col right">
                        <input type="text" name="name" class="form-control first" placeholder="Nom" aria-label="nom" value="{{old('name')}}"/>
                        {!!$errors->first('nom','<p class="errors">:message</p>')!!}
                        <input type="text" name="last_name" class="form-control first" placeholder="Prenom" aria-label="prenom" value="{{old('last_name')}}"/>
                        {!!$errors->first('prenom','<p class="errors">:message</p>')!!}
                        <input type="email" name="email" class="form-control first" placeholder="Email@gmail.com" aria-label="email" value="{{old('email')}}"/>
                        {!!$errors->first('email','<p class="errors">:message</p>')!!}
                        <input type="date" name="date_naissance" class="form-control first" placeholder="Date Naissance" aria-label="date_naissance" value="{{old('date_naissance')}}"/>
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

                        {{-- <input type="text" name="sexe" class="form-control first" placeholder="sexe" aria-label="sexe" value="{{old('sexe')}}"/>
                        {!!$errors->first('sexe','<p class="errors">:message</p>')!!} --}}
                    </div>
                    <div class="col gauche" style="padding-right: 0;">
                        <input type="text" name="username" class="form-control first" placeholder="Non d'utilisateur" aria-label="username" value="{{old('username')}}"/>
                        {!!$errors->first('username','<p class="errors">:message</p>')!!}
                        <input type="text" name="cni" class="form-control first" placeholder="N° CNI" aria-label="cni" value="{{old('cni')}}"/>
                        {!!$errors->first('cni','<p class="errors">:message</p>')!!}
                        <input type="tel" name="telephone" class="form-control first telephone" id="telephone" placeholder="Tel : 6xx xxx xxx" aria-label="telephone" value="{{old('telephone')}}"/>
                        {!!$errors->first('telephone','<p class="errors">:message</p>')!!}
                        <input type="text" name="post" class="form-control first" placeholder="Poste" aria-label="post" value="{{old('post')}}"/>
                        {!!$errors->first('post','<p class="errors">:message</p>')!!}
                        <input type="password" name="password" class="form-control first" placeholder="Mot de pass" aria-label="password"/>
                        {!!$errors->first('nom','<p class="errors">:message</p>')!!}
                    </div>
                    <div class="col-12 envoi">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </div>
                {{-- <button type="submit" class="btn btn-primary">Save user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Back</a> --}}
            </form>
                {{-- value="{{old('name')}}" --}}

                {{-- <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}"
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div> --}}
                {{-- <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ old('email') }}"
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input value="{{ old('username') }}"
                        type="text"
                        class="form-control"
                        name="username"
                        placeholder="Username" required>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div> --}}
</div>
@endsection

{{-- <div class="bg-light p-4 rounded">
    </div> --}}
        {{-- <h1>Add new user</h1>
        <div class="lead">
            Add new user and assign role.
        </div> --}}

        {{-- <div class="container mt-4">
        </div> --}}
