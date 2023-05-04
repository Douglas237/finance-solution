@extends('layouts.dashboard')

@section('content')
    <div class="modal fade" data-bs-backdrop="static" id="entrprise_modal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modalhead">
                    <h1 class="modal-title fs-5" id="modaltitle">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-control modalform" id="entrepriseforme" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="entreprise_id" id="entreprise_id"> 
                        <div class="row tout">
                            <div class="col right">
                                <input type="text" name="nom_entreprise" id="nom_entreprise" class="form-control firstmodal"
                                    placeholder="nom de l'entreprise" aria-label="nom de l'entreprise">
                                <span style="margin-left: 1.5rem" id="nom_entreprise_error" class="text-danger errors"></span>
                                <input type="text" name="type_entreprise" id="type_entreprise" class="form-control firstmodal"
                                    placeholder="type entreprise" aria-label="type entreprise">
                                <span style="margin-left: 1.5rem" id="type_entreprise_error" class="text-danger errors"></span>
                                <input type="file" name="image" id="image" class="form-control firstmodal"
                                    aria-label="file example" required>
                                <span style="margin-left: 1.5rem" id="image_error" class="text-danger errors"></span>
                            </div>
                            <div class="col gauche">
                                <input type="text" name="nom_respon" id="nom_respon" class="form-control firstmodal"
                                    placeholder="nom du responssable" aria-label="nom du responssable">
                                <span style="margin-left: 1.5rem" id="nom_respon_error" class="text-danger errors"></span>
                                <input type="text" name="cni_respon" id="cni_respon" class="form-control firstmodal"
                                    placeholder="numero cni du responssable" aria-label="type entreprise">
                                <span style="margin-left: 1.5rem" id="cni_respon_error" class="text-danger errors"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="editer" class="btn btn-primary">Edite</button>
                </div>
            </div>
        </div>
    </div>

    <div class="form-control">
        <div class="formcompte">
            <div class="title">
                <p><strong>Liste des entreprises</strong></p>
                <a
                href="{{ route('entreprise') }}"><button style="margin-left: 55rem;height: 2.9rem;width: 10rem; floating: right;" type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Ajouter Entreprise</button></a>
            </div>
            <div class="alltabs">
                <div class="tabs_1">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th scope="col">N° </th>
                                <th scope="col">Nom</th>
                                <th scope="col">Responssable</th>
                                <th scope="col">Type d'entreprise</th>
                                <th scope="col">Cni responssable</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
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
        $(function() {
            var form = $('#entrepriseforme')[0];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $(".data-table").DataTable({
                severSide: true,
                processing: true,
                ajax: "{{ route('entreprise.list') }}",
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
                        data: 'nom_entreprise',
                        name: 'nom_entreprise'
                    },
                    {
                        data: 'nom_respon',
                        name: 'nom_respon'
                    },
                    {
                        data: 'type_entreprise',
                        name: 'type_entreprise'
                    },
                    {
                        data: 'cni_respon',
                        name: 'cni_respon'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
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
            // edit entreprise
            $('body').on('click', '#edite', function() {
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ url('entreprise/toedit', '') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        $('#modaltitle').html('Edite entreprise');
                        $('#entreprise_id').val(response.id);
                        $('#nom_entreprise').val(response.nom_entreprise);
                        $('#nom_respon').val(response.nom_respon);
                        $('#type_entreprise').val(response.type_entreprise);
                        $('#cni_respon').val(response.cni_respon);
                        $('#entrprise_modal').modal('show');
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
            $('body').on('click', '#editer', function() {
                $('.errors').html('');
                var formdata = new FormData(form);
                $.ajax({
                    url: '{{ route('entreprise.edit') }}',
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        table.ajax.reload();
                        $('#entrprise_modal').modal('hide');
                        $('.errors').html('');
                        swal("Entreprise editer avec succes", {
                            icon: "success",
                        });
                        console.log(response);
                    },
                    error: function(error) {
                        $('#nom_entreprise_error').html(error.responseJSON.errors.nom_entreprise);
                        $('#type_entreprise_error').html(error.responseJSON.errors.type_entreprise);
                        $('#image_error').html(error.responseJSON.errors.image);
                        $('#nom_respon_error').html(error.responseJSON.errors.nom_respon);
                        $('#cni_respon_error').html(error.responseJSON.errors.cni_respon);
                        console.log(error);
                    }
                });
            });
            // delet entreprise
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
                                url: '{{ url('entreprise/delet', '') }}' + '/' + id,
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

            // show entreprise
            $('body').on('click', '#detail', function name(params) {
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ url('entreprise/toshow', '') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        window.location.href = "{{ url('entreprise/show') }}" + "/" + id;
                    },

                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
