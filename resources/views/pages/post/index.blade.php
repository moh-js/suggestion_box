@extends('layouts.app')


@section('content')
    
<div id="colorlib-main">
    <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 13rem">
            <div class="mr-5">
                <a href="#" class="btn btn-primary">MY POST</a>
            </div>
            <div class="mr-5">
                <a href="#" class="btn btn-primary">PUBLIC POST</a>
            </div>
            <div class="mr-5">
                <a href="{{ route('post.create') }}" class="btn btn-primary">POST</a>
            </div>
        </div>
    </div>


@endsection