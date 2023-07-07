@extends('layouts.app')
@section('content')
<div class="panel-header">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs text-regular" role="tablist">
        <li role="presentation" class="active">
            <a href="{{ route('recomendaciones.create') }}">Crear nuevo mensaje</a>
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
						Correo Electronico
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Mensaje
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Recomendación
					</h5>
				</td>
				{{-- <td>
					<h5 class="text-center">
						Archivo
					</h5>
				</td> --}}
				<td>
					<h5 class="text-center">
						Acciones
					</h5>
				</td>
			</tr>
			@if(isset($recomendaciones))
				@foreach($recomendaciones as $directorio)
					<tr>
						<td>
							<h5 class="text-center">
								{{$directorio['id']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['correo_usuario']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['mensaje']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['recomendacion']}}
							</h5>
						</td>
						{{-- <td>
							<h5 class="text-left">
								{{$directorio['titulo_proyectos']}}
							</h5>
						</td>
						<td>
							<div class="small text-capitalize" style="max-width: 260px;">
								{!!substr($directorio['descripcion_proyectos'], 0, 100)!!}...
							</div>
						</td>
						<td>
							<h5 class="text-center">
								@if($directorio['archivo'] != NULL)
									<img src="{{asset($directorio['archivo'])}}" alt="" class="img-responsive center-block" style="height: 50px;">
								@else
									No hay archivo
								@endif
							</h5>
						</td> --}}
						<td class="text-center">
							<a href="{{route('recomendaciones.show',$directorio['id'])}}" class="text-center text-info btn">
								<i class="text-center fa fa-pencil"></i> Editar
							</a>
							<form method="POST" action="/recomendaciones/{{$directorio['id']}}">
								@csrf
								{{method_field('DELETE')}}
								<button type="submit" class="btn btn-danger">Eliminar</button>
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

@if(isset($recomendaciones))
	@foreach($recomendaciones as $directorio)
		<!-- Modal -->
		<div class="modal fade" id="myModal{{$directorio['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<form method="DELETE" action="{{ url('recomendaciones/'.$directorio['id']) }}">
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