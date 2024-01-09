@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-3xl my-7">Users</h2>
            </div>
            <div class="pull-right">
                @can('users-create')
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Tambah User</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $role)
                            <span class="badge rounded-pill bg-success">{{ $role }}</span>
                        @endforeach
                    @endif
                </td>
                <td>
                    @can('users-list')
                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                    @endcan

                    @can('users-edit')
                        <a class="btn btn-warning" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    @endcan

                    @can('users-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->render() !!}
@endsection
