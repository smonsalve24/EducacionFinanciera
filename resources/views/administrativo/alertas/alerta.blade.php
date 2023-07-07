@extends('layouts.app')
@section('content')
<div class="panel-header">
    <!-- Nav tabs -->
	<a href="{{ route('alerts.create') }}" class="btn btn-primary">Crear nueva alerta</a>
</div>
<div>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="perfil"><br>
			{{-- @include('cuentas.perfil') --}}
			<table class="table">
			<tr class="bg-primary">
				<td>
					<h6 class="text-center">
						#
					</h6>
				</td>
				<td>
					<h6 class="text-center">
						Titulo
					</h6>
				</td>
				<td>
					<h6 class="text-center">
						Tipo alerta
					</h6>
				</td>
				<td>
					<h6 class="text-center">
						Descripción
					</h6>
				</td>
				{{-- <td>
					<h5 class="text-center">
						Archivo
					</h5>
				</td> --}}
				<td>
					<h6 class="text-center">
						Acciones
					</h6>
				</td>
			</tr>
			@if(isset($alertas))
				@foreach($alertas as $directorio)
					<tr>
						<td>
							<h6 class="text-center">
								{{$directorio['id']}}
							</h6>
						</td>
						<td>
							<h6 class="text-center">
								{{$directorio['email_users']}}
							</h6>
						</td>
						<td>
							<h6 class="text-center">
								{{$directorio['tipo_alerta']}}
							</h6>
						</td>
						<td>
							<div class="small text-capitalize text-center" style="max-width: 260px;">
								{!! substr($directorio['mensaje'], 0, 100)!!}...
							</div>
						</td>
						<td class="text-center" style="display: flex;
						justify-content: center;align-items: center;">
							<a href="{{route('alerts.show',$directorio['id'])}}" class="text-center text-info btn border-0">
								<i class="text-center fa fa-pencil"></i> Editar
							</a>
							<form method="POST" action="/alerts/{{$directorio['id']}}">
								@csrf
								{{method_field('DELETE')}}
								<button type="submit" class="text-danger border-0 bg-white"><i class="text-center fa fa-close"></i> Eliminar</button>
						</form>
						</td>
					</tr>
				@endforeach
			@endif
		</table>
		</div>
		<div role="tabpanel" class="tab-pane " id="solicitud"><br>
			<h3 class="text-bold text-success">Creación de Item</h3>
				<p class="">
					<small>
						¬ Crea un nombre para identificar tu item. <br> ¬ Selecciona tu archivo - imagen (jpg, png, gif) no mayor a un tamaño de 1 MB . <br> ¬ Ingresa una pequeña descripción para tu item. 
					</small>
				</p><br>
				
			{{-- @include('cuentas.solicitudes') --}}
		</div>
	</div>
</div>

@if(isset($alertas))
	@foreach($alertas as $directorio)
		<!-- Modal -->
		<div class="modal fade" id="myModal{{$directorio['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<form method="DELETE" action="{{ url('alerts/'.$directorio['id']) }}">
					@csrf
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
				</form>
			</div>
		</div>
	@endforeach
@endif
@endsection