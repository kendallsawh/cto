@extends('layouts.app-master')

@section('content')
    
    <h1 class="mb-3">Laravel 8 User Roles and Permissions Step by Step Tutorial - codeanddeploy.com</h1>

    <div class="bg-light p-4 rounded">
        <h2>Permissions</h2>
        <div class="lead">
            Manage your permissions here.
            <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Add permissions</a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Guard</th> 
                <th scope="col">Description</th> 
                <th scope="col" colspan="3" width="1%"></th> 
            </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target='#permissionModal' class="btn btn-info btn-sm" onclick="getPermission({{$permission}})" >Edit</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                        
                 
                @endforeach
            </tbody>
        </table>
        @include('permissions.modaledit')
    </div>
   
@endsection

<script>
function getPermission(permission){
    document.getElementById('permission-name').value= permission.name
    document.getElementById('permission-description').value=permission.description  
    document.getElementById('permission-form').action="/permissions/"+permission.id
}

</script>