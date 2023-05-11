@extends('layouts.dashboard')

@section('content')
    <div class="modal fade" data-bs-backdrop="static" id="carte_modal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modalhead">
                    <h1 class="modal-title fs-5" id="modaltitle">Modal title</h1>
                    {{-- <div class="note">
                        <p id="formtitle"><strong>Informations sur la carte</strong></p> 
                    </div> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-control modalform" id="carte_forme">
                        @csrf
                        <input type="hidden" name="carte_id" id="carte_id">
                        <div class="row tout">
                            <div class="col right">
                                <input type="number" name="numero_carte" id="numero_carte" class="form-control firstmodal"
                                    placeholder="numero de carte" min="0" aria-label="numero de carte">
                                <span style="margin-left: 1.5rem" id="numero_carte_error"
                                    class="text-danger errors"></span>
                                <input type="date" name="date_creation" id="date_creation" class="form-control firstmodal"
                                    placeholder="Select Date" aria-label="date_creation">
                                <span style="margin-left: 1.5rem" id="date_creation_error"
                                    class="text-danger errors"></span>
                                <select class="form-select firstmodal" style="margin-left: 0.5rem; margin-top: 1rem !important;" name="type" aria-label="Default select example">
                                    <option selected>Type de carte</option>
                                    <option value="carte electron">Carte electron</option>
                                    <option value="carte visa">Carte visa</option>
                                    <option value="master carte">Master carte</option>
                                </select>
                                <span style="margin-left: 1.5rem"  
                                    class="text-danger errors"></span>
                            </div>
                            <div class="col gauche">
                                <input type='number' name="codesecret" id="codesecret" class="form-control firstmodal"
                                    placeholder="code secret" min="0" aria-label="codesecret" />
                                <span style="margin-left: 1.5rem" id="codesecret_error"
                                    class="text-danger errors"></span>
                                <input type="date" name="date_expiration" id="date_expiration" class="form-control firstmodal"
                                    placeholder="Select Date" aria-label="date_expiration">
                                <span style="margin-left: 1.5rem" id="date_expiration_error"
                                    class="text-danger errors"></span>
                                <div  class="modalsex">
                                    <p style="padding: 0;margin: 0;">Status</p>
                                    <div class="form-check">
                                        <input class="form-check-input sexM" type="radio" name="statut" id="actif"
                                            value="1" checked>
                                        <label class="form-check-label" for="actif">
                                            Actif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input sexM" type="radio" name="statut" id="inactif"
                                            value="0">
                                        <label class="form-check-label" for="inactif">
                                            Inactif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="edit" class="btn btn-success">Edite</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-control">
        <div class="formcompte">
            <div class="title">
                <p><strong>Liste des cartes</strong></p>
                {{-- <a
                href="{{ route('carte.create') }}"><button style="margin-left: 55rem;height: 2.9rem;width: 10rem; floating: right;" type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Ajouter Carte</button></a> --}}
                <button style="position: absolute; right:4.2rem;top: 3.7rem" type="button" onclick="linck()"
                class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Ajouter Carte</button>
            </div>
            <div class="alltabs">
                <div class="tabs_1">
                    <table class="table table-bordered data-table table-striped table-hover">
                        <thead class="tableheade">
                            <tr>
                                <th scope="col"><span>N° </span></th>
                                <th scope="col"><span>N° Carte</span></th>
                                <th scope="col"><span>Numero compte</span></th>
                                <th scope="col"><span>Type de carte</span></th>
                                <th scope="col"><span>Date creation</span></th>
                                <th scope="col"><span>Date expiration</span></th>
                                <th scope="col"><span>Statut</span></th>
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
         window.location.href="{{ route('carte.create') }}";
        }
     </script>
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
                ajax: "{{ route('carte.list') }}",
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
                        data: 'numero_carte',
                        name: 'numero_carte'
                    },
                    {
                        data: 'compte',
                        name: 'compte'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'date_creation',
                        name: 'date_creation'
                    },
                    {
                        data: 'date_expiration',
                        name: 'date_expiration'
                    },
                    {
                        data: 'statut',
                        name: 'statut'
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
            // Edition d'une carte
            $('body').on('click', '#edite', function() {
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ url('carte-toedit', '') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        $('#modaltitle').html('Edite carte');
                        $('#formtitle').html('Edite carte');
                        $('#carte_modal').modal('show');
                        $('#carte_id').val(response.id);
                        $('#numero_carte').val(response.numero_carte);
                        $('#codesecret').val(response.codesecret);
                        $('#date_creation').val(response.date_creation);
                        $('#date_expiration').val(response.date_expiration);
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            });
            var form = $('#carte_forme')[0];
            $('body').on('click', '#edit', function() {
                $('.errors').html('');
                var formdata = new FormData(form);
                $.ajax({
                    url: '{{ route('carte.edit') }}',
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        table.ajax.reload();
                        $('#carte_modal').modal('hide');
                        $('.errors').html('');
                        console.log(response);
                    },
                    error: function(error) {
                        $('#numero_carte_error').html(error.responseJSON.errors
                            .numero_carte);
                        $('#date_creation_error').html(error.responseJSON.errors.date_creation);
                        $('#codesecret_error').html(error.responseJSON.errors.codesecret);
                        $('#date_expiration_error').html(error.responseJSON.errors.date_expiration);
                        console.log(error);
                    },
                });
            });

            // DELETE
            $('body').on('click', '#delet', function() {
                var id = $(this).data('id');
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
                                url: '{{ url('carte-delete') }}' + '/' + id,
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
            // show carte
            $('body').on('click', '#detail', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ url('carte-toshow') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        window.location.href = "{{ url('carte-show') }}" + "/" + id;
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
