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



    <div class="modal fade" id="payment_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaltitle">New message</h1>
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentmodal" class="paymentmodal">
                        @csrf
                        <input type="hidden" id="payment_id" name="payment_id">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nom du versant:</label>
                            <input type="text" name="nom_versant" id="nom_versant" class="form-control"
                                id="recipient-name">
                            <span id="nom_versant_error" class="text-danger error_message"></span>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Prenom du versant:</label>
                            <input type="text" name="prenom_versant" id="prenom_versant" class="form-control"
                                id="recipient-name">
                            <span id="prenom_versant_error" class="text-danger error_message"></span>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero cni:</label>
                            <input type="text" name="num_cni" id="num_cni" class="form-control" id="recipient-name">
                            <span id="num_cni_error" class="text-danger error_message"></span>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Montant:</label>
                            <input type="text" name="montant" id="montant" class="form-control" id="recipient-name">
                            <span id="montant_error" class="text-danger error_message"></span>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero compte:</label>
                            <input type="text" name="num_compte" id="num_compte" class="form-control"
                                id="recipient-name">
                            <span id="num_compte_error" class="text-danger error_message"></span>
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
            <p><strong>Nouveau versement</strong></p>
            <button style="margin-right: 7rem;height: 3.5rem;" type="button" id="addpayment"
                class="btn btn-outline-success">new payment</button>
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
                                <th scope="col">Nom du versant</th>
                                <th scope="col">Prenom du versant</th>
                                <th scope="col">N° cni</th>
                                <th scope="col">montant</th>
                                I<th scope="col">N° du compte</th>
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
            var table = $(".data-table").DataTable({
                severSide: true,
                processing: true,
                ajax: "{{ route('versements') }}",
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
                        data: 'nom_versant',
                        name: 'nom_versant'
                    },
                    {
                        data: 'prenom_versant',
                        name: 'prenom_versant'
                    },
                    {
                        data: 'num_cni',
                        name: 'num_cni'
                    },
                    {
                        data: 'montant',
                        name: 'montant'
                    },
                    {
                        data: 'num_compte',
                        name: 'num_compte'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }

                ]
            });

            $('body').on('click', '#addpayment', function() {
                $('.error_message').html('');
                $("#paymentmodal").trigger("reset");
                $('#payment_modal').modal('show');
                $('#modaltitle').html('new payment');
                $('#editer').html('Create');
            });
            $('body').on('click', '#close', function() {
                $('.error_message').html('');
                $("#paymentmodal").trigger("reset");
                $('#payment_id').val('');
            });

            // cree et update
            var form = $('#paymentmodal')[0];
            $('body').on('click', '#confirm', function() {
                $('.error_message').html('');
                var formdata = new FormData(form);
                swal({
                        title: "Confirmez vous ce depot ?",
                        icon: "warning",
                        buttons: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ route('versement.edit') }}',
                                method: 'POST',
                                data: formdata,
                                processData: false,
                                contentType: false,

                                success: function(response) {
                                    swal("Depot effectuer avec succes", {
                                        icon: "success",
                                    });
                                    table.ajax.reload();
                                    $('#payment_modal').modal('hide');
                                    $('#confirm_modal').modal('hide');
                                    $('#confirm_modal_entreprise').modal('hide');
                                    $("#paymentmodal").trigger("reset");
                                    $('.error_message').html('');
                                    console.log(response);

                                },
                                error: function(error) {
                                    if (error.status == 405) {
                                        swal({
                                            title: "Le compte du destinateur n'existe pas",
                                        });
                                    }
                                    console.log(error);
                                }
                            });
                        } else {
                            swal("Depot annuler");
                        }
                    });
            });
            $('body').on('click', '#editer', function() {
                $('.error_message').html('');
                var formdata = new FormData(form);
                $.ajax({
                    url: '{{ route('versement.client') }}',
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
                            $('#payment_modal').modal('hide');
                            $('#confirm_modal').modal('show');
                            console.log(response);
                        }
                        else{
                            $('#confirmtitle').html('information du receveur');
                            $('#nom_entreprise').html(response.nom_entreprise);
                            $('#nom_respon').html(response.nom_respon);
                            $('#type_entreprise').html(response.type_entreprise);
                            $('#payment_modal').modal('hide');
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

                        $('#nom_versant_error').html(error.responseJSON.errors.nom_versant);
                        $('#prenom_versant_error').html(error.responseJSON.errors.prenom_versant);
                        $('#num_cni_error').html(error.responseJSON.errors.num_cni);
                        $('#montant_error').html(error.responseJSON.errors.montant);
                        $('#num_compte_error').html(error.responseJSON.errors.num_compte);

                        console.log(error);
                    }
                });

            });


            // delete payment
            $('body').on('click', '#delet', function() {
                var id = $(this).data("id");

                swal({
                        title: "Confirmez vous la suppression ?",
                        text: "La donner sera perdu pour toujour!!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ url('payment/delete', '') }}' + '/' + id,
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
