@extends('layouts.dashboard')

@section('content')

    <div class="modal fade" id="retrait_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaltitle">New message</h1>
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="retraitmodal" class="retraitmodal">
                        @csrf
                        {{-- <input type="hidden" id="transfert_id" name="transfert_id"> --}}
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Numero compte :</label>
                            <input type="text" name="num_compte" id="num_compte" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Montan a transferer:</label>
                            <input type="text" name="montant_retrait" id="montant_retrait" class="form-control" id="recipient-name">
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
            <p><strong>Nouveau retrait</strong></p>
            <button style="margin-right: 7rem;height: 3.5rem;" type="button" id="addretrait" class="btn btn-outline-success">Nouveau retrait</button>
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
                                <th scope="col">Montant de retrait</th>
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
                ajax: "{{ route('retrait') }}",
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

            
            $('body').on('click','#addretrait', function() {
                $('#retrait_modal').modal('show');
                $('#modaltitle').html('new retrait');
                $('#editer').html('Create');
            });
            $('body').on('click','#close', function() {
                $("#retraitmodal").trigger("reset");
                // $('#transfer_id').val('');
            });

            // cree et update
            var form = $('#retraitmodal')[0];
            $('body').on('click','#editer',function () {
                var formdata = new FormData(form);
                $.ajax({
                    url:'{{route("retrait.edit")}}',
                    method:'POST',
                    data:formdata,
                    processData:false,
                    contentType:false,

                    success:function(response){
                        table.ajax.reload();
                        $('#retrait_modal').modal('hide');
                        $("#retraitmodal").trigger("reset");
                        console.log(response);
                        
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
                    url:'{{url("retrait/delete",'')}}'+'/'+id,
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