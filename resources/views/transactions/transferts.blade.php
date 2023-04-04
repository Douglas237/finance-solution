@extends('layouts.dashboard')

@section('content')

    <div class="modal fade" id="transfert_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaltitle">New message</h1>
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="transfertmodal" class="transfertmodal">
                        @csrf
                        <input type="hidden" id="transfert_id" name="transfert_id">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero compte destinatair:</label>
                            <input type="text" name="compte_destinatair" id="compte_destinatair" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Montan a transferer:</label>
                            <input type="text" name="montant_transfert" id="montant_transfert" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero compte destinateur:</label>
                            <input type="text" name="compte_destinateur" id="compte_destinateur" class="form-control" id="recipient-name">
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
            <button style="margin-right: 7rem;height: 3.5rem;" type="button" id="addtransfert" class="btn btn-outline-success">Nouveau transfert</button>
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

            
            $('body').on('click','#addtransfert', function() {
                $('#transfert_modal').modal('show');
                $('#modaltitle').html('new transfert');
                $('#editer').html('Create');
            });
            $('body').on('click','#close', function() {
                $("#transfertmodal").trigger("reset");
                $('#transfer_id').val('');
            });

            // cree et update
            var form = $('#transfertmodal')[0];
            $('body').on('click','#editer',function () {
                var formdata = new FormData(form);
                $.ajax({
                    url:'{{route("transfert.edit")}}',
                    method:'POST',
                    data:formdata,
                    processData:false,
                    contentType:false,

                    success:function(response){
                        table.ajax.reload();
                        $('#transfert_modal').modal('hide');
                        $("#transfertmodal").trigger("reset");
                        console.log(response);
                        
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            });

            // edition d'un transfert
            $('body').on('click','#edite', function () {
                var id = $(this).data('id');
                $('#editer').html('edit');
                $.ajax({
                    url:'{{url("transfert/toedite",'')}}'+'/'+id,
                    method:'GET',

                    success:function (response) {
                        $('#modaltitle').html('Edite transfert');
                        $('#transfert_id').val(response.id);
                        $('#compte_destinatair').val(response.compte_destinatair);
                        $('#montant_transfert').val(response.montant_transfert);
                        $('#compte_destinateur').val(response.compte_destinateur);
                        $('#transfert_modal').modal('show');
                        console.log(response.id);
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            });

            // delete transfert
            $('body').on('click','#delet',function () {
               var id = $(this).data("id");
               $.ajax({
                    url:'{{url("transfert/delete",'')}}'+'/'+id,
                    method:'DELETE',

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
