@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container bg-gray text-white p-4 shadow-lg-white">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img class="img-fluid" src="{{ asset('images/user.png') }}" alt="imagen de usuario" width="50%">
                </div>
                <div class="col-md-8 border-left">
                    <h3 class="text-center text-md-left">{{$usuario->name.' '.$usuario->surname}}</h3>
                    <hr class="bg-white">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing Lorem ipsum dolor sit, 
                        amet consectetur adipisicing elit. Sunt, minima quasi voluptatum, iure fugit 
                        asperiores eos
                    </p>
                    <p class="text-right text-white-50">Usuario desde: <span class="text-white">{{$usuario->created_at->format('d-M-Y')}}</span></p>
                </div>
            </div>
        </div>
        <div id="Videos" class="container bg-gray my-4 p-3 text-white">
            <h3 class="text-center p-3">Videos de <b class="text-warning">{{$usuario->name}}</b></h3>
            <hr class="bg-dark">
            <div>
                @include('videos.index')
            </div>
        </div>
    </div>
@endsection
