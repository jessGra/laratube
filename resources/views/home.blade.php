@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-12">
                <h1 class="mb-0 text-white">Todos los Videos</h1>
                <hr class="bg-gray">
                @include('videos.index')
                
            </div>
        </div>
    </div>
@endsection
