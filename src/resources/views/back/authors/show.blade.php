@extends('back.layouts.app')

@section('stylesheets')

@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Blog</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Publicaciones</a></li>
            <li class="breadcrumb-item active">{{ $publicacion->title }}</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col">
        @include('back.layouts.partials._mensajes')
    </div>
</div>

<div class="row mb-4">
    <div class="col col-md-12">
        <a href="{{ route('blog.index') }}" class="btn btn-rounded btn-success">Regresar</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>{{ $publicacion->title }}</h3>
                <p>{{ $publicacion->summary }}</p>

                <img class="my-4" style="width: 100%;" src="{{ asset('img/blog/covers/' . $publicacion->image) }}">
                <ul class="list-inline">
                	<li class="list-inline-item">{{ $publicacion->autor->name }}</li>
                	<li class="list-inline-item">{{ $publicacion->categoria->name }}</li>
                </ul>

                {!! $publicacion->body !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection