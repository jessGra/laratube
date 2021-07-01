<a class="btn btn-block btn-dark mb-3 d-lg-none" data-toggle="collapse" data-target="#collapseComentarios"
    aria-expanded="false" aria-controls="collapseComentarios">
    ver comentarios
</a>
<div class="collapse mx-4 d-lg-block" id="collapseComentarios">
    <h5 class="text-center">Comentarios</h5>
    @auth
        <!--Errores de validacion -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('comment.store', $video) }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control bg-gray" placeholder="Deja un comentario publico" name="comentario">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary bg-gray" type="submit">Comentar</button>
                </div>
            </div>
        </form>
    @else
        <p class="text-center">Debes
            <a href="{{ route('login') }}" class="text-warning">Iniciar Sesion</a>
            para comentar
        </p>
    @endauth

    @forelse ($video->comments as $comment)
        <div class="card bg-gray my-3">
            <div class="card-body row">
                <div class="col-10">
                    <blockquote class="blockquote">
                        <p class="mb-0">{{ $comment->user->name . ' ' . $comment->user->surname }}</p>
                        <footer class="blockquote-footer">{{ $comment->body }}</footer>
                    </blockquote>
                    <p>{{ $comment->created_at->diffForHumans() }}</p>

                    
                    <!-- Modal -->
                <div class="modal fade bg-gray" id="sureModal{{$comment->id}}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h5 class="modal-title">Has seleccionado eliminar el comentario</h5>
                                <button type="button" class="close text-white" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <h5>{{$comment->body}}</h5>
                                <p>esto hará que no este disponible para el publico.</p>
                                <form class="d-none" id="delete-comentario{{$comment->id}}" method="POST"
                                    action="{{ route('comment.destroy', [$video,$comment]) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary bg-dark"
                                    data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger"
                                    onclick="document.getElementById('delete-comentario{{$comment->id}}').submit()">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                @if (Auth::check() && (Auth::user()->id == $comment->user->id || Auth::user()->id == $video->user_id))
                    <div class="col-2">
                        <div class="dropdown float-right">
                            <button class="btn btn-dark " type="button" id="dropdownMenu2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                @if (Auth::user()->id == $comment->user->id)
                                    <button class="dropdown-item" type="button"><i class="fas fa-pencil-alt"></i>
                                        Editar</button>
                                @endif
                                <button class="dropdown-item" data-toggle="modal" data-target="#sureModal{{$comment->id}}"><i
                                        class="fas fa-trash-alt"></i>
                                    Eliminar</button>
                            </div>
                        </div>

                    </div>
                @endif
                
            </div>
        </div>
    @empty
        <div class="card-body row">
            <div class="col-10">
                <p>No hay comentarios</p>
            </div>
        </div>
    @endforelse
</div>
