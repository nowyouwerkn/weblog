@extends('werknhub::back.layouts.main')

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
        @include('werknhub::back.layouts.partials._messages')
    </div>
</div>

<div class="row mb-4">
    <div class="col col-md-12">
        <a href="{{ route('posts.create') }}" class="btn btn-rounded btn-success"><i class="fa fa-plus-circle m-r-5"></i> Nueva Publicación</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3>Publicaciones</h3>
                <hr>

                @if($posts->count() == NULL || $posts->count() == 0)
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
                            @foreach($posts as $pub)
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

                {{ $posts->links() }}
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