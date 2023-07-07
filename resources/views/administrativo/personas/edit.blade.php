@extends('layouts.app')
@section('content')
@if(isset($persona))
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
	<h3 class="text-regular"><strong>Editar Item:</strong> {{$persona['nombre']}} </h3>
	<form method="POST" action="/personas/{{$persona['id']}}">
		@csrf
		{{method_field('PUT')}}
		<div class="form-horizontal">
			<div class="form-group">
				<label for="" class="control-label col-md-2">Persona Id:</label>
				<div class="col-md-6">
					<select name="persona_id" id="">
						<option value="3">Valor</option>
					</select>
				</div>
				@error('persona_id')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-2">Nombre</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="nombre" value="{{old('nombre', $persona['nombre'])}}" placeholder="Nombre completo">
					@error('email')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-2">Rol:</label>
				<div class="col-md-6">
					<select name="rol" id="">
						<option value="0" @if($persona['rol'] == 0) selected @endif>Administrador</option>
						<option value="1" @if($persona['rol'] == 1) selected @endif>Usuario</option>
					</select>
				</div>
				@error('rol')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
			</div>
			<div class="form-group">
				<div class="col-md-offset-2 col-md-10 mt-3">
					<input type="submit" class="btn btn-primary" value="Actualizar Item">
				</div>
				<div class="col-md-3 mt-3">
					<a href="{{url('personas')}}" class="btn btn-danger">Cancelar y Regresar</a>
				</div>
			</div>
		</div>
	</form>
	@endif
	@endsection
	