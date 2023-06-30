@extends('layouts.app')
@section('content')
@if(isset($contacto))
	<h3 class="text-regular"><strong>Editar Item:</strong> {{$contacto['titulo']}} </h3>
    {!! Form::open(array('url'=> '/admin/contacto/'.$contacto['id'], 'method'=> 'PUT', 'files' => true ,)) !!}
    {!! Form::token() !!}
		<div class="form-horizontal">
    		<div class="form-group">
    			<label for="" class="control-label col-md-2">Nombre:</label>
    			<div class="col-md-6">
    				<input type="text" class="form-control" value="{{$contacto['titulo']}}" name="titulo" placeholder="Nombre">
    			</div>
    		</div>
    		<div class="form-group">
    			<label for="" class="control-label col-md-2">Archivo:</label>
    			<div class="col-md-6">
    				<input type="file" class="form-control" value="{{$contacto['archivo']}}" name="archivo" placeholder="Archivo">
    			</div>
    		</div>
    		<div class="form-group">
    			<label for="" class="control-label col-md-2">Descripción:</label>
    			<div class="col-md-6">
    				<textarea name="descripcion" class="form-control" placeholder="Descripción de Sider..." rows="7">{{$contacto['descripcion']}}</textarea>
    			</div>
    		</div>
    		<div class="form-group">
    			<label for="" class="control-label col-md-2">Interes:</label>
    			<div class="col-md-6">
    				<textarea name="interes" class="form-control" placeholder="Descripción de Sider..." rows="5">{{$contacto['interes']}}</textarea>
    			</div>
    		</div>
    		<div class="form-group">
    			<label for="" class="control-label col-md-2">Direcciones:</label>
    			<div class="col-md-6">
    				<textarea name="direcciones" class="form-control" placeholder="Descripción de Sider..." rows="5">{{$contacto['direcciones']}}</textarea>
    			</div>
    		</div>
    		<div class="form-group">
    			<div class="col-md-offset-3 col-md-2">
    				<input type="submit" class="btn btn-success" value="Actualizar Slider">
    			</div>
    			<div class="col-md-3">
    				<a href="{{url('admin/contacto')}}" class="btn btn-danger">Cancelar y Regresar</a>
    			</div>
    		</div>
    	</div>
	{{Form::close()}}
@endif
@endsection