@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-dark text-white">
                    <div class="card-header ">
                        <h2 class="float-left"><strong>Editar Video</strong></h2>
                        <a class="btn btn-secondary float-right" href="{{ route('video.show', $video) }}">Cancelar</a>
                        <a class="btn btn-danger float-right mr-2" data-toggle="modal" data-target="#sureModal">Eliminar</a>
                        <!-- Modal -->
                        <div class="modal fade bg-gray" id="sureModal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Estás seguro?</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <h5>Has seleccionado eliminar el video
                                            <strong class="text-danger">{{ $video->title }}</strong>, esto hará que no
                                            este disponible para el publico.
                                        </h5>
                                        <form class="d-none" id="delete-video" method="POST"
                                            action="{{ route('video.delete', $video) }}">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary bg-dark"
                                            data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="document.getElementById('delete-video').submit()">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
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

                        <form action="{{ route('video.update', $video) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-row d-flex justify-content-around form-group">
                                <div class="col-md-5 flex-item">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="image" data-browse="Elegir">Cambiar la
                                            miniatura</label>
                                    </div>
                                    <img src="{{ route('get.image', $video->image) }}" class="container mt-2"
                                        alt="image preview" id="preview-image" style="max-height: 184px">
                                </div>
                            </div>

                            <div class="input-group mb-3 col-md-6 mx-auto">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gray" id="basic-addon3">Titulo</span>
                                </div>
                                <input type="text" class="form-control bg-gray" id="basic-url"
                                    aria-describedby="basic-addon3" name="title" id="title" placeholder="Titulo del video"
                                    value="{{ old('title', $video->title) }}">
                            </div>

                            <div class="input-group form-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gray">Descripcion</span>
                                </div>
                                <textarea class="form-control bg-gray" name="description" id="description"
                                    placeholder="Añade una descripcion de tu video"
                                    aria-label="With textarea">{{ old('description', $video->description) }}</textarea>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block col-md-6 mx-auto bg-gray"
                                type="submit">Guardar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
