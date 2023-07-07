@extends('layouts.app')
@section('content')
@if(isset($alerta))
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
	<h3 class="text-white"><strong>Editar Item:</strong> {{$alerta['email_users']}} </h3>
	<form method="POST" action="/alerts/{{$alerta['id']}}">
		@csrf
		{{method_field('PUT')}}
		<div class="form-horizontal text-white">
			<div class="form-group mb-3">
				<label for="" class="control-label col-md-2">Usuarios afectados:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="email_users" value="{{old('email_users', $alerta['email_users'])}}" placeholder="Nombre">
					@error('email_users')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group mb-3">
				<label for="" class="control-label col-md-2">Tipo de alerta:</label>
				<div class="col-md-6">
					<select name="tipo_alerta" id="">
						<option value="0" @if($alerta['tipo_alerta'] == 0) selected @endif>hola</option>
						<option value="1" @if($alerta['tipo_alerta'] == 1) selected @endif>hola 1</option>
						<option value="2" @if($alerta['tipo_alerta'] == 2) selected @endif>hola 2</option>
					</select>
					@error('tipo_alerta')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group mb-3">
				<label for="" class="control-label col-md-2">Descripción:</label>
				<div class="col-md-6">
					<textarea name="mensaje" class="form-control" placeholder="Descripción de Sider..." rows="7">{{$alerta['mensaje']}}</textarea>
					@error('mensaje')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group mt-3">
				<div class="row">
					<div class="col-md-2">
						<input type="submit" class="btn btn-primary" value="Actualizar Item">
					</div>
					<div class="col-md-2">
						<a href="{{url('alerts')}}" class="btn btn-danger">Cancelar y Regresar</a>
					</div>
				</div>
			</div>
		</div>
	</form>
	@endif
	@endsection
	