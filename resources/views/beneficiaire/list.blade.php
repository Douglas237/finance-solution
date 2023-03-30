{{-- @extends('layouts.dashboard')

@section('content')
<div class="form-control">
    <div class="formcompte">
        <div class="title">
            <p><strong>Liste des Beneficiaires</strong></p>
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
        ajax:"{{route('beneficiaire.list')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom', name: 'nom' },
            { data: 'prenom', name: 'prenom' },
            { data:'cni', name:'cni' },
            { data: 'telephone', name: 'telephone' },
            { data: 'sexe', name: 'sexe' },
            { data:'action', name:'action' },

      ]
});

});
</script>


@endsection --}}
