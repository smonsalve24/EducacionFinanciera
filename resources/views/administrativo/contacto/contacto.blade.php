@extends('layouts.app')
@section('content')
<div class="panel-header">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs text-regular" role="tablist">
        <li role="presentation" class="active">
            <a href="{{ Request::is('administrador/contacto/create') ? '/#perfil' : '#perfil' }} " aria-controls="perfil" role="tab" data-toggle="tab">Listado de contacto</a>
        </li>
    </ul>
</div>
<div>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="perfil"><br>
			{{-- @include('cuentas.perfil') --}}
			<table class="table">
			<tr class="bg-primary">
				<td>
					<h5 class="text-center">
						#
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Nombre
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Email
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Teléfono
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Comentarios
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Acciones
					</h5>
				</td>
			</tr>
			@if(isset($contacto))
				@foreach($contacto as $directorio)
					<tr>
						<td>
							<h5 class="text-center">
								{{$directorio['id']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['nombre']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['email']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['telefono']}}
							</h5>
						</td>
						<td>
							<div class="small text-capitalize">
								{!! substr($directorio['comentarios'],0,50)!!}
							</div>
						</td>
						<td class="text-center">
							
							<a href="#" data-toggle="modal" data-target="#myModal{{$directorio['id']}}" class="text-center text-danger btn">
								<i class="text-center fa fa-close"></i> Eliminar
							</a>
						</td>
					</tr>
				@endforeach
			@endif
		</table>
		</div>
		
		
	</div>
</div>

@if(isset($contacto))
	@foreach($contacto as $directorio)
		<!-- Modal -->
		<div class="modal fade" id="myModal{{$directorio['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
		    {!! Form::open(array('url'=> '/administrador/contacto/'.$directorio['id'], 'method'=> 'DELETE', 'files' => true ,)) !!}
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