@extends('layouts.dashboard')

@section('content')
<div class="form-control">
    <div class="formcompte">
        <div class="title">
            <p><strong>Liste des Entreprises</strong></p>
        </div>
        <div class="alltabs">
            <div class="tabs_1">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom Entreprise</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">Type d'entreprise</th>
                            <th scope="col">CNI Responsable</th>
                            <th scope="col">photo responsable</th>
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
        ajax:"{{route('entreprise.list')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom_entreprise', name: 'nom_entreprise' },
            { data: 'nom_respon', name: 'nom_respon' },
            { data:'type_entreprise', name:'type_entreprise' },
            { data: 'cni_respon', name: 'cni_respon' },
            { data: 'image', name: 'image' },
            { data:'action', name:'action' },

      ]
});

});
</script>


@endsection
