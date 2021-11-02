@extends('back.layouts.app')

@section('stylesheets')

<link rel="stylesheet" href="{{ asset('back/assets/plugins/html5-editor/bootstrap-wysihtml5.css') }}" />
<link href="{{ asset('back/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('back/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Editar Publicación</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item">Blog</li>
            <li class="breadcrumb-item">Editar Publicación</li>
            <li class="breadcrumb-item active">{{ $publicacion->title }}</li>
        </ol>
    </div>
</div>

<form method="POST" action="{{ route('blog.update', $publicacion->id) }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT') }}

	<div class="row">
		<div class="col col-md-8">
			<div class="card">
				<div class="card-body">
					<h3>Publicación</h3>
					<hr>

					<div class="row">
						<div class="col col-md-12">
							<div class="form-group">
								<label for="title">Titulo</label>
								<input class="form-control" type="text" name="title" required="" value="{{ $publicacion->title }}">
							</div>
						</div>

						<div class="col col-md-12">
							<div class="form-group">
								<label for="summary">Resumen</label>
								<textarea class="form-control" row="5" name="summary" required="">{{ $publicacion->summary }}</textarea>
							</div>
						</div>

						<div class="col col-md-12">
							<div class="form-group">
								<label for="body">Cuerpo</label>
								<textarea id="mymce" name="body">{!! $publicacion->body !!}</textarea>
							</div>
						</div>

						<div class="col col-md-6">
							<div class="form-group">
								<label for="category_id">Categoria</label>
								<select class="form-control select2" name="category_id">
									<option selected>Selecciona una Opción</option>
									@foreach($categorias as $cat)
										<option {{ ($cat->id == $publicacion->category_id) ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col col-md-6">
							<div class="form-group">
								<label for="autor_id">Autor</label>
								<select class="form-control select2" name="autor_id">
									<option selected>Selecciona una Opción</option>
									@foreach($autores as $aut)
										<option {{ ($aut->id == $publicacion->autor_id) ? 'selected' : '' }} value="{{ $aut->id }}">{{ $aut->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col col-md-12">
							<div class="form-group">
								<label for="tag_id[]">Etiquetas</label>
								<select class="form-control select2 select2-multiple" name="tag_id[]" multiple="multiple">
									@foreach($publicacion->etiquetas as $tg)
	                            		<option selected="" value="{{ $tg->id }}">{{ $tg->name }}</option>
	                            	@endforeach

									@foreach($etiquetas as $tg)
										<option value="{{ $tg->id }}">{{ $tg->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<hr>
			<div class="col-md-12">
		    	<div class="row justify-content-end">
		            <div class="col">
		                <div class="form-group text-right">
		                    <a href="{{ route('blog.index') }}" class="btn btn-link">Cancel</a>
		                    <button type="submit" class="btn btn-success btn-lg">Guardar</button>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>

		<div class="col col-md-4">
			<div class="card">
				<div class="card-body">
					<h3>Opciones de Imágen</h3>
					<hr>
					<div class="form-group">
						<label for="image">Imagen de Portada</label>
						<input type="file" name="image" class="dropify" data-height="250" data-default-file="{{ asset('img/blog/covers/' . $publicacion->image) }}" />
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection


@section('scripts')
    <script src="{{ asset('back/assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('back/assets/plugins/tinymce/tinymce.min.js') }}"></script>

    <script src="{{ asset('back/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
        $('.select2').select2();
    });
    </script>

    <script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                language: 'es_MX',
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
    </script>
@endsection