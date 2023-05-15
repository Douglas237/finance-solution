@extends('layouts.dashboard')

@section('content')

    <!-- Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="client_modal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modalhead">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edition Client</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="clientmodal" class="form-control modalform" enctype="multipart/form-data">
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
                                <input type="tel" name="telephone" id="telephone" class="form-control firstmodal"
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
                    <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="editer" class="btn btn-primary">Edite</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-control">
        <div class="formcompte">
            <div class="title">
                <p><strong>Liste des Clients</strong></p>
                {{-- <a
                href="{{ route('Client.create') }}"><button style="margin-left: 55rem;height: 2.9rem;width: 10rem;" type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Ajouter client</button></a> --}}
                <button style="position: absolute; right:4.2rem;top: 3.7rem" type="button" onclick="linck()"
                class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Ajouter Client</button>
            </div>
            <div class="alltabs">
                <div class="tabs_1"> 
                    <table class="table table-bordered data-table table-striped table-hover" style="width: 100% !important;">
                        <thead class="tableheade">
                            <tr>
                                <th scope="col"><span>N°</span></th>
                                <th scope="col"><span>nom</span></th>
                                <th scope="col"><span>prenom<span></th>
                                <th scope="col"><span>date naissance</span></th>
                                <th scope="col"><span>sexe</span></th>
                                <th scope="col"><span>email</span></th>
                                <th scope="col"><span>telephone</span></th>
                                <th scope="col"><span>cni</span></th>
                                <th scope="col"><span>ville</span></th>
                                {{-- <th scope="col"><span>adress</span></th> --}}
                                <th scope="col"><span>Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        function linck(){
         window.location.href="{{ route('Client.create') }}";
        }
    </script>

    <script type="text/javascript">
    
        $(function() {
            var form = $('#clientmodal')[0];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $(".data-table").DataTable({
                severSide: true,
                processing: true,
                ajax: "{{ route('Client.index') }}",
                "bPaginate": true,
                "bInfo": true,
                "bFilter": true,
                "bAutoWidth": true,
                "aoColumns": [{
                        sWidth: '50px'
                    },
                    {
                        sWidth: '20px'
                    },
                    {
                        sWidth: '20px'
                    },
                    {
                        sWidth: '30px'
                    }
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'telephone',
                        name: 'telephone'
                    },
                    {
                        data: 'cni',
                        name: 'cni'
                    },
                    {
                        data: 'ville',
                        name: 'ville'
                    },
                    // {
                    //     data: 'adress',
                    //     name: 'adress'
                    // },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ]
            });


            $('body').on('click', '#close', function() {
                $('.errors').html('');
                $("#paymentmodal").trigger("reset");
                $('#payment_id').val('');
            }); 
            // Edition d'un client
            $('body').on('click', '#edite', function() {
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ url('client', '') }}' + '/' + id + '/edit',
                    method: 'GET',

                    success: function(response) {
                        $('#modaltitle').html('Edite client');
                        $('#client_id').val(response.id);
                        $('#nom').val(response.nom);
                        $('#prenom').val(response.prenom);
                        $('#date_naissance').val(response.date_naissance);
                        $('#sexe').val(response.sexe);
                        $('#email').val(response.email);
                        $('#telephone').val(response.telephone);
                        $('#cni').val(response.cni);
                        $('#ville').val(response.ville);
                        $('#adress').val(response.adress);
                        $('#client_modal').modal('show');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                }); 
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
                        table.ajax.reload();
                        $('#client_modal').modal('hide');
                        console.log(response);
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

            // Suppression d'un client
            $('body').on('click', '#delet', function() {
                var id = $(this).data("id");
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ url('client', '') }}' + '/' + id + '/delete',
                                method: 'DELETE',

                                success: function(response) {
                                    swal("Poof! Your imaginary file has been deleted!", {
                                        icon: "success",
                                    });
                                    table.ajax.reload();
                                    console.log(response);
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
            });

            //  Detaile du client
            $('body').on('click', '#detail', function name(params) {
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ url('client', '') }}' + '/' + id + '/toshow',
                    method: 'GET',

                    success: function(response) {
                        window.location.href = "{{ url('client') }}" + "/" + id + '/show';
                    },

                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
