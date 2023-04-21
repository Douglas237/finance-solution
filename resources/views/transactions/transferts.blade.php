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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close" aria-label="Close"></button>
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



    <div class="modal fade" id="transfert_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaltitle">New message</h1>
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="transfertmodal" class="transfertmodal">
                        @csrf
                        <input type="hidden" id="transfert_id" name="transfert_id">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero compte destinatair:</label>
                            <input type="number" name="compte_destinatair" id="compte_destinatair" class="form-control">
                            <span id="compte_destinatair_error" class="text-danger error_message"></span>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Montan a transferer:</label>
                            <input type="number" name="montant_transfert" id="montant_transfert" class="form-control">
                            <span id="montant_transfert_error" class="text-danger error_message"></span>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero compte destinateur:</label>
                            <input type="number" name="compte_destinateur" id="compte_destinateur" class="form-control">
                            <span id="compte_destinateur_error" class="text-danger error_message"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="editer" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-control">
        <div class="title" style="display: flex;flex-direction: row;justify-content: space-between">
            <p><strong>Nouveau transfert</strong></p>
            <button style="margin-right: 7rem;height: 3.5rem;" type="button" id="addtransfert"
                class="btn btn-outline-success">Nouveau transfert</button>
        </div>
        <div class="formcompte">
            <div class="title">
                <p><strong>Liste des transfert</strong></p>
            </div>
            <div class="alltabs">
                <div class="tabs_1">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th scope="col">N° </th>
                                I<th scope="col">N° du compte destinatair</th>
                                <th scope="col">Nom du destinatair</th>
                                <th scope="col">Montant de transfert</th>
                                I<th scope="col">N° du compte destinateur</th>
                                I<th scope="col">nom du destinateur</th>
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
            var form = $('#transfertmodal')[0];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $(".data-table").DataTable({
                severSide: true,
                processing: true,
                ajax: "{{ route('transfert') }}",
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
                        data: 'compte_destinatair',
                        name: 'compte_destinatair'
                    },
                    {
                        data: 'nom_destinatair',
                        name: 'nom_destinatair'
                    },
                    {
                        data: 'montant_transfert',
                        name: 'montant_transfert'
                    },
                    {
                        data: 'compte_destinateur',
                        name: 'compte_destinateur'
                    },
                    {
                        data: 'nom_destinateur',
                        name: 'nom_destinateur'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }

                ]
            });


            $('body').on('click', '#addtransfert', function() {
                $('#transfert_id').val('');
                $('.error_message').html('');
                $('#transfert_modal').modal('show');
                $('#modaltitle').html('new transfert');
                $('#editer').html('Create');
            });
            $('body').on('click', '#close', function() {
                $("#transfertmodal").trigger("reset");
                $('#transfert_id').val('');
                $('.error_message').html('');
            });

            // cree et update
            $('body').on('click', '#confirm', function() {
                $('.error_message').html('');
                var formdata = new FormData(form);
                swal({
                        title: "Confirmez vous ce transfert ??",
                        icon: "warning",
                        buttons: true,
                        // dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ route('transfert.edit') }}',
                                method: 'POST',
                                data: formdata,
                                processData: false,
                                contentType: false,

                                success: function(response) {
                                    table.ajax.reload();
                                    $('#transfert_modal').modal('hide');
                                    swal("Transfert realiser avec succes", {
                                        icon: "success",
                                    });
                                    $("#transfertmodal").trigger("reset");
                                    $('#confirm_modal').modal('hide');
                                    $('#confirm_modal_entreprise').modal('hide');
                                    $('.error_message').html('');
                                    console.log(response);
                                },
                                error: function(error) {
                                    if (error.status == 404) {
                                        swal({
                                            title: "Le solde du destinatair est insuffisant",
                                        });
                                        $('#transfert_modal').modal('show');
                                        $('#confirm_modal').modal('hide');
                                        $('#confirm_modal_entreprise').modal('hide');
                                    }
                                    if (error.status == 405)
                                    {
                                        swal({
                                            title: "Le compte du destinateur n'existe pas",
                                        });
                                        // $('#transfert_modal').modal('show');
                                        // $('#confirm_modal').modal('hide');
                                    }
                                    if (error.status == 406)
                                    {
                                        swal({
                                            title: "Le compte du destinatair n'existe pas",
                                        });

                                    }

                                    // $('#compte_destinatair_error').html(error.responseJSON.errors.compte_destinatair);
                                    // $('#compte_destinateur_error').html(error.responseJSON.errors.compte_destinateur);
                                    // $('#montant_transfert_error').html(error.responseJSON.errors.montant_transfert);

                                    console.log(error);
                                }
                            });
                        } else {
                            swal({
                                title: "Transfert annuler",
                            });
                        }
                    });
            });


            $('body').on('click', '#editer', function() {
                $('.error_message').html('');
                var formdata = new FormData(form);
                $.ajax({
                    url: '{{ route('transfert.client') }}',
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
                            $('#transfert_modal').modal('hide');
                            $('#confirm_modal').modal('show');
                            console.log(response);
                        }
                        else{
                            $('#confirmtitle').html('information du receveur');
                            $('#nom_entreprise').html(response.nom_entreprise);
                            $('#nom_respon').html(response.nom_respon);
                            $('#type_entreprise').html(response.type_entreprise);
                            $('#transfert_modal').modal('hide');
                            $('#confirm_modal_entreprise').modal('show');
                            console.log(response);
                        }

                    },
                    error: function(error) {
                        if (error.status == 405) {
                            swal({
                                title: "Le compte du destinateur n'existe pas",
                            });
                        }
                        if (error.status == 406)
                        {
                            swal({
                                title: "Le compte du destinatair n'existe pas",
                            });
                        }

                        $('#compte_destinatair_error').html(error.responseJSON.errors.compte_destinatair);
                        $('#compte_destinateur_error').html(error.responseJSON.errors.compte_destinateur);
                        $('#montant_transfert_error').html(error.responseJSON.errors.montant_transfert);

                        console.log(error);
                    }
                });

            });


            // edition d'un transfert
            $('body').on('click', '#edite', function() {
                var id = $(this).data('id');
                $('#editer').html('edit');
                $.ajax({
                    url: '{{ url('transfert/toedite', '') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        $('#modaltitle').html('Edite transfert');
                        $('#transfert_id').val(response.id);
                        $('#compte_destinatair').val(response.compte_destinatair);
                        $('#montant_transfert').val(response.montant_transfert);
                        $('#compte_destinateur').val(response.compte_destinateur);
                        $('#transfert_modal').modal('show');
                        console.log(response.id);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // delete transfert
            $('body').on('click', '#delet', function() {
                var id = $(this).data("id");
                swal({
                        title: "Confirmez vous la suppression ?",
                        text: "La donner sera perdu pour toujour!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ url('transfert/delete', '') }}' + '/' + id,
                                method: 'DELETE',

                                success: function(response) {
                                    swal("Donnee supprimer avec succes!", {
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
