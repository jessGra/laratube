@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-12">
                <div class="d-md-flex justify-content-md-between">
                    <h1 class="mb-0 text-white">
                        <small class="text-white-50">Resultados de la busqueda:</small>
                        {{ $search }}
                    </h1>
                    <form action="{{route('video.search', $search)}}" class="col-md-3 my-auto text-white" id="buscador">
                        <label for="filter">Ordenar por:</label> 
                        <select class="form-control form-control-sm bg-gray" name="filter" id="filter" onchange="filtroSearch()">
                            <option value="reciente" {{isSelected('reciente')}}>Más recientes</option>
                            <option value="antiguo" {{isSelected('antiguo')}}>Más antiguos</option>
                            <option value="alfa" {{isSelected('alfa')}}>A-Z</option>
                        </select>
                    </form>
                </div>
                <hr class="bg-gray">
                @include('videos.index')

            </div>
        </div>
    </div>
@endsection
