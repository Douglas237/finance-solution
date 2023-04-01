@extends('layouts.dashboard')

@section('content')

<div class="modal fade" data-bs-backdrop="static" id="employer_modal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="employermodal" class="form-control" enctype="multipart/form-data">
                        @csrf
                        <div class="note">
                            <p><strong id="modaltitle">Informations du client</strong></p>
                        </div>
                        <div class="row tout">
                            <div class="col right">
                              <input type="hidden" id="employer_id" name="employer_id">
                              <input type="text" name="nom" id="nom" class="form-control first" placeholder="nom" aria-label="nom" required>
                              <input type="text" name="prenom" id="prenom" class="form-control first" placeholder="prenom" aria-label="prenom" required>
                              <input type='date' name="date_naissance" id="date_naissance" class="form-control first" placeholder="Select Date" />
                              <input type="text" name="email" id="email" class="form-control first" placeholder="email" aria-label="email" required>
                              <div style="margin-top: -1.5rem">
                                  <p style="padding: 0;margin: 0;">Sex</p>
                                  <div class="form-check">
                                    <input class="form-check-input sex" type="radio" value="male" name="sexe" id="male">
                                    <label class="form-check-label" for="male">
                                      Homme
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input sex" type="radio" value="femmel" name="sexe"  id="femelle" checked>
                                    <label class="form-check-label" for="femelle">
                                      Femme
                                    </label>
                                  </div>
                              </div>
                            </div>
                            <div class="col gauche">
                              <input type="text" name="poste" id="poste" class="form-control first" placeholder="poste" aria-label="poste" required>
                              <input type="text" name="telephone" id="telephone" class="form-control first" placeholder="telephone" aria-label="telephone" required>
                              <input type="text" name="cni" id="cni" class="form-control first" placeholder="num_cni" aria-label="num_cni" required>
                              <input type="text" name="password" id="password" class="form-control first" placeholder="password" aria-label="password" required>
                              <input type="file" name="image" id="image" class="form-control first" aria-label="file example" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="editer" class="btn btn-primary">Edite</button>
                </div>
            </div>
        </div>
    </div>

    <div class="form-control">
        <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
            <p><strong>Nouveau employer</strong></p>
            <button style="margin-right: 7rem;height: 3.5rem;" type="button" id="addemployer" class="btn btn-outline-success">Add employer</button>
        </div>
        <div class="formcompte">
            <div class="title">
                <p><strong>Liste des employer</strong></p>
            </div>
            <div class="alltabs">
                <div class="tabs_1">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th scope="col">N° </th>
                                <th scope="col">nom</th>
                                <th scope="col">prenom</th>
                                <th scope="col">date naissance</th>
                                <th scope="col">sexe</th>
                                <th scope="col">cni</th>
                                <th scope="col">email</th>
                                I<th scope="col">telephone</th>
                                <th scope="col">Poste</th>
                                <th scope="col">Password</th>
                                <th scope="col">image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                        </tr> --}}

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var form = $('#employermodal')[0];
            var table = $(".data-table").DataTable({
                severSide: true,
                processing: true,
                ajax: "{{ route('employer') }}",
                "bPaginate": true,  
                "bInfo": true,  
                "bFilter": true,
                "bAutoWidth": false,
                "aoColumns" : [
                    { sWidth: '50px' },
                    { sWidth: '100px' },
                    { sWidth: '120px' },
                    { sWidth: '30px' }
                ],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nom',
                        name: 'nom'
                    },
                    {
                        data: 'prenom',
                        name: 'prenom'
                    },
                    {
                        data: 'date_naissance',
                        name: 'date_naissance'
                    },
                    {
                        data: 'sexe',
                        name: 'sexe'
                    },
                    {
                        data: 'cni',
                        name: 'cni'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'telephone',
                        name: 'telephone'
                    },
                    { 
                        data: 'poste',
                        name: 'poste'
                    },
                    { 
                        data: 'password',
                        name: 'password'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }

                ]
            });
            // creation d'un employer
            $('body').on('click','#addemployer', function() {
                $('#employer_modal').modal('show');
                $('#modaltitle').html('new employer');
            });

            // edition d'un client
            $('body').on('click','#edite', function () {
                var id = $(this).data('id');
                $.ajax({
                    url:'{{url("employer/toedite",'')}}'+'/'+id,
                    method:'GET',

                    success:function (response) {
                        $('#modaltitle').html('Edite employer');
                        $('#employer_id').val(response.id);
                        $('#nom').val(response.nom);
                        $('#prenom').val(response.prenom);
                        $('#date_naissance').val(response.date_naissance);
                        $('#sexe').val(response.sexe);
                        $('#email').val(response.email);
                        $('#telephone').val(response.telephone);
                        $('#cni').val(response.cni);
                        $('#poste').val(response.poste);
                        $('#password').val(response.password);
                        $('#employer_modal').modal('show');
                        console.log(response.id);
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            });
            
            $('body').on('click','#editer',function () {
                var formdata = new FormData(form);
                $.ajax({
                    url:'{{route("employer.edite")}}',
                    method:'POST',
                    data:formdata,
                    processData:false,
                    contentType:false,

                    success:function(response){
                        table.ajax.reload();
                        $('#employer_modal').modal('hide');
                        $("#employermodal").trigger("reset");
                        console.log(response);
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            });

            // delete an employer
            $('body').on('click','#delet',function () {
               var id = $(this).data("id");
               $.ajax({
                    url:'{{url("employer/delete",'')}}'+'/'+id,
                    method: 'DELETE',

                    success:function(response){
                        table.ajax.reload();
                        console.log(response);
                    },
                    error:function(error){
                        console.log(error);
                    }
               });
            });

            // detail employer

            $('body').on('click','#detail',function name(params) {
               var id = $(this).data("id");
               $.ajax({
                    url:'{{url("employer/toshow",'')}}'+'/'+id,
                    method:'GET',

                    success:function(response){
                        window.location.href = "{{url('employer/show')}}"+"/"+id;
                    },

                    error:function(error){
                        console.log(error);
                    }
               });
            });
        });
    </script>
@endsection
