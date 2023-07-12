@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-white">
            <h3>Creación de Alerta</h3>
        </div>
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
        <form method="POST" action="{{ route('alerts.store') }}">
            @csrf
            <div class="form-horizontal text-white">
                <div class="form-group">
                    <label for="" class="control-label col-md-2">Usuarios afectados:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="email_users" placeholder="Nombre">
                        @error('email_users')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-md-2">Tipo de alerta:</label>
                    <div class="col-md-6">
                        <select name="tipo_alerta" id="">
                            <option value="0">Alerta</option>
                            <option value="1">Advertencia</option>
                            <option value="2">recomendación</option>
                        </select>
                    </div>
                    @error('tipo_alerta')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-md-2">Descripción:</label>
                    <div class="col-md-6">
                        <textarea name="mensaje" class="form-control" placeholder="Descripción de Sider..." rows="7"></textarea>
                        @error('mensaje')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>
                <div class="form-group mt-4">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" class="btn btn-primary" value="Guardar Item">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection