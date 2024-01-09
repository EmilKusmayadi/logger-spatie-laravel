@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-3xl my-7">Permission</h2>
            </div>
            <div class="pull-right">
                {{-- @can('permission-create') --}}
                    <a class="btn btn-success" href="{{ route('permissions.create') }}"> Tambah Permission</a>
                {{-- @endcan --}}
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
            {{-- <th>No</th> --}}
            <th>Permission Name</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($data as $key => $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('permissions.show',$permission->id) }}">Show</a>
                    <a class="btn btn-warning" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {{-- {!! $data->render() !!} --}}
@endsection
