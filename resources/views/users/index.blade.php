@extends('layouts.dashboard')

@section('content')
<div class="form-control">
    <div class="formcompte">
        <div class="title">
            <p><strong>Liste des Employés</strong></p>

            <button style="position: absolute; right:4.2rem;top: 3.7rem" type="button" onclick="linck()"
                    class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Ajouter Employé</button>
        </div>
        <div class="alltabs">
            <div class="tabs_1">
                <table class="table table-bordered data-table table-striped table-hover"
                        style="width: 100% !important;">
                        <thead class="tableheade">
                            <tr>
                                <th scope="col"><span>N°</span></th>
                                <th scope="col"><span>Nom</span></th>
                                <th scope="col"><span>Prenom<span></th>
                                <th scope="col"><span>Email<span></th>
                                <th scope="col"><span>Date naissance</span></th>
                                <th scope="col"><span>Sexe</span></th>
                                <th scope="col"><span>Non utilisateur</span></th>
                                <th scope="col"><span>N° CNI</span></th>
                                <th scope="col"><span>Telephone</span></th>
                                <th scope="col"><span>Poste</span></th>
                                {{-- <th scope="col"><span>adress</span></th> --}}
                                <th scope="col"><span>Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->date_naissance }}</td>
                                <td>{{ $user->sexe }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->cni }}</td>
                                <td>{{ $user->telephone }}</td>
                                {{-- <td>{{ $user->post }}</td> --}}
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>

                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function linck() {
        window.location.href = "{{ route('users.create') }}";
    }
</script>

    {{-- <div class="d-flex">
            {!! $users->links() !!}
        </div> --}}

@endsection


