@extends('layouts.dashboard')

@section('content')
<div class="modal fade" data-bs-backdrop="static" id="beneficiaire_modal" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modaltitle">Edition beneficiaire</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="form-control" id="beneficiaire_forme">
                @csrf
                <input type="hidden" name="beneficiaire_id" id="beneficiaire_id">
                <div class="note">
                    <p id="formtitle"><strong>Informations de l'entreprise</strong></p>
                </div>
                <div class="row tout">
                    <div class="col right">
                        <input type="text" name="nom_beneficiaire" id="nom_beneficiaire" class="form-control first"
                            placeholder="nom du beneficiaire" aria-label="nom du beneficiaire">
                        <input type="text" name="prenom" id="prenom" class="form-control first"
                            placeholder="prenom" aria-label="prenom">
                        <input type='text' name="cni" id="cni" class="form-control first"
                            placeholder="cni" aria-label="cni" />
                    </div>
                    <div class="col gauche">
                        <select class="form-select first" name="sexe" aria-label="Default select example">
                            <option selected>sexe</option>
                            <option value="male">Homme</option>
                            <option value="female">Femme</option>
                        </select>
                        <input type='number' name="telephone" id="telephone" class="form-control first"
                            placeholder="telephone" />
                        <div>

                        </div>
                        {{-- <div>
                            <p style="padding: 0;margin: 0;">Lier a une carte</p>
                            <div class="form-check">
                                <input class="form-check-input sex" type="radio" name="lier" id="oui"
                                    value="oui" checked>
                                <label class="form-check-label" for="oui">
                                    oui
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input sex" type="radio" name="lier" id="non"
                                    value="non">
                                <label class="form-check-label" for="non">
                                    non
                                </label>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="edition" class="btn btn-success">Edite</button>
        </div>
    </div>
</div>
</div>
<div class="form-control">
    <div class="formcompte">
        <div class="title">
            <p><strong>Liste des Beneficiaires</strong></p>
            <a
                href="{{ route('beneficiaire.create') }}"><button style="margin-left: 55rem;height: 2.9rem;width: 10rem; floating: right;" type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Ajouter beneficiaire</button></a>
        </div>
        <div class="alltabs">
            <div class="tabs_1">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">N° CNI</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">Entreprise</th>
                            <th scope="col">Sexe</th>
                            <th scope="col">Action</th>
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

$.ajaxSetup
({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var table = $(".data-table").DataTable
({
    severSide:true,
    processing:true,
        ajax:"{{route('beneficiaire.entreprise')}}",
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
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'nom_beneficiaire',
                name: 'nom_beneficiaire'
            },
            {
                data: 'prenom',
                name: 'prenom'
            },
            {
                data:'cni',
                name:'cni'
            },
            {
                data: 'telephone',
                name: 'telephone'
            },
            {
                data: 'entreprise',
                name: 'entreprise'
            },
            {
                data: 'sexe',
                name: 'sexe'
            },
            {
                data:'action',
                name:'action'
            },

      ]
});

                // Edition d'un beneficiaire
                $('body').on('click', '#edite', function() {
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ url('beneficiaire/edit', '') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        $('#modaltitle').html('Edite beneficiaire');
                        $('#formtitle').html('Edite beneficiaire');
                        $('#beneficiaire_modal').modal('show');
                        $('#beneficiaire_id').val(response.id);
                        $('#nom_beneficiaire').val(response.nom_beneficiaire);
                        $('#prenom').val(response.prenom);
                        $('#cni').val(response.cni);
                        $('#telephone').val(response.telephone);
                        $('#sexe').val(response.sexe);
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            });
            var form = $('#beneficiaire_forme')[0];
            $('body').on('click', '#edition', function() {
                var formdata = new FormData(form);
                $.ajax({
                    url: '{{ route('beneficiaire.edition') }}',
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        table.ajax.reload();
                        $('#beneficiaire_modal').modal('hide');
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
                                url: '{{ url('beneficiaire/delet') }}' + '/' + id,
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
                    url: '{{ url('beneficiaire/toshow') }}' + '/' + id,
                    method: 'GET',

                    success: function(response) {
                        window.location.href = "{{ url('beneficiaire/show') }}" + "/" + id;
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });


});
</script>


@endsection
