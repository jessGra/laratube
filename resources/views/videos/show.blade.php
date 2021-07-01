@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-white">
            <div class="col-lg-8">
                <video controls class="container mt-2" id="video-show" autoplay muted>
                    <source src="{{ route('get.video', $video->path) }}" type="video/mp4">
                </video>
                @if (Auth::check() && Auth::user()->id == $video->user_id)
                    <a class="btn btn-outline-warning float-right" href="{{ route('video.edit', $video) }}">Editar</a>
                @endif
                <h3>{{ $video->title }}</h3>

                <p class="text-white-60 ">Publicado el: {{ $video->created_at->format('D/d/M/Y') }} -
                    {{ $video->created_at->diffForHumans() }}</p>
                <hr class="bg-gray">
                <h4><a href="{{route('user.show', $video->user)}}" class="text-white">{{ $video->user->name . ' ' . $video->user->surname }}</a></h4>

                <p class="mx-4 text-center">{{ $video->description }}</p>
                <hr class="bg-white">

                <div id="comentarios">
                    @include('comments.index')
                </div>
            </div>
            <div class="col-lg-4 col-sm-8 mx-auto">

                <h4 class="text-center">Más videos</h4>
                <div>
                    @forelse ($videosList as $video)
                        <div class="row my-2 bg-dark rounded-lg">
                            <div class="col-6 px-0">
                                <div class="image-video-mini">
                                    <img src="{{ route('get.image', $video->image) }}" alt="video image" width="100%"
                                        height="115px">
                                    <a class="a-video-mini" href="{{ route('video.show', $video) }} "><i
                                            class="fas fa-play"></i> REPRODUCIR</a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="my-4">
                                    <b>{{ $video->title }}</b>
                                    <p class="card-text">{{ $video->user->name }} <br>
                                        <small class="text-white-50">{{ $video->created_at->diffForHumans() }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No hay videos recomendados</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
