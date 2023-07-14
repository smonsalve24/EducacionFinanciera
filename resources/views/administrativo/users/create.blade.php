@extends('layouts.app')
@section('content')
<div class="container text-white my-5">
    <div class="row">
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
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="" class="control-label col-md-2">Rol:</label>
                    <div class="col-md-6">
                        <select name="rol" id="" >
                            <option value="administrador">Administrador</option>
                            <option value="cliente">Usuario</option>
                        </select>
                    </div>
                    @error('rol')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                </div>
                <div class="form-group mt-3">
                    <label for="" class="control-label col-md-2">Nombre usuario:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" placeholder="Nombre">
                        @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="" class="control-label col-md-2">Correo electronico:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                        @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="" class="control-label col-md-2">Contraseña:</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password" placeholder="*******">
                        @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 mt-3">
                        <input type="submit" class="btn btn-primary" value="Guardar Item">
                    </div>
                    <div class="col-md-offset-2 col-md-10 mt-3">
                        <a href="{{url('users')}}" class="btn btn-danger">Regresar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection