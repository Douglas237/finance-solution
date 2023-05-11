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
                      <button type="button" class="btn btn-primary" id="newclient" style="border-radius: 25%; background-color:#02501c">
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
  <div class="modal fade" data-bs-backdrop="static" id="newclientModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header modalhead">
          <h1 class="modal-title fs-5" id="newtitle">Nouveau client</h1>
          <button type="button" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
          <form id="formnewclient" class="form-control modalform" enctype="multipart/form-data"> 
              @csrf
              <div class="row tout">
                  <div class="col right">
                      <input type="hidden" id="client_id" name="client_id">
                      <input type="text" name="nom" id="nom" class="form-control firstmodal"
                          placeholder="nom" aria-label="nom" required>
                      <span style="margin-left: 1.5rem" id="nom_error" class="text-danger errors"></span>
                      <input type="text" name="email" id="email" class="form-control firstmodal"
                          placeholder="email" aria-label="email" required>
                      <span style="margin-left: 1.5rem" id="email_error" class="text-danger errors"></span>
                      <input type="text" name="ville" id="ville" class="form-control firstmodal"
                          placeholder="ville" aria-label="ville" required>
                      <span style="margin-left: 1.5rem" id="ville_error" class="text-danger errors"></span>
                      <input type='date' name="date_naissance" id="date_naissance" class="form-control firstmodal"
                          placeholder="Select Date"/>
                      <span style="margin-left: 1.5rem" id="date_naissance_error" class="text-danger errors"></span>
                      <div class="modalsex" style="margin-top: -1.5rem">
                          <p style="padding: 0;margin: 0;">Sex :</p>
                          <div class="form-check">
                              <input class="form-check-input sexM" type="radio" value="male" name="sexe"
                                  id="male">
                              <label class="form-check-label" for="male">
                                  Homme
                              </label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input sexM" type="radio" value="femelle" name="sexe"
                                  id="femelle" checked>
                              <label class="form-check-label" for="femelle">
                                  Femme
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="col gauche">
                      <input type="text" name="prenom" id="prenom" class="form-control firstmodal"
                          placeholder="prenom" aria-label="prenom" required>
                      <span style="margin-left: 1.5rem" id="prenom_error" class="text-danger errors"></span>
                      <input type="text" name="telephone" id="telephone" class="form-control firstmodal"
                          placeholder="telephone" aria-label="telephone" required>
                      <span style="margin-left: 1.5rem" id="telephone_error" class="text-danger errors"></span>
                      <input type="text" name="cni" id="cni" class="form-control firstmodal"
                          placeholder="num_cni" aria-label="num_cni" required>
                      <span style="margin-left: 1.5rem" id="cni_error" class="text-danger errors"></span>
                      <input type="text" name="adress" id="adress" class="form-control firstmodal"
                          placeholder="adress" aria-label="adress" required>
                      <span style="margin-left: 1.5rem" id="adress_error" class="text-danger errors"></span>
                      <input type="file" name="image" id="image" class="form-control firstmodal"
                          aria-label="file example" required>
                      <span style="margin-left: 1.5rem" id="image_error" class="text-danger errors"></span>
                  </div>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button  class="btn btn-success" type="submit" id="editer" value="submit" name="envoi" type="submit">Enregistrer</button>
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
      var val = $("select.first").val()
      if (val == "Compte courant") {
        $('#num').val({{'1001'.random_int(1000, 9999).random_int(1000, 9999);}})
      }
      if (val == "Compte epagne") {
        $('#num').val({{'1111'.random_int(1000, 9999).random_int(1000, 9999);}})
      }
    });
  </script>
  <script type="text/javascript">
    $(function () {
      // $.ajaxSetup({
      //   headers: {
      //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   }
      // });
      var form = $('#formnewclient')[0];

      $('body').on('click', '#newclient', function() {
        $('.errors').html('');
        $("#formnewclient").trigger("reset");
        $('#newclientModal').modal('show');
      });

      $('body').on('click', '#close', function() {
        $('.errors').html('');
        $("#formnewclient").trigger("reset");
        $('#client_id').val('');
      });
      $('body').on('click', '#editer', function(e) {
                $('.errors').html('');
                var formdata = new FormData(form);
                $.ajax({
                    url: '{{ route('modif') }}',
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                      $('#newclientModal').modal('hide');
                      console.log(response);
                      window.location.reload();
                    },
                    error: function(error) {

                        $('#nom_error').html(error.responseJSON.errors.nom);
                        $('#email_error').html(error.responseJSON.errors.email);
                        $('#ville_error').html(error.responseJSON.errors.ville);
                        $('#date_naissance_error').html(error.responseJSON.errors.date_naissance);
                        $('#prenom_error').html(error.responseJSON.errors.prenom);
                        $('#telephone_error').html(error.responseJSON.errors.telephone);
                        $('#cni_error').html(error.responseJSON.errors.cni);
                        $('#adress_error').html(error.responseJSON.errors.adress);
                        $('#image_error').html(error.responseJSON.errors.image);
                        console.log(error);
                    }
                });
            });
    });
  </script>
@endsection


