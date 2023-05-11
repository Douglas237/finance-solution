@extends('layouts.dashboard')

@section('content')
    <div class="modal fade" data-bs-backdrop="static" id="compte_modal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modalhead">
                    <h1 class="modal-title fs-5" id="modaltitle">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close" aria-label="Close"></button>
                </div>
                {{-- <div class="note">
                    <p id="formtitle"><strong>Informations du client</strong></p>
                </div> --}}
                <div class="modal-body"> 
                    <form class="form-control modalform" id="compte_forme">
                        @csrf
                        <input type="hidden" name="compte_id" id="compte_id">
                        <div class="row tout">
                            <div class="col right">
                                <input type="text" name="num" id="num" class="form-control firstmodal"
                                    placeholder="numero du compte" aria-label="numero du compte">
                                <select class="form-select first" name="nature" aria-label="Default select example">
                                    <option selected>Nature du compte</option>
                                    <option value="client">Client</option>
                                    <option value="entreprise">Entreprise</option>
                                </select>
                                <input type="text" name="solde" id="solde" class="form-control firstmodal"
                                    placeholder="solde" aria-label="solde">
                                <input type='text' name="code" id="code" class="form-control firstmodal"
                                    placeholder="code" aria-label="code" />
                            </div>
                            <div class="col gauche">
                                <select class="form-select firstmodal" name="type" aria-label="Default select example">
                                    <option selected>Type de compte</option>
                                    <option value="Compte courant">Compte courant</option>
                                    <option value="Compte epagne">Compte epagne</option>
                                </select>
                                <input type='date' name="date_ouverture" id="date_ouverture" class="form-control firstmodal"
                                    placeholder="Select Date" />
                                <div>
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
                                <div>
                                    <p style="padding: 0;margin: 0;">Lier a une carte</p>
                                    <div class="form-check">
                                        <input class="form-check-input sexM" type="radio" name="lier" id="oui"
                                            value="oui" checked>
                                        <label class="form-check-label" for="oui">
                                            oui
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input sexM" type="radio" name="lier" id="non"
                                            value="non">
                                        <label class="form-check-label" for="non">
                                            non
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="edition" class="btn btn-success">Edite</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-control">
        <div class="formcompte">
            <div class="title">
                <p><strong>Liste des comptes</strong></p>
                {{-- <a
                href="{{ route('compte_entreprise') }}"><button style="margin-left: 55rem;height: 2.9rem;width: 10rem; floating: right;" type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Ajouter compte</button></a> --}}
                <button style="position: absolute; right:4.2rem;top: 3.7rem" type="button" onclick="linck()"
                class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Ajouter compte</button> 
            </div>
            <div class="alltabs">
                <div class="tabs_1">
                    <table class="table table-bordered data-table table-striped table-hover">
                        <thead class="tableheade">
                            <tr>
                                <th scope="col"><span>N° </span></th>
                                <th scope="col"><span>N° compte</span></th>
                                <th scope="col"><span>Proprietaire</span></th>
                                <th scope="col"><span>Nom de l'entreprise</span></th>
                                <th scope="col"><span>Solde</span></th>
                                <th scope="col"><span>Type de compte</span></th>
                                <th scope="col"><span>Date ouverture</span></th>
                                <th scope="col"><span>Code</span></th>
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
         window.location.href="{{ route('compte_entreprise') }}";
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
                ajax: "{{ route('compte.entreprise') }}",
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
                        data: 'numero_compte',
                        name: 'num'
                    },
                    {
                        data: 'proprietaire',
                        name: 'proprietaire'
                    },
                    {
                        data: 'non_entreprise',
                        name: 'non_entreprise'
                    },
                    {
                        data: 'solde',
                        name: 'solde'
                    },
                    {
                        data: 'type_compte',
                        name: 'type'
                    },
                    {
                        data: 'date_ouverture',
                        name: 'date_ouverture'
                    },
                    {
                        data: 'code',
                        name: 'code'
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
            // Edition d'un compte
            $('body').on('click', '#edite', function() {
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ url('compte/edite', '') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        $('#modaltitle').html('Edite compte');
                        $('#formtitle').html('Edite compte');
                        $('#compte_modal').modal('show');
                        $('#compte_id').val(response.id);
                        $('#num').val(response.numero_compte);
                        $('#solde').val(response.solde);
                        $('#code').val(response.code);
                        $('#date_ouverture').val(response.date_ouverture);
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            });
            var form = $('#compte_forme')[0];
            $('body').on('click', '#edition', function() {
                var formdata = new FormData(form);
                $.ajax({
                    url: '{{ route('charger') }}',
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        table.ajax.reload();
                        $('#compte_modal').modal('hide');
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            });

            // DELETE
            $('body').on('click', '#delete', function() {
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
                                url: '{{ url('delcompte/delet') }}' + '/' + id,
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
            // show account
            $('body').on('click', '#detail', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ url('detcompte/toshow') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        window.location.href = "{{ url('detcompte/show') }}" + "/" + id;
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
