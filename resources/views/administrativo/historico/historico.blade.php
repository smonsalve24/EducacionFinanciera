@extends('layouts.app')
@section('content')

    <div class="row px-0 mx-0">
        <div class="col-lg-8 py-3 text-white">
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
				  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Histórico</button>
				  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Alertas</button>
				</div>
			  </nav>
			  <div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<div class="panel-header d-flex">
						<!-- Nav tabs -->
						<div class="col-7">
							<h2>Histórico</h2>
							<p>
								En esta seccion encontraras todos tus movimientos financieros, recomendaciones y alertas personalizadas
							</p>
						</div>
						<div class="col-5 my-auto text-center">
							<a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreateIngreso">Insertar ingreso</a>
							<a class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#modalCreateEgreso">Insertar Egreso</a>
						</div>
					</div>
					<div id="movementHistory">
						<!-- Tab panes -->
								{{-- @include('cuentas.perfil') --}}
								<table class="table">
									<tr class="bg-primary">
										<td>
											<h6 class="text-center">
											 	Descripción
											</h6>
										</td>
										<td>
											<h6 class="text-center">
												Fecha
											</h6>
										</td>
										<td>
											<h6 class="text-center">
												Valor
											</h6>
										</td>
										<td>
											<h6 class="text-center">
												Acciones
											</h6>
										</td>
									</tr>
									@if (isset($arrayList))
										@foreach ($arrayList as $directorio)
											<tr>
												<td>
													@if(isset($directorio['categoria_egreso_id']))
													<h6 class="text-center text-danger">
														{{ $directorio['descripcion'] }}
													</h6>
													@else
													<h6 class="text-center text-success">
														{{ $directorio['descripcion'] }}
													</h6>
													@endif
												</td>
												<td>
													<h6 class="text-center">
														{{ date('d M Y', strtotime($directorio['fecha'])) }}
													</h6>
												</td>
												<td>
													<h6 class="text-center">
														@if(isset($directorio['categoria_egreso_id']))
														$ <input type="text" disabled
															class="valuePriceDischarge border-0 bg-transparent"
															data-value="{{ $directorio['valor'] }}"
															value="{{ number_format($directorio['valor'], 0) }}">
															@else
															$ <input type="text" disabled
															class="valuePriceEntry border-0 bg-transparent"
															data-value="{{ $directorio['valor'] }}"
															value="{{ number_format($directorio['valor'], 0) }}">
															@endif
													</h6>
												</td>
		
												<td class="text-center d-flex justify-content-center">
													<a data-bs-toggle="modal" data-bs-target="#myModalEdit{{ $directorio['id'] }}" class="text-center text-info btn">
														<i class="text-center fa fa-pencil"></i> Editar
													</a>
													<a class="text-center text-danger btn" data-bs-toggle="modal" data-bs-target="#myModal{{ $directorio['id'] }}">
														<i class="text-center fa fa-close"></i> Eliminar
													</a>
												</td>
											</tr>
										@endforeach
									@endif
								</table>
						
					</div>
					<div id="totalValue">
						Total: <h4 class="txt-right"></h4>
					</div>
				</div>
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<div class="col-7">
						<h2>Alertas</h2>
						<p>
							En esta seccion personalizaras todas tus alertas y notificaciones
						</p>
					</div>
					<div>
						<!-- Tab panes -->
								{{-- @include('cuentas.perfil') --}}
								<table class="table">
									<tr class="bg-primary">
										<td>
											<h6 class="text-center">
												Tipo de notificación
											</h6>
										</td>
										<td>
											<h6 class="text-center">
												Monto mínimo
											</h6>
										</td>
										<td>
											<h6 class="text-center">
												Mensaje
											</h6>
										</td>
										<td>
											<h6 class="text-center">
												Acciones
											</h6>
										</td>
									</tr>
									@if (isset($alertas))
										@foreach ($alertas as $directorio)
											<tr>
												<td>
													@switch(true)
														@case($directorio['tipo_alerta'] == 0)
														<h6 class="text-center">Alerta</h6>
															@break

														@case($directorio['tipo_alerta'] == 1)
														<h6 class="text-center">Advertencia</h6>
															@break

														@case($directorio['tipo_alerta'] == 2)
														<h6 class="text-center">Recomendación</h6>
															@break
													@endswitch
												</td>
												<td>
													<h6 class="text-center">
														{{$directorio['email_users']}}
													</h6>
												</td>
												<td>
													<div class="small text-center">
														{!! substr($directorio['mensaje'], 0, 100)!!}...
													</div>
												</td>
		
												<td class="text-center d-flex justify-content-center">

													<a data-bs-toggle="modal" data-bs-target="#myModalEdit{{ $directorio['id'] }}" class="text-center text-info btn">
														<i class="text-center fa fa-pencil"></i> Editar
													</a>
													<a class="text-center text-danger btn" data-bs-toggle="modal" data-bs-target="#myModal{{ $directorio['id'] }}">
														<i class="text-center fa fa-close"></i> Eliminar
													</a>

												</td>
											</tr>
										@endforeach
									@endif
								</table>
						
					</div>
					
				<button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalGestionarAlertas" >Gestionar alertas</button>
				</div>
			  </div>
            
        </div>
        <div class="col-lg-4 bg-white py-4">
			<div>
				<h3>Recomendaciones</h3>
				@if(isset($recomendaciones))
					@foreach ($recomendaciones as $recomendacion)
						<div class="card p-3">
							{{ $recomendacion['mensaje'] }}
						</div>
					@endforeach
				@endif
			</div>
			<div style="height: 60%;overflow: scroll;">
				<h3 class="mt-4">Alertas</h3>
				@if(isset($alertas))
					@foreach ($alertas as $recomendacion)
					@switch(true)
						@case($recomendacion['tipo_alerta'] == 0)
						
							<div class="alert alert-danger" role="alert">
								<h4 class="alert-heading">¡Nueva Alerta!</h4>
								<p>{{ $recomendacion['mensaje'] }}</p>
								<hr>
								<p class="mb-0">Recuerda que acabas de exceder el monto que habias asignado: <strong>{{ $recomendacion['email_users'] }}</strong></p>
								</div>
					
							@break
	
						@case($recomendacion['tipo_alerta'] == 1)
						<div class="alert alert-warning" role="alert">
							<h4 class="alert-heading">¡Nueva Alerta!</h4>
							<p>{{ $recomendacion['mensaje'] }}</p>
							<hr>
							<p class="mb-0">Recuerda que acabas de exceder el monto que habias asignado: <strong>{{ $recomendacion['email_users'] }}</strong></p>
							</div>
							@break
	
						@case($recomendacion['tipo_alerta'] == 2)
						<div class="alert alert-success" role="alert">
							<h4 class="alert-heading">¡Nueva Alerta!</h4>
							<p>{{ $recomendacion['mensaje'] }}</p>
							<hr>
							<p class="mb-0">Recuerda que acabas de exceder el monto que habias asignado: <strong>{{ $recomendacion['email_users'] }}</strong></p>
							</div>
							@break
					@endswitch
					@endforeach
				@endif
			</div>
        </div>
    </div>

    {{-- 
@if (isset($historicos))
	@foreach ($historicos as $directorio)
		<!-- Modal -->
		<div class="modal fade" id="myModal{{$directorio['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<form method="DELETE" action="{{ url('historicos/'.$directorio['id']) }}">
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
@endif --}}
@include('administrativo.historico.crearIngreso');
@include('administrativo.historico.crearEgreso');
@include('administrativo.historico.alertas');
@endsection

@section('scripts-personal')
    <script>
        let fieldTotal = document.querySelector('#totalValue h4');
        const entries = [...document.querySelectorAll('.valuePriceEntry')];
        const discharges = [...document.querySelectorAll('.valuePriceDischarge')];
        let totalEntries = 0;
        let totalDischarges = 0;
        let generalTotal = 0;

        function sumar(params) {
            let valor = 0;
            params.forEach(items => {
                valor = valor + parseInt(items.getAttribute('data-value'));
            });
            return valor;
        }

        totalEntries = sumar(entries);
        totalDischarges = sumar(discharges);
        generalTotal = (totalEntries - totalDischarges);

        fieldTotal.innerHTML = '$ ' + generalTotal.toLocaleString('es', {
            style: 'currency',
            currency: 'COP',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        });
    </script>
@endsection
