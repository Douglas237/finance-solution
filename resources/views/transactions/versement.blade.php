@extends('layouts.dashboard')

@section('content')

    <div class="modal fade" id="payment_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaltitle">New message</h1>
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentmodal" class="paymentmodal">
                        @csrf
                        <input type="hidden" id="payment_id" name="payment_id">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nom du versant:</label>
                            <input type="text" name="nom_versant" id="nom_versant" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Prenom du versant:</label>
                            <input type="text" name="prenom_versant" id="prenom_versant" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero cni:</label>
                            <input type="text" name="num_cni" id="num_cni" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Montant:</label>
                            <input type="text" name="montant" id="montant" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero compte:</label>
                            <input type="text" name="num_compte" id="num_compte" class="form-control" id="recipient-name">
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
            <p><strong>Nouveau versement</strong></p>
            <button style="margin-right: 7rem;height: 3.5rem;" type="button" id="addpayment" class="btn btn-outline-success">new payment</button>
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

            $('body').on('click','#addpayment', function() {
                $('#payment_modal').modal('show');
                $('#modaltitle').html('new payment');
                $('#editer').html('Create');
            });
            $('body').on('click','#close', function() {
                $("#paymentmodal").trigger("reset");
                $('#payment_id').val('');
            });

            // cree et update
            var form = $('#paymentmodal')[0];
            $('body').on('click','#editer',function () {
                var formdata = new FormData(form);
                $.ajax({
                    url:'{{route("versement.edit")}}',
                    method:'POST',
                    data:formdata,
                    processData:false,
                    contentType:false,

                    success:function(response){
                        table.ajax.reload();
                        $('#payment_modal').modal('hide');
                        $("#paymentmodal").trigger("reset");
                        console.log(response);
                        
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            });

            // edition d'un client
            $('body').on('click','#edite', function () {
                var id = $(this).data('id');
                $('#editer').html('edit');
                $.ajax({
                    url:'{{url("versement/toedite",'')}}'+'/'+id,
                    method:'GET',

                    success:function (response) {
                        $('#modaltitle').html('Edite payment');
                        $('#payment_id').val(response.id);
                        $('#nom_versant').val(response.nom_versant);
                        $('#prenom_versant').val(response.prenom_versant);
                        $('#num_cni').val(response.num_cni);
                        $('#montant').val(response.montant);
                        $('#num_compte').val(response.num_compte);
                        $('#payment_modal').modal('show');
                        console.log(response.id);
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            });

            // delete payment
            $('body').on('click','#delet',function () {
               var id = $(this).data("id");
               $.ajax({
                    url:'{{url("payment/delete",'')}}'+'/'+id,
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
        });
          
    </script>
@endsection
