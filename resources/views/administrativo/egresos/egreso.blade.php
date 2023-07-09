@extends('layouts.app')
@section('content')
<div class="panel-header">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs text-regular" role="tablist">
        <li role="presentation" class="active">
            <a href="{{ route('egresos.create') }}">Crear ingreso</a>
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
						valor
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Fecha
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Comentario
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Categoria 
					</h5>
				</td>
				<td>
					<h5 class="text-center">
						Acciones
					</h5>
				</td>
			</tr>
			@if(isset($egresos))
				@foreach($egresos as $directorio)
					<tr>
						<td>
							<h5 class="text-center">
								{{$directorio['id']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['valor']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['fecha']}}
							</h5>
						</td>
						<td>
							<h5 class="text-left">
								{{$directorio['descripcion']}}
							</h5>
						</td>
						 <td>
							<h5 class="text-left">
								@if(isset($categorias))
									@foreach($categorias as $categoria)
										@if($categoria['id'] == $directorio['categoria_egreso_id'])

										{{$categoria['nombre']}}
										@endif
									@endforeach
								@endif
							</h5>
						</td>
						{{--<td>
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
							<a href="{{route('egresos.show',$directorio['id'])}}" class="text-center text-info btn">
								<i class="text-center fa fa-pencil"></i> Editar
							</a>
							<form method="POST" action="/egresos/{{$directorio['id']}}">
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

@if(isset($egresos))
	@foreach($egresos as $directorio)
		<!-- Modal -->
		<div class="modal fade" id="myModal{{$directorio['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<form method="DELETE" action="{{ url('egresos/'.$directorio['id']) }}">
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