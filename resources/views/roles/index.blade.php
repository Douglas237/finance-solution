@extends('layouts.dashboard')

@section('content')

<div class="form-control">
    <div class="formcompte">
        <div class="title">
            <p><strong>Liste des Roles</strong></p>
            {{-- <a
            href="{{ route('Client.create') }}"><button style="margin-left: 55rem;height: 2.9rem;width: 10rem;" type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Ajouter client</button></a> --}}
            <button style="position: absolute; right:4.2rem;top: 3.7rem" type="button" onclick="linck()"
                class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Ajouter roles</button>
        </div>

<div class="bg-light p-4 rounded">

            <div class="mt-2">
                @include('layouts.partials.messages')
            </div>
    <div class="alltabs">
        <div class="tabs_1">

            <table class="table table-bordered data-table table-striped table-hover" style="width: 100% !important;">
            <thead class="tableheade">
              <tr>
                 <th width="1%">No</th>
                 <th>Name</th>
                 <th width="3%" colspan="3">Action</th>
              </tr>
            </thead>
                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('roles.show', $role->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>

            <div class="d-flex">
                {!! $roles->links() !!}
            </div>

        </div>
        </div>
    </div>
    </div>
</div>



    <script type="text/javascript">
        function linck() {
            window.location.href = "{{ route('roles.create') }}";
        }
    </script>
@endsection
