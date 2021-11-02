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
            <li class="breadcrumb-item active">Publicaciones</li>
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
        <a href="{{ route('blog.create') }}" class="btn btn-rounded btn-success"><i class="fa fa-plus-circle m-r-5"></i> Nueva Publicación</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3>Publicaciones</h3>
                <hr>

                @if($publicaciones->count() == NULL || $publicaciones->count() == 0)
                    <p>No hay publicaciones. ¡Comienza a crear una!</p>
                @else 
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titulo</th>
                                <th>Cuerpo</th>
                                <th>Categoría</th>
                                <th>Autor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($publicaciones as $pub)
                            <tr>
                                <td>{{ $pub->id }}</td>
                                <td>{{ $pub->title }}</td>
                                <td>{{ $pub->summary }}</td>
                                <td><span class="label label-info">{{ $pub->categoria->name }}</span> </td>
                                <td>{{ $pub->autor->name }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('blog.show', $pub->id) }}" data-toggle="tooltip" data-original-title="Ver"><i class="mdi mdi-eye text-inverse m-r-10"></i> </a>
                                    <a href="{{ route('blog.edit', $pub->id) }}" data-toggle="tooltip" data-original-title="Editar"><i class="mdi mdi-pencil text-inverse"></i></a>

                                    <form method="POST" class="delete" action="{{ route('blog.destroy', $pub->id) }}" style="display: inline-block;">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-original-title="Borrar"><i class="ti-trash"></i></button>
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $publicaciones->links() }}
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h3>Categorías</h3>
                <hr>

                <form method="POST" action="{{ route('categorias.store') }}">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input class="form-control" name="name" placeholder="Nueva Categoria..." type="text">
                        <div class="input-group-addon" style="padding: 0px; background-color: transparent;"><button class="btn btn-success">Guardar</button></div>
                    </div>
                </form>

                @if($categorias->count() == NULL || $categorias->count() == 0)
                    <p class="mt-4 mb-0">No hay categorias. ¡Comienza a crear una!</p>
                @else
                    <ul class="list-group mt-4 mb-0">
                        @foreach($categorias as $cat)
                        <li class="list-group-item">{{ $cat->name }}</li>
                        @endforeach
                    </ul>               
                @endif
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h3>Etiquetas</h3>
                <hr>

                <form method="POST" action="{{ route('etiquetas.store') }}">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input class="form-control" name="name" placeholder="Nueva Etiqueta..." type="text">
                        <div class="input-group-addon" style="padding: 0px; background-color: transparent;"><button class="btn btn-success">Guardar</button></div>
                    </div>
                </form>

                @if($etiquetas->count() == NULL || $etiquetas->count() == 0)
                    <p class="mt-4 mb-0">No hay etiquetas. ¡Comienza a crear una!</p>
                @else
                    <ul class="list-group mt-4 mb-0">
                        @foreach($etiquetas as $tg)
                        <li class="list-group-item">{{ $tg->name }}</li>
                        @endforeach
                    </ul>               
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(".delete").on("submit", function(){
        return confirm("¿Estás seguro de querer borrar la publicación? Si borras este elemento también se eliminarán las imágenes relacionados y no podrán ser recuperadas.");
    });
</script>
@endsection