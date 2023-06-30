@extends('layouts.app')
@section('content')
@if(isset($noticias))
	<h3 class="text-regular"><strong>Editar Item:</strong> {{$noticias['titulo']}} </h3>
    {!! Form::open(array('url'=> '/admin/noticias/'.$noticias['id'], 'method'=> 'PUT', 'files' => true ,)) !!}
    {!! Form::token() !!}
		<div class="form-horizontal">
    		<div class="form-group">
    			<label for="" class="control-label col-md-2">Nombre:</label>
    			<div class="col-md-6">
    				<input type="text" class="form-control" value="{{$noticias['titulo']}}" name="titulo" placeholder="Nombre">
    			</div>
    		</div>
    		<div class="form-group">
    			<label for="" class="control-label col-md-2">Archivo:</label>
    			<div class="col-md-6">
    				<input type="file" class="form-control" value="{{$noticias['imagen']}}" name="archivo" placeholder="Archivo">
    			</div>
    		</div>
    		<div class="form-group">
    			<label for="" class="control-label col-md-2">Descripción:</label>
    			<div class="col-md-6">
    				<textarea name="descripcion" class="form-control" placeholder="Descripción de Sider..." rows="7">{{$noticias['descripcion']}}</textarea>
    			</div>
    		</div>
    		<div class="form-group">
    			<div class="col-md-offset-3 col-md-2">
    				<input type="submit" class="btn btn-success" value="Actualizar item">
    			</div>
    			<div class="col-md-3">
    				<a href="{{url('admin/noticias')}}" class="btn btn-danger">Cancelar y Regresar</a>
    			</div>
    		</div>
    	</div>
	{{Form::close()}}
@endif
@endsection