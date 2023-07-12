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
						<div>
							<h2>Histórico</h2>
							<p>
								Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum aliquid ratione nesciunt quibusdam
								alias accusamus ad sit facilis rerum quasi cum omnis ipsa enim, dolore ab laboriosam id at tenetur?
							</p>
						</div>
						<div >
							<a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateIngreso">Insertar ingreso</a>
							<a class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#modalCreateEgreso">Insertar Egreso</a>
						</div>
					</div>
					<div id="movementHistory">
						<!-- Tab panes -->
								{{-- @include('cuentas.perfil') --}}
								<table class="table">
									<tr class="bg-primary">
										<td>
											Descripción
										</td>
										<td>
											<h6 class="text-center">
												Fecha
											</h6>
										</td>
										<td>
											<h5 class="text-center">
												Valor
											</h5>
										</td>
										<td>
											<h5 class="text-center">
												Acciones
											</h5>
										</td>
									</tr>
									@if (isset($arrayList))
										@foreach ($arrayList as $directorio)
											<tr>
												<td>
													@if(isset($directorio['categoria_egreso_id']))
													<h5 class="text-left text-danger">
														{{ $directorio['descripcion'] }}
													</h5>
													@else
													<h5 class="text-left text-success">
														{{ $directorio['descripcion'] }}
													</h5>
													@endif
												</td>
												<td>
													<h5 class="text-left">
														{{ date('d M Y', strtotime($directorio['fecha'])) }}
													</h5>
												</td>
												<td>
													<h5 class="text-left">
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
													</h5>
												</td>
		
												<td class="text-center">
													<a href="{{ route('historicos', $directorio['id']) }}"
														class="text-center text-info btn">
														<i class="text-center fa fa-pencil"></i> Editar
													</a>
													<form method="POST" action="/historicos/{{ $directorio['id'] }}">
														@csrf
														{{ method_field('DELETE') }}
														<button type="submit" class="btn btn-danger">Eliminar</button>
													</form>
												</td>
											</tr>
										@endforeach
									@endif
									{{-- @if (isset($egresos))
										@foreach ($egresos as $directorio)
											<tr class="text-success">
												<td>
													<h5 class="text-left text-danger">
														{{ $directorio['descripcion'] }}
													</h5>
												</td>
												<td>
													<h5 class="text-left">
														{{ date('d M Y', strtotime($directorio['fecha'])) }}
													</h5>
												</td>
												<td>
													<h5 class="text-left text-dark">
														$ <input type="text" disabled
															class="valuePriceDischarge border-0 bg-transparent"
															data-value="{{ $directorio['valor'] }}"
															value="{{ number_format($directorio['valor'], 0) }}">
													</h5>
												</td>
		
												<td class="text-center">
													<a href="{{ route('historicos', $directorio['id']) }}"
														class="text-center text-info btn">
														<i class="text-center fa fa-pencil"></i> Editar
													</a>
													<form method="POST" action="/historicos/{{ $directorio['id'] }}">
														@csrf
														{{ method_field('DELETE') }}
														<button type="submit" class="btn btn-danger">Eliminar</button>
													</form>
												</td>
											</tr>
										@endforeach
									@endif --}}
								</table>
						
					</div>
					<div id="totalValue">
						Total: <h4 class="txt-right"></h4>
					</div>
				</div>
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<table>
						<tr>
							<td></td>
						</tr>
					</table>
					@if(isset($alertas))
					@foreach ($alertas as $recomendacion)
						<div class="card p-3">
							{{ $recomendacion['mensaje'] }}
						</div>
					@endforeach
				@endif
				<button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalGestionarAlertas" >Gestionar alertas</button>
				</div>
			  </div>
            
        </div>
        <div class="col-lg-4 bg-white py-4">
            <h3>Recomendaciones</h3>
            @if(isset($recomendaciones))
                @foreach ($recomendaciones as $recomendacion)
                    <div class="card p-3">
                        {{ $recomendacion['mensaje'] }}
                    </div>
                @endforeach
            @endif

			<h3 class="mt-4">Alertas</h3>
            
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
