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
            <li class="breadcrumb-item active">Categorías</li>
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
        <a href="" class="btn btn-rounded btn-success"><i class="fa fa-plus-circle m-r-5"></i> Nueva Categoría</a>
    </div>
</div>

<div class="row">

</div>
@endsection

@section('scripts')
<script>
    $(".delete").on("submit", function(){
        return confirm("¿Estás seguro de querer borrar la publicación? Si borras este elemento también se eliminarán las imágenes relacionados y no podrán ser recuperadas.");
    });
</script>
@endsection