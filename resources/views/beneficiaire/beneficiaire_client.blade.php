@extends('layouts.dashboard')

@section('content')
<div class="modal fade" data-bs-backdrop="static" id="beneficiaire_modal" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header modalhead">
            <h1 class="modal-title fs-5" id="modaltitle">Edition beneficiaire</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" id="close" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="form-control modalform" id="beneficiaire_forme">
                @csrf
                <input type="hidden" name="beneficiaire_id" id="beneficiaire_id"> 
                <div class="row tout">
                    <div class="col right">
                        <input type="text" name="nom_beneficiaire" id="nom_beneficiaire" class="form-control firstmodal"
                            placeholder="nom du beneficiaire" aria-label="nom du beneficiaire">
                        <span style="margin-left: 1.5rem" id="nom_beneficiaire_error" class="text-danger errors"></span>
                        <input type="text" name="prenom" id="prenom" class="form-control firstmodal"
                            placeholder="prenom" aria-label="prenom">
                        <span style="margin-left: 1.5rem" id="prenom_error" class="text-danger errors"></span>
                        <input type='text' name="cni" id="cni" class="form-control firstmodal"
                            placeholder="cni" aria-label="cni" />
                        <span style="margin-left: 1.5rem" id="cni_error" class="text-danger errors"></span>
                    </div>
                    <div class="col gauche">
                        <select style="margin-left: 0.5rem; margin-bottom: 2rem;" class="form-select firstmodal" name="sexe" id="sexe" aria-label="Default select example">
                            <option selected>sexe</option>
                            <option value="male">Homme</option>
                            <option value="femmel">Femme</option>
                        </select>
                        <input type='text' style="margin-top: 4.05rem !important;" name="telephone" id="telephone" class="form-control firstmodal"
                            placeholder="telephone" />
                        <span style="margin-left: 1.5rem" id="telephone_error" class="text-danger errors"></span>
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
            <p><strong>Liste des Beneficiaires pour les clients</strong></p>
            {{-- <a
                href="{{ route('clientben.tocreate') }}"><button style="margin-left: 55rem;height: 2.9rem;width: 10rem; floating: right;" type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Ajouter beneficiaire</button></a> --}}
                <button style="position: absolute; right:4.2rem;top: 3.7rem" type="button" onclick="linck()"
                class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Ajouter beneficiaire</button>
        </div>
        <div class="alltabs">
            <div class="tabs_1">
                <table class="table table-bordered data-table table-striped table-hover">
                    <thead class="tableheade">
                        <tr>
                            <th scope="col"><span>N°</span></th>
                            <th scope="col"><span>Nom</span></th>
                            <th scope="col"><span>Prenom</span></th>
                            <th scope="col"><span>N° CNI</span></th>
                            <th scope="col"><span>Telephone</span></th>
                            <th scope="col"><span>Client</span></th>
                            <th scope="col"><span>Sexe</span></th>
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
     window.location.href="{{ route('clientben.tocreate') }}";
    }
 </script>
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
        ajax:"{{route('beneficiaire.client')}}",
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
                data: 'client',
                name: 'client'
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


            $('body').on('click', '#close', function() {
                $('.errors').html('');
                $("#paymentmodal").trigger("reset");
                $('#payment_id').val('');
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
                $('.errors').html('');
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
                        $('.errors').html('');
                        console.log(response);
                    },
                    error: function(error) {
                        $('#nom_beneficiaire_error').html(error.responseJSON.errors
                            .nom_beneficiaire);
                        $('#prenom_error').html(error.responseJSON.errors.prenom);
                        $('#cni_error').html(error.responseJSON.errors.cni);
                        $('#telephone_error').html(error.responseJSON.errors.telephone);
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
