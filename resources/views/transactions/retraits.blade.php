@extends('layouts.dashboard')

@section('content')
    <!-- Modal Clients-->
    <div class="modal fade" id="confirm_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmtitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="nom"> Nom : <span id="nom"></span></p>
                    <p class="prenom">Prenom : <span id="prenom"></span></p>
                    <p class="email">Email : <span id="email"></span></p>
                    <p class="date_naissance"> Date de naissance : <span id="date_naissance"></span></p>
                    <p class="telephone"> Telephone : <span id="telephone"></span></p>
                    <p class="ville">Ville : <span id="ville"></span></p>
                    <p class="adress">Adress : <span id="adress"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirm">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    {{-- pour les entreprises --}}
    <div class="modal fade" id="confirm_modal_entreprise" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmtitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="nom_entreprise"> Nom de l'entreprise : <span id="nom_entreprise"></span></p>
                    <p class="nom_respon">Nom du proprietaire : <span id="nom_respon"></span></p>
                    <p class="type_entreprise">Type d'entreprise : <span id="type_entreprise"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirm">Confirmer</button>
                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="retrait_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaltitle">New message</h1>
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="retraitmodal" class="retraitmodal">
                        @csrf
                        {{-- <input type="hidden" id="transfert_id" name="transfert_id"> --}}
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero compte :</label>
                            <input type="text" name="num_compte" id="num_compte" class="form-control">
                            <span id="num_compte_error" class="text-danger error_message"></span>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Montan a retirer:</label>
                            <input type="number" min="0" name="montant_retrait" id="montant_retrait" class="form-control">
                            <span id="montant_retrait_error" class="text-danger error_message"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="editer" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-control">
        <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
            <p><strong>Nouveau retrait</strong></p>
            <button style="margin-right: 7rem;height: 3.5rem;" type="button" id="addretrait"
                class="btn btn-outline-success">Nouveau retrait</button>
        </div>
        <div class="formcompte">
            <div class="title">
                <p><strong>Liste des retrait</strong></p>
            </div>
            <div class="alltabs">
                <div class="tabs_1">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th scope="col">N° </th>
                                <th scope="col">N° du compte</th>
                                <th scope="col">Proprietaire</th>
                                <th scope="col">Montant retirer</th>
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
            var form = $('#retraitmodal')[0];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $(".data-table").DataTable({
                severSide: true,
                processing: true,
                ajax: "{{ route('retrait') }}",
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
                        data: 'num_compte',
                        name: 'num_compte'
                    },
                    {
                        data: 'Proprietaire',
                        name: 'Proprietaire'
                    },
                    {
                        data: 'montant_retrait',
                        name: 'montant_retrait'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }

                ]
            });


            $('body').on('click', '#addretrait', function() {
                $('.error_message').html('');
                $("#retraitmodal").trigger("reset");
                $('#retrait_modal').modal('show');
                $('#modaltitle').html('new retrait');
                $('#editer').html('Create');
            });
            $('body').on('click', '#close', function() {
                $("#retraitmodal").trigger("reset");
                // $('#transfer_id').val('');
            });

            // cree et update
            $('body').on('click', '#confirm', function() {
                $('.error_message').html('');
                var formdata = new FormData(form);
                swal({
                        title: "Confirmez vous le retrai ?",
                        icon: "warning",
                        buttons: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ route('retrait.edit') }}',
                                method: 'POST',
                                data: formdata,
                                processData: false,
                                contentType: false,

                                success: function(response) {
                                    table.ajax.reload();
                                    $('#retrait_modal').modal('hide');
                                    swal({
                                        title: "Retrait effectuer avec succes",
                                        icon: "success",
                                    });

                                    $('.error_message').html('');
                                    $("#retraitmodal").trigger("reset");
                                    $('#confirm_modal').modal('hide');
                                    $('#confirm_modal_entreprise').modal('hide');
                                    console.log(response);

                                },
                                error: function(error) {
                                    console.log(error);
                                    if (error.status == 404) {
                                        swal({
                                            title: "Le solde de ce compte est insuffisant pour ce retrait",
                                        });
                                        $('#retrait_modal').modal('show');
                                        $('#confirm_modal').modal('hide');
                                        $('#confirm_modal_entreprise').modal('hide');
                                    }
                                    if (error.status == 405)
                                    {
                                        swal({
                                            title: "Ce compte n'existe pas",
                                        });
                                    }

                                    $('#num_compte_error').html(error.responseJSON.errors.num_compte);
                                    $('#montant_retrait_error').html(error.responseJSON.errors.montant_retrait);
                                    // if (error.status == 405) {
                                    //     swal({
                                    //         title: "Ce compte n'existe pas",
                                    //     });
                                    // }

                                    // $('#num_compte_error').html(error.responseJSON.errors
                                    //     .num_compte);
                                    // $('#montant_retrait_error').html(error.responseJSON
                                    //     .errors.montant_retrait);
                                }
                            });
                        } else {
                            swal({
                                title: "Retrait annuler",
                            });
                        }
                    });
            });

            $('body').on('click', '#editer', function() {
                $('.error_message').html('');
                var formdata = new FormData(form);
                $.ajax({
                    url: '{{ route('retrait.client') }}',
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        if (response.comptebankable_type == "App\\Models\\Client") {
                            $('#confirmtitle').html('information du receveur');
                            $('#nom').html(response.nom);
                            $('#prenom').html(response.prenom);
                            $('#email').html(response.email);
                            $('#date_naissance').html(response.date_naissance);
                            $('#telephone').html(response.telephone);
                            $('#ville').html(response.ville);
                            $('#adress').html(response.adress);
                            $('#retrait_modal').modal('hide');
                            $('#confirm_modal').modal('show');
                            console.log(response);
                        } else {
                            $('#confirmtitle').html('information du receveur');
                            $('#nom_entreprise').html(response.nom_entreprise);
                            $('#nom_respon').html(response.nom_respon);
                            $('#type_entreprise').html(response.type_entreprise);
                            $('#retrait_modal').modal('hide');
                            $('#confirm_modal_entreprise').modal('show');
                            console.log(response);
                        }

                    },
                    error: function(error) {
                        if (error.status == 405) {
                            swal({
                                title: "Le compte a debiter n'existe pas",
                            });
                        }

                        $('#num_compte_error').html(error.responseJSON.errors.num_compte);
                        $('#montant_retrait_error').html(error.responseJSON.errors.montant_retrait);

                        console.log(error);
                    }
                });

            });

            // delete retrai
            $('body').on('click', '#delet', function() {
                var id = $(this).data("id");

                swal({
                        title: "Confirmez vous la suppression?",
                        text: "La donner sera perdu pour toujour",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ url('retrait/delete', '') }}' + '/' + id,
                                method: 'DELETE',

                                success: function(response) {
                                    swal({
                                        title: "Donnee supprimer avec succes",
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
                            swal({
                                title: "Suppression annuler",
                            });
                        }
                    });


            });

        });
    </script>
@endsection
