@extends('layouts.dashboard')

@section('content')
<div class="form-control">
    <div class="formcompte">
        <div class="title">
            <p><strong>Ajouter un nouveau rôle et attribuer des autorisations</strong></p>
        </div>

        <div class="bg-light p-4 rounded">

            <div class="container mt-4">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="mb-3">
                        {{-- <label for="name" class="form-label">Nom</label> --}}
                        <input value="{{ old('name') }}"
                            type="text"
                            class="form-control"
                            name="name"
                            placeholder="Nom du rôle" required>
                    </div>

                    <label for="permissions" class="form-label">Attribuer des autorisations</label>

        <div class="alltabs">
            <div class="tabs_1">
                    <table class="table table-striped data-table table-hover" style="width: 100% !important;">
                        <thead class="tableheade">
                            <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                            <th scope="col" width="20%">Nom des Permissions</th>
                            <th scope="col" width="1%">Guard</th>
                        </thead>

                        @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox"
                                    name="permission[{{ $permission->name }}]"
                                    value="{{ $permission->name }}"
                                    class='permission'>
                                </td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
        </div>

                    <button type="submit" class="btn btn-primary">Valider</button>
                    <a href="{{ route('users.index') }}" class="btn btn-default">Retour</a>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
    </script>
@endsection
