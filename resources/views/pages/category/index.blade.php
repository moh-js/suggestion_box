@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/> 
@endsection

@section('content')

<div id="colorlib-main">
    <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container mt-5">
        <div class="mb-3">
            <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
        </div>
        
        <table class="table table-sm table-bordered" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Responsible Persons</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @foreach ($category->people as $person)
                                @php 
                                    $person = \App\Person::find($person)->proper_name;
                                @endphp
                                <span class="badge badge-primary">{{ $person }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="javascript:void(0)" onclick="$('#form').submit()" class="btn btn-danger btn-sm">Delete</a>

                            <form action="{{ route('category.destroy', $category->id) }}" id="form" method="post">
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