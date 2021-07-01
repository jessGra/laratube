@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-dark text-white">
                    <div class="card-header ">
                        <h2 class="float-left"><strong>Subir Video</strong></h2>
                        <a class="btn btn-secondary float-right" href="{{ route('home') }}">Cancelar</a>
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

                        <form action="{{ route('video.subido') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row d-flex justify-content-around form-group">
                                <div class="col-md-5 flex-item">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="video" id="video">
                                        <label class="custom-file-label " for="video" data-browse="Elegir">Sube tu
                                            video</label>
                                    </div>
                                    <video controls class="container mt-2 d-none" id="preview-video">
                                        <source src="" type="video/mp4">
                                    </video>
                                </div>
                                <div class="col-md-5 flex-item">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="image" data-browse="Elegir">Agrega una
                                            miniatura</label>
                                    </div>
                                    <img src="" class="container mt-2 d-none" alt="image preview" id="preview-image"
                                        style="max-height: 184px">
                                </div>
                            </div>

                            <div class="input-group mb-3 col-md-6 mx-auto">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gray" id="basic-addon3">Titulo</span>
                                </div>
                                <input type="text" class="form-control bg-gray" id="basic-url"
                                    aria-describedby="basic-addon3" name="title" id="title" placeholder="Titulo del video"
                                    value="{{ old('title') }}">
                            </div>

                            <div class="input-group form-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gray">Descripcion</span>
                                </div>
                                <textarea class="form-control bg-gray" name="description" id="description"
                                    placeholder="Añade una descripcion de tu video"
                                    aria-label="With textarea">{{ old('description') }}</textarea>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block col-md-6 mx-auto bg-gray"
                                type="submit">Subir</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
