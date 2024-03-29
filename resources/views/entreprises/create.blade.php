@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title">
            <p><strong>Nouveau Compte bancaire</strong></p>
        </div>
        <div class="note">
          <p><strong>Informations de l'entreprise</strong></p>
        </div>
        <form action="{{ route('creation.entreprise') }}" id="" class="form-control" method="POST">
            @csrf
            <div class="row tout">
                <div class="col right">
                  <input type="text" name="num" id="num" class="form-control first" placeholder="numero du compte" aria-label="numero du compte">
                  {{-- <select class="form-select first" name="comptebankable_type" aria-label="Default select example">
                    <option selected>Nature du compte</option>
                    <option value="App\Models\client">Client</option>
                    <option value="App\Models\entreprise">Entreprise</option>
                  </select> --}}

                  <select class="form-select first" name="entreprise_id" aria-label="Default select example">
                    <option selected>select entreprise</option>
                    @foreach ( $entreprise as $item )
                    <option value="{{$item->id}}">{{$item->nom_entreprise}}</option>
                    @endforeach
                  </select>

                  <input type="text" name="solde" class="form-control first" placeholder="solde" aria-label="solde">
                  <input type='text' name="code" class="form-control first" placeholder="code" aria-label="code" />
                </div>
                <div class="col gauche">
                  <select class="form-select first" name="type" aria-label="Default select example">
                    <option selected>Type de compte</option>
                    <option value="Compte courant">Compte courant</option>
                    <option value="Compte epagne">Compte epagne</option>
                  </select>
                  {{-- <select class="form-select first" name="comptebankable_id" aria-label="Default select example">
                    <option selected>select entreprise</option>
                    @foreach ( $entreprise as $item )
                    <option value="{{$item->id}}">{{$item->nom_entreprise}}</option>
                    @endforeach
                  </select> --}}
                  <input type='date' name="date_ouverture" class="form-control first" placeholder="Select Date" />
                  <div>
                    <p style="padding: 0;margin: 0;">Status</p>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" name="statut" id="actif" value="1" checked>
                        <label class="form-check-label" for="actif">
                          Actif
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input sex" type="radio" name="statut" id="inactif" value="0" >
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
                  <div class="col-12 envoi">
                    <button class="btn btn-primary" value="submit" name="envoi" type="submit">Submit form</button>
                  </div>
                  {{-- <p>{{$id}}</p> --}}
                </div>
            </div>
        </form>
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
    </script>
@endsection
