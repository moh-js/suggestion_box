@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div id="colorlib-main">
    <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container mt-5">
        <div class="mb-4">
            <h4>Post Suggestion/QNS</h4>
        </div>
        <form action="{{ route('post.store') }}" method="post">
            @csrf

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="editor"></textarea>
                    @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

        
                    <div class="form-group">
                        <label for="name">Category</label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                            <option disabled selected>Choose category</option>
                            @foreach (\App\Category::query()->get() as $category)
                                <option value="{{ $category->id }}" {{ collect(old('category'))->contains($category->id)?'selected':'' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Visibility</label>
                        @php
                            $options = [
                                [
                                    'name' => 'Public',
                                    'value' => 0
                                ],
                                [
                                    'name' => 'Private',
                                    'value' => 1
                                ]
                            ]
                        @endphp
                        <select name="visibility" id="visibility" class="form-control @error('visibility') is-invalid @enderror">
                            <option disabled selected>Choose visibility</option>
                            @foreach ($options as $visibility)
                                <option value="{{ $visibility['value'] }}" {{ old('visibility') == ($visibility['value'])?'selected':'' }}>{{ $visibility['name'] }}</option>
                            @endforeach
                        </select>
                        @error('visibility')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary btn-block">Post</button>
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
<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );

    $(document).ready(function() {
        $('#people').select2({
            placeholder: 'Choose responsible persons',
            height: '50px'
        });
    });
</script>
@endsection