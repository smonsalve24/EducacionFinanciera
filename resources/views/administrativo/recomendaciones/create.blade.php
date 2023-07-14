@extends('layouts.app')
@section('content')
<div class="container text-white my-4">
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
        <form method="POST" action="{{ route('recomendaciones.store') }}">
            @csrf
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="" class="control-label col-md-2">Usuario afectado:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="correo_usuario" placeholder="Correo electronico">
                        @error('correo_usuario')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="" class="control-label col-md-2">Titulo:</label>
                    <div class="col-md-6">
                        <textarea name="mensaje" class="form-control" placeholder="Descripción de Sider..." rows="7"></textarea>
                        @error('mensaje')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="" class="control-label col-md-2">Recomendación:</label>
                    <div class="col-md-6">
                        <textarea name="recomendacion" class="form-control" placeholder="Descripción de Sider..." rows="7"></textarea>
                        @error('recomendacion')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 mt-3">
                        <input type="submit" class="btn btn-primary" value="Guardar Item">
                    </div>
                    <div class="col-md-offset-2 col-md-10 mt-3">
                        <a href="{{url('recomendaciones')}}" class="btn btn-danger">Regresar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection