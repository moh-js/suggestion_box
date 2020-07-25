@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div id="colorlib-main">
    <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container mt-5">
        <div class="mb-4">
            <h4>Create Category</h4>
        </div>
        <form action="{{ route('category.store') }}" method="post">
            @csrf

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter category name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="form-group">
                        <label for="name">Responsible Person(s)</label>
                        <select name="people[]" id="people" multiple class="form-control @error('people') is-invalid @enderror">
                            @foreach (\App\Person::query()->orderBy('name', 'asc')->get() as $person)
                                <option value="{{ $person->id }}" {{ collect(old('people'))->contains($person->id)?'selected':'' }}>{{ $person->proper_name }}</option>
                            @endforeach
                        </select>
                        @error('people')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    </section>
</div>
    
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#people').select2({
            placeholder: 'Choose responsible persons',
            height: '50px'
        });
    });
</script>
@endsection