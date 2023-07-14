@extends('layouts.app')
@section('content')
<div class="container text-white my-5">
    <div class="row">
@if(isset($user))
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
	<h3 class="text-regular"><strong>Editar Item:</strong> {{$user['name']}} </h3>
	<form method="POST" action="/users/{{$user['id']}}">
		@csrf
		{{method_field('PUT')}}
		
		<div class="form-horizontal">
			<div class="form-group">
				<label for="" class="control-label col-md-2">Persona rol:</label>
				<div class="col-md-6">
					<select name="persona_id" id="">
                        <option value="administrador" @if($user->hasRole('administrador')) selected @endif >Administrador</option>
                        <option value="cliente" @if($user->hasRole('cliente')) selected @endif >Cliente</option>
					</select>
				</div>
					@error('persona_id')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group mt-3">
					<label for="" class="control-label col-md-2">Usuarios afectados:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="name" value="{{old('name', $user['name'])}}" placeholder="Nombre">
						@error('name')
					<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
			</div>
			<div class="form-group mt-3">
				<label for="" class="control-label col-md-2">Correo electronico</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="email" value="{{old('email', $user['email'])}}" placeholder="Email">
					@error('email')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group mt-3">
				<label for="" class="control-label col-md-2">Password:</label>
				<div class="col-md-6">
					<input type="password" class="form-control" name="password" placeholder="*******">
					@error('password')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group mt-3">
				<div class="col-md-offset-2 col-md-10 mt-3">
					<input type="submit" class="btn btn-primary" value="Actualizar Item">
				</div>
				<div class="col-md-3 mt-3">
					<a href="{{url('users')}}" class="btn btn-danger">Cancelar y Regresar</a>
				</div>
			</div>
		</div>
	</form>
	</div>
</div>
	@endif
	@endsection
	