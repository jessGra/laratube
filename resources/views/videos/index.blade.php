

<div class="row row-cols-1 row-cols-md-3 my-4">
    

    @forelse ($videos as $video)
    <div class="col mb-4">
        <div class="card h-100 bg-dark text-white">
            <div class="img-container">
                <img src="{{ route('get.image', $video->image) }}" class="card-img-top" alt="video image" height="200px">
                <a href="{{route('video.show', $video)}}" ><i class="fas fa-play"></i> REPRODUCIR VIDEO</a>
            </div>
            
            <div class="card-body pt-2">
                <h5 class="card-title text-center">{{ $video->title }}</h5>
                <div class="d-flex justify-content-between mx-3">
                    <div class="flex-item">
                        <p class="card-text">{{$video->user->name.' '.$video->user->surname}}</p>
                    </div>
                    <div class="flex-item">
                        <p class="card-text text-white-50">{{ $video->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
        <h2 class="display-4 mb-0 test-white">No hay videos para mostrar.</h2>
    @endforelse
</div>
{{ $videos->links('pagination::bootstrap-4') }}
