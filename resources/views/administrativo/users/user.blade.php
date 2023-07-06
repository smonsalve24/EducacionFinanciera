@extends('layouts.app')
@section('content')

<div class="panel-header">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs text-regular" role="tablist">
        <li role="presentation" class="active">
            <a href="{{ route('users.create') }}">Crear nuevo usuario</a>
        </li>
    </ul>
</div>
<div>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="perfil"><br>
			{{-- @include('cuentas.perfil') --}}
			<table class="table">
			<thead>
				<tr class="bg-primary">
					<th scope="col">
						<h5 class="text-center">
							#
						</h5>
					</th>
					<th scope="col">
						<h5 class="text-center">
							Nombre
						</h5>
					</th>
					<th scope="col">
						<h5 class="text-center">
							Correo
						</h5>
					</th>
					<th scope="col">
						<h5 class="text-center">
							Password
						</h5>
					</th>
					<th scope="col">
						<h5 class="text-center">
							Acciones
						</h5>
					</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($users))
					@foreach($users as $directorio)
						<tr>
							<th scope="row">
								<h5 class="text-center">
									{{$directorio['id']}}
								</h5>
							</th>
							<td>
								<h5 class="text-left">
									{{$directorio['name']}}
								</h5>
							</td>
							<td>
								<h5 class="text-left">
									{{$directorio['email']}}
								</h5>
							</td>
							<td>
								<h5 class="text-left">
									{{$directorio['password']}}
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
								<a href="{{route('users.show',$directorio['id'])}}" class="text-center text-info btn">
									<i class="text-center fa fa-pencil"></i> Editar
								</a>
								<form method="POST" action="/users/{{$directorio['id']}}">
									@csrf
									{{method_field('DELETE')}}
									<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
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

@if(isset($users))
	@foreach($users as $directorio)
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