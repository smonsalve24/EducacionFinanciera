@extends('layouts.app')
@section('content')
<div class="container text-white my-5">
    <div class="row">
@if(isset($recomendacion))
@if($message = Session::get('success'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
	@elseif($message = Session::get('error'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
@endif
	<h3 class="text-regular"><strong>Editar Item:</strong> {{$recomendacion['email']}} </h3>
	<form method="POST" action="/recomendaciones/{{$recomendacion['id']}}">
		@csrf
		{{method_field('PUT')}}
		<div class="form-horizontal">
			<div class="form-group">
				<label for="" class="control-label col-md-2">Usuarios afectados:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="correo_usuario" value="{{old('correo_usuario', $recomendacion['correo_usuario'])}}"placeholder="Correo electronico">
					@error('correo_usuario')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group mt-3">
				<label for="" class="control-label col-md-2">Titulo:</label>
				<div class="col-md-6">
					<textarea name="mensaje" class="form-control" value="{{old('mensaje', $recomendacion['mensaje'])}}" placeholder="Descripción de Sider..." rows="4"></textarea>
					@error('mensaje')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group mt-3">
				<label for="" class="control-label col-md-2">Recomendación:</label>
				<div class="col-md-6">
					<textarea name="recomendacion" class="form-control" value="{{old('recomendacion', $recomendacion['recomendacion'])}}" placeholder="Descripción de Sider..." rows="4"></textarea>
					@error('recomendacion')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-2 col-md-10 mt-3">
					<input type="submit" class="btn btn-primary" value="Actualizar Item">
				</div>
				<div class="col-md-3 mt-3">
					<a href="{{url('recomendaciones')}}" class="btn btn-danger">Cancelar y Regresar</a>
				</div>
			</div>
		</div>
	</form>
	</div>
</div>
	@endif
	@endsection
	