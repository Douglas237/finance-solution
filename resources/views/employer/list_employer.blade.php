@extends('layouts.dashboard')

@section('content')
    <div class="modal fade" data-bs-backdrop="static" id="employer_modal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modalhead">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="employermodal" class="form-control modalform" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="employer_id" name="employer_id">
                        <div class="row tout">
                            <div class="col right">
                                <input type="text" name="nom" id="nom" class="form-control firstmodal"
                                    placeholder="nom" aria-label="nom" required>
                                <span style="margin-left: 1.5rem" id="nom_em_error" class="text-danger errors"></span>
                                <input type="text" name="prenom" id="prenom" class="form-control firstmodal"
                                    placeholder="prenom" aria-label="prenom" required>
                                <span style="margin-left: 1.5rem" id="prenom_em_error" class="text-danger errors"></span>
                                <input type='date' name="date_naissance" id="date_naissance" class="form-control firstmodal" placeholder="Select Date" />
                                <span style="margin-left: 1.5rem" id="date_naissance_em_error" class="text-danger errors"></span>
                                <input type="email" name="email" id="email" class="form-control firstmodal"
                                    placeholder="email" aria-label="email" required>
                                <span style="margin-left: 1.5rem" id="email_em_error" class="text-danger errors"></span>
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
                                        <input class="form-check-input sexM" type="radio" value="femmel" name="sexe"
                                            id="femelle" checked>
                                        <label class="form-check-label" for="femelle">
                                            Femme
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col gauche">
                                <input type="text" name="poste" id="poste" class="form-control firstmodal"
                                    placeholder="poste" aria-label="poste" required>
                                <span style="margin-left: 1.5rem" id="poste_em_error" class="text-danger errors"></span>
                                <input type="text" name="telephone" id="telephone" class="form-control firstmodal"
                                    placeholder="telephone" aria-label="telephone" required>
                                <span style="margin-left: 1.5rem" id="telephone_em_error" class="text-danger errors"></span>
                                <input type="text" name="cni" id="cni" class="form-control firstmodal"
                                    placeholder="num_cni" aria-label="num_cni" required>
                                <span style="margin-left: 1.5rem" id="cni_em_error" class="text-danger errors"></span>
                                <input type="password" name="password" id="password" class="form-control firstmodal"
                                    placeholder="password" aria-label="password" required>
                                <span style="margin-left: 1.5rem" id="password_em_error" class="text-danger errors"></span>
                                <input type="file" name="image" id="image" class="form-control firstmodal"
                                    aria-label="file example" >
                                <span style="margin-left: 1.5rem" id="image_em_error" class="text-danger errors"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="editer" class="btn btn-primary">Edite</button>
                </div>
            </div>
        </div>
    </div>

    <div class="form-control">
        <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
            {{-- <p><strong>Nouveau employer</strong></p> --}}
            <button style="margin-right: 7rem;position: absolute; 
            right: -5.2rem;
            top: 3.6rem;" type="button" id="addemployer"
                class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Nouveau employer</button>
        </div>
        <div class="formcompte">
            <div class="title">
                <p><strong>Liste des employer</strong></p>
            </div>
            <div class="alltabs">
                <div class="tabs_1">
                    <table class="table table-bordered data-table table-striped table-hover" style="width: 100% !important;">
                        <thead class="tableheade">
                            <tr>
                                <th scope="col"><span>N° </span></th>
                                <th scope="col"><span>nom</span></th>
                                <th scope="col"><span>prenom</span></th>
                                <th scope="col"><span>date naissance</span></th>
                                <th scope="col"><span>sexe</span></th>
                                <th scope="col"><span>cni</span></th>
                                <th scope="col"><span>email</span></th>
                                <th scope="col"><span>telephone</span></th>
                                <th scope="col"><span>Poste</span></th>
                                {{-- <th scope="col"><span>Password</span></th> --}}
                                <th scope="col"><span>image</span></th>
                                <th scope="col"><span>Action</span></th>
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
                "aoColumns": [{
                        sWidth: '50px'
                    },
                    {
                        sWidth: '100px'
                    },
                    {
                        sWidth: '120px'
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
                    // {
                    //     data: 'password',
                    //     name: 'password'
                    // },
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
            $('body').on('click', '#addemployer', function() {
                $('.errors').html('');
                $('#employer_modal').modal('show');
                $('#modaltitle').html('new employer');
                $('#editer').html('Create');
            });
            $('body').on('click', '#close', function() {
                $('.errors').html('');
                $("#employermodal").trigger("reset");
                $('#employer_id').val('');
            });

            // edition d'un client
            $('body').on('click', '#edite', function() {
                var id = $(this).data('id');
                $('#editer').html('edit');
                $.ajax({
                    url: '{{ url('employer/toedite', '') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
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
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // $('body').on('click','#editer',function () {

            $('body').on('click', '#editer', function() {
                $('.errors').html('');
                var formdata = new FormData(form);
                $.ajax({
                    url: '{{ route('employer.edite') }}',
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        table.ajax.reload();
                        $('#employer_modal').modal('hide');
                        $("#employermodal").trigger("reset");
                        console.log(response);
                        setTimeout(() => {
                        toastr.success(response.message, response.title);
                        },500);

                    },
                    error: function(error) {
                        $('#nom_em_error').html(error.responseJSON.errors.nom);
                        $('#email_em_error').html(error.responseJSON.errors.email);
                        $('#poste_em_error').html(error.responseJSON.errors.poste);
                        $('#date_naissance_em_error').html(error.responseJSON.errors.date_naissance);
                        $('#prenom_em_error').html(error.responseJSON.errors.prenom);
                        $('#telephone_em_error').html(error.responseJSON.errors.telephone);
                        $('#cni_em_error').html(error.responseJSON.errors.cni);
                        $('#password_em_error').html(error.responseJSON.errors.password);
                        $('#image_em_error').html(error.responseJSON.errors.image);
                        console.log(error);
                    }
                });
            });

            // delete an employer
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
                                url: '{{ url('employer/delete', '') }}' + '/' + id,
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

            // detail employer

            $('body').on('click', '#detail', function name(params) {
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ url('employer/toshow', '') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        window.location.href = "{{ url('employer/show') }}" + "/" + id;
                    },

                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
