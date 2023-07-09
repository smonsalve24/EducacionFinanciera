@extends('layouts.app')
@section('content')
@if(isset($egresos)&& isset($categorias))
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
	<h3 class="text-regular"><strong>Editar Item:</strong> {{$egresos['valor']}} </h3>
	<form method="POST" action="/egresos/{{$egresos['id']}}">
		@csrf
		{{method_field('PUT')}}
		<div class="form-horizontal">
			<div class="form-group">
				<label for="" class="control-label col-md-2">Valor:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="valor" value="{{old('valor', $egresos['valor'])}}"placeholder="Valor">
					@error('valor')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-2">Fecha:</label>
				<div class="col-md-6">
					<input type="date" class="form-control" name="fecha" value="{{old('fecha', $egresos['fecha'])}}" placeholder="fecha">
					@error('fecha')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-2">Nota:</label>
				<div class="col-md-6">
					<textarea name="descripcion" class="form-control" value="{{old('descripcion', $egresos['descripcion'])}}" placeholder="Descripción de Sider..." rows="7"></textarea>
					@error('descripcion')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-2">Categoria:</label>
				<div class="col-md-6">
					<select name="categoria_egreso_id" id="">
						@if(isset($categorias))
						@foreach($categorias as $categoria)
							<option value="{{$categoria['id']}}">{{$categoria['nombre']}}</option>

						@endforeach
						@endif
					</select>
				</div>
				@error('categoria_egreso_id')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
			</div>
			<div class="form-group">
				<div class="col-md-offset-2 col-md-10 mt-3">
					<input type="submit" class="btn btn-primary" value="Actualizar Item">
				</div>
				<div class="col-md-3 mt-3">
					<a href="{{url('egresos')}}" class="btn btn-danger">Cancelar y Regresar</a>
				</div>
			</div>
		</div>
	</form>
	@endif
	@endsection
	