@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/> 
@endsection

@section('content')

<div id="colorlib-main">
    <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container mt-5">
        <div class="mb-3">
            <a href="{{ route('user.create') }}" class="btn btn-primary">Add User</a>
        </div>
        
        <table class="table table-sm table-bordered" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>E-Mail Address</th>
                    <th>Responsible Area</th>
                    <th>Role</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->person->proper_name?? null }}
                        </td>
                        <td>{{ title_case($user->getRoleNames()->first()) }}</td>
                        <td class="text-center">
                            @if ($user->deleted_at)
                            <a href="javascript:void(0)" onclick="$('#form{{ $key }}').submit()" class="btn btn-danger btn-sm">Restore</a>
                            @else
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="javascript:void(0)" onclick="$('#form{{ $key }}').submit()" class="btn btn-danger btn-sm">Delete</a>
                            @endif
                            <form action="{{ route('user.destroy', $user->id) }}" id="form{{ $key }}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </section>
</div>
    
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
 
<script>
$(document).ready( function () {
    $('#table').DataTable();
} );
</script>
@endsection