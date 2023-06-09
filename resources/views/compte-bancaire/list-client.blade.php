@extends('layouts.dashboard')

@section('content')
<div class="form-control">
    <div class="formcompte">
        <div class="title">
            <p><strong>Liste des Clients/Entreprises</strong></p>
        </div>
        <div class="alltabs">
            <div class="tabs_1">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Date-Naiss</th>
                            <th scope="col">Sexe</th>
                            {{-- <th scope="col">Email</th> --}}
                            <th scope="col">Telephone</th>
                            <th scope="col">N° CNI</th>
                            <th scope="col">ville</th>
                            <th scope="col">Address</th>
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
        ajax:"{{route('client.list')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom', name: 'nom' },
            { data: 'prenom', name: 'prenom' },
            { data: 'date_naissance', name: 'date_naissance' },
            { data: 'sexe', name: 'sexe' },
            // { data:'email', name:'email' },
            { data: 'telephone', name: 'telephone' },
            { data:'cni', name:'cni' },
            { data:'ville', name:'ville' },
            { data:'adress', name:'adress' },
            { data:'action', name:'action' },

      ]
});

});
</script>


@endsection
