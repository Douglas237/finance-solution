@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title">
            <p><strong>Nouveau Compte bancaire</strong></p>
        </div>
        <div class="note">
          <p><strong>Informations du compte</strong></p>
        </div>
        <form style="height: 60%;" action="{{ route('compte.client') }}" id="" class="form-control" method="POST">
            @csrf
            <div class="row tout" style="margin: 1rem;">
                <div class="col right">
                  <select class="form-select first" name="type" aria-label="Default select example">
                    <option value="">Type de compte</option>
                    <option value="Compte courant" {{ "Compte courant" === old('type') ? 'selected' : '' }}>Compte courant</option>
                    <option value="Compte epagne" {{ "Compte epagne" === old('type') ? 'selected' : '' }}>Compte epagne</option>
                  </select>
                  {!!$errors->first('type','<p class="errors">:message</p>')!!}
                  {{-- <select class="form-select first" name="comptebankable_type" aria-label="Default select example">
                    <option selected>Nature du compte</option>
                    <option value="App\Models\client">Client</option>
                    <option value="App\Models\entreprise">Entreprise</option>
                  </select> --}}
                  <div class="col-8 max">
                     <select class="form-select first" name="client_id" aria-label="Default select example" style="width: 90%;">
                        <option value="">select client</option>
                        @foreach ( $client as $item )
                         <option value="{{$item->id}}" {{ $item->id == old('client_id') ? 'selected' : '' }}>{{$item->nom}}</option>
                        @endforeach
                      </select>
                      <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal" style="border-radius: 25%; background-color:#02501c">
                        <i class="fa fa-plus" style="background-color: #fff"></i>
                      </button>
                    </div>
                    {!!$errors->first('client_id','<p class="errors">:message</p>')!!}
                  <input type="number" min="0" name="solde" class="form-control first" placeholder="solde" aria-label="solde"  value="{{old('solde')}}"> 
                  {!!$errors->first('solde','<p class="errors">:message</p>')!!}
                  <input type='text' name="code" class="form-control first" placeholder="code" aria-label="code" value="{{old('code')}}"/>
                  {!!$errors->first('code','<p class="errors">:message</p>')!!}
                </div>
                <div class="col gauche" style="padding-right: 0;">
                  <input type="text" name="num" readonly id="num" class="form-control first" placeholder="numero du compte" aria-label="numero du compte" >
                  {!!$errors->first('num','<p class="errors">:message</p>')!!}
                  {{-- <select class="form-select first" name="comptebankable_id" aria-label="Default select example">
                    <option selected>select entreprise</option>
                    @foreach ( $entreprise as $item )
                    <option value="{{$item->id}}">{{$item->nom_entreprise}}</option>
                    @endforeach
                  </select> --}}
                  <input type='date' name="date_ouverture" value="{{old('date_ouverture')}}" class="form-control first" placeholder="Select Date" />
                  {!!$errors->first('date_ouverture','<p class="errors">:message</p>')!!}
                  <div style="padding-top: 0.4rem;" class="modalsex">
                    <p style="padding: 0;margin: 0;">Status</p>
                      <div style="padding-left: 2.5em;" class="form-check">
                        <input class="form-check-input sexM" type="radio" name="statut" id="actif" value="1" checked>
                        <label class="form-check-label" for="actif">
                          Actif
                        </label>
                      </div>
                      <div style="padding-left: 2.5em;" class="form-check">
                        <input class="form-check-input sexM" type="radio" name="statut" id="inactif" value="0" >
                        <label class="form-check-label" for="inactif">
                          Inactif
                        </label>
                      </div>
                  </div>

                  {{-- <div>
                    <p style="padding: 0;margin: 0;">Lier a une carte</p>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" name="lier" id="oui" value="oui" checked>
                        <label class="form-check-label" for="oui">
                          oui
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" name="lier" id="non" value="non" >
                        <label class="form-check-label" for="non">
                          non
                        </label>
                      </div>
                  </div> --}}
                  <div class="col-12 envoi" style="margin-top: 2.4rem;">
                    <button class="btn btn-primary" value="submit" name="envoi" type="submit">Submit form</button>
                  </div>
                  {{-- <p>{{$id}}</p> --}}
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #02501c">
          <h5 class="modal-title" id="exampleModalLabel" style="color: #fff">Ajout Client</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button  class="btn btn-success" value="submit" name="envoi" type="submit">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("select.first").change(function(){
        var langage = $(this).children("option:selected").val();
        if (langage == "Compte courant") {
          $('#num').val({{'1001'.random_int(1000, 9999).random_int(1000, 9999);}})
        }
        if (langage == "Compte epagne") {
          $('#num').val({{'1111'.random_int(1000, 9999).random_int(1000, 9999);}})
        }
        // alert("Vous avez sélectionné le langage : " + langage);
      });
    });
    var val = $("select.first").val()
    if (val == "Compte courant") {
      $('#num').val({{'1001'.random_int(1000, 9999).random_int(1000, 9999);}})
    }
    if (val == "Compte epagne") {
      $('#num').val({{'1111'.random_int(1000, 9999).random_int(1000, 9999);}})
    }
    </script>
@endsection


