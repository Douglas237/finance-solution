@extends('layouts.dashboard')

@section('content')
<div class="form-control">
    <div class="formcompte">
        <div class="title">
            <p><strong>Liste des Beneficiaires</strong></p>
            <a
                href="{{ route('clientben.tocreate') }}"><button style="margin-left: 55rem;height: 2.9rem;width: 10rem; floating: right;" type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Ajouter beneficiaire</button></a>
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
                            <th scope="col">Client</th>
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

});
</script>


@endsection
