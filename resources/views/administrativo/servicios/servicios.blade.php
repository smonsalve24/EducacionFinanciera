@extends('layouts.app')
@section('content')
<div class="panel-header">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs text-regular" role="tablist">
        <li role="presentation" class="active">
            <a href="{{ Request::is('administrador/servicios/create') ? '/#perfil' : '#perfil' }} " aria-controls="perfil" role="tab" data-toggle="tab">Entradas</a>
        </li>
        <li role="presentation">
            <a href="{{ Request::is('administrador/servicios/create') ? '/#solicitud' : '#solicitud' }}" aria-controls="solicitud" role="tab" data-toggle="tab">Crear Nuevo</a>
        </li>
    </ul>
</div>
<div>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="perfil"><br>
			{{-- @include('cuentas.perfil') --}}
			@if(isset($servicios))
			<span class="pull-right">
					{{$servicios->links()}}
				</span>
			<table class="table">
			<tr class="bg-primary">
				<td>
					<h5 class="text-center">
						#
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Titulo
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Descripción
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Archivo
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Acciones
					</h5>
				</td>
			</tr>
				@foreach($servicios as $directorio)
					<tr>
						<td>
							<h5 class="text-center">
								{{$directorio['id']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['titulo']}}
							</h5>
						</td>
						<td>
							<div class="small text-capitalize" style="max-width: 260px;">
								{!! substr($directorio['informacion'],0, 140)!!}...
							</div>
						</td>
						<td>
								@if(isset($directorio['foto']))
									<img src="{{asset($directorio['foto'])}}" alt="" class="img-responsive center-block" style="height: 50px;">
								@else
									<h5 class="text-center">
										No Hay archivo
									</h5>
								@endif
						</td>
						<td class="text-center">
							<a href="{{url('administrador/servicios/'.$directorio['id'])}}" class="text-center text-success btn">
								<i class="text-center fa fa-pencil"></i> Editar
							</a>
							<a href="#" data-toggle="modal" data-target="#myModal{{$directorio['id']}}" class="text-center text-danger btn">
								<i class="text-center fa fa-close"></i> Eliminar
							</a>
						</td>
					</tr>
				@endforeach
		</table>
			@endif
		</div>
		<div role="tabpanel" class="tab-pane " id="solicitud"><br>
			<h3 class="text-bold text-success">Creación de servicios</h3>
				<p class="">
					<small>
						¬ Crea un nombre para identificar tu slider. <br> ¬ Selecciona tu archivo - imagen (jpg, png, gif) no mayor a un tamaño de 1 MB y con la resolución (1280 X 320 pixeles). <br> ¬ Ingresa una pequeña descripción para tu slider. 
					</small>
				</p><br>
				{!! Form::open(array('url'=> '/administrador/servicios','method'=> 'POST', 'class' => '', 'files' => true , )) !!}
			    {!! Form::token() !!}
			    	<div class="form-horizontal">
			    		<div class="form-group">
			    			<label for="" class="control-label col-md-2">Nombre:</label>
			    			<div class="col-md-6">
			    				<input type="text" class="form-control" name="titulo" placeholder="Nombre">
			    			</div>
			    		</div>
			    		<div class="form-group">
			    			<label for="" class="control-label col-md-2">Archivo:</label>
			    			<div class="col-md-6">
			    				<input type="file" class="form-control" name="archivo" placeholder="Archivo">
			    			</div>
			    		</div>
			    		<div class="form-group">
			    			<label for="" class="control-label col-md-2">Descripción:</label>
			    			<div class="col-md-6">
			    				<textarea name="descripcion" class="form-control" placeholder="Descripción de Sider..." rows="7"></textarea>
			    			</div>
			    		</div>
			    		<div class="form-group">
			    			<div class="col-md-offset-2 col-md-10">
			    				<input type="submit" class="btn btn-primary" value="Guardar Slider">
			    			</div>
			    		</div>
			    	</div>
				{!! Form::close() !!}
			{{-- @include('cuentas.solicitudes') --}}
		</div>
	</div>
</div>

@if(isset($servicios))
	@foreach($servicios as $directorio)
		<!-- Modal -->
		<div class="modal fade" id="myModal{{$directorio['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
		    {!! Form::open(array('url'=> '/administrador/servicios/'.$directorio['id'], 'method'=> 'DELETE', 'files' => true ,)) !!}
		    {!! Form::token() !!}
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Eliminar Contenido</h4>
					</div>
					<div class="modal-body">
						<p class="text-center text-regular">
							¿ Realmente deseas eliminar este items ?
						</p>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger">Eliminar</button>
					</div>
				</div>
			{{Form::close()}}
			</div>
		</div>
	@endforeach
@endif
@endsection