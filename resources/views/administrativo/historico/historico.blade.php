@extends('layouts.app')
@section('content')

    <div class="row px-0 mx-0">
        <div class="col-lg-8 py-3 text-white">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Histórico</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Alertas</button>
                    <form method="POST" action="{{ url('historicos-export/') }}" class="ms-auto">
                        @csrf
                        <div class=" d-flex align-items-baseline">
                            <h6 class="me-2"> Filtrar por fecha:</h6>
                            <div>
                                <input type="date" id="myInputInicial" name="fecha" onchange="myFunction()"
                                    placeholder="Buscar por fecha..">
                            </div>
							<div type="button" onclick="clearFecha()" class="mx-2" id="clearDate" title="limpiar filtro" style="cursor: pointer;">
								<em class="fa fa-refresh cursor-pointer" ></em>
							</div>
                            <div class="ms-3">
                                <button type="submit" title="Descargar archivo excel" class="btn btn-light">Descargar Historico <em
                                        class="fa fa-download text-secondary"></em></button>
                            </div>
                        </div>
                    </form>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="panel-header d-flex">
                        <!-- Nav tabs -->
                        <div class="col-7">
                            <h2>Histórico</h2>
                            <p>
                                En esta seccion encontraras todos tus movimientos financieros, recomendaciones y alertas
                                personalizadas
                            </p>
                        </div>
                        <div class="col-5 my-auto text-center">
                            <a class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#modalCreateIngreso">Insertar
                                ingreso</a>
                            <a class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#modalCreateEgreso">Insertar
                                Egreso</a>
                        </div>
                    </div>
                    <div id="movementHistory">
                        <!-- Tab panes -->
                        {{-- @include('cuentas.perfil') --}}
                        <table class="table" id="tableHistory">
                            <tr class="bg-primary">
                                <th>
                                    <h6 class="text-center">
                                        Descripción
                                    </h6>
                                </th>
                                <th>
                                    <h6 class="text-center">
                                        Fecha
                                    </h6>
                                </th>
                                <th>
                                    <h6 class="text-center">
                                        Valor
                                    </h6>
                                </th>
                                <th>
                                    <h6 class="text-center">
                                        Acciones
                                    </h6>
                                </th>
                            </tr>
                            @if (isset($arrayList))
                                @foreach ($arrayList as $directorio)
                                    <tr>
                                        <td>
                                            @if (isset($directorio['categoria_egreso_id']))
                                                <h6 class="text-center text-danger">
                                                    {{ $directorio['descripcion'] }}
                                                </h6>
                                            @else
                                                <h6 class="text-center text-success">
                                                    {{ $directorio['descripcion'] }}
                                                </h6>
                                            @endif
                                        </td>
                                        <td data-value='{{ date('Y-m-d', strtotime($directorio['fecha'])) }}'>
                                            <h6 class="text-center">{{ date('d M Y', strtotime($directorio['fecha'])) }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center d-flex align-items-baseline justify-content-center">
                                                @if (isset($directorio['categoria_egreso_id']))
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
                                            @if (isset($directorio['categoria_egreso_id']))
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#myModalEditEgreso{{ $directorio['id'] }}"
                                                    class="text-center text-info btn">
                                                    <i class="text-center fa fa-pencil"></i> Editar
                                                </a>
                                                <a class="text-center text-danger btn" data-bs-toggle="modal"
                                                    data-bs-target="#myModalEgreso{{ $directorio['id'] }}">
                                                    <i class="text-center fa fa-close"></i> Eliminar
                                                </a>
                                            @else
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#myModalEditIngreso{{ $directorio['id'] }}"
                                                    class="text-center text-info btn">
                                                    <i class="text-center fa fa-pencil"></i> Editar
                                                </a>
                                                <a class="text-center text-danger btn" data-bs-toggle="modal"
                                                    data-bs-target="#myModalIngreso{{ $directorio['id'] }}">
                                                    <i class="text-center fa fa-close"></i> Eliminar
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>

                    </div>
                    <div id="totalValue">
                        Total: <h4 class="txt-right"></h4>
                        <input type="hidden" name="totalMount" value=''>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="panel-header d-flex">
                        <div class="col-7">
                            <h2>Alertas</h2>
                            <p>
                                En esta seccion personalizaras todas tus alertas y notificaciones
                            </p>
                        </div>
                    </div>
                    <div id="AlertsMonto">
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
                                                {{ number_format($directorio['email_users'], 0) }}
                                            </h6>
                                        </td>
                                        <td>
                                            <div class="small text-center">
                                                {!! substr($directorio['mensaje'], 0, 100) !!}...
                                            </div>
                                        </td>

                                        <td class="text-center d-flex justify-content-center">

                                            <a data-bs-toggle="modal"
                                                data-bs-target="#myModalEdit{{ $directorio['id'] }}"
                                                class="text-center text-info btn">
                                                <i class="text-center fa fa-pencil"></i> Editar
                                            </a>
                                            <a class="text-center text-danger btn" data-bs-toggle="modal"
                                                data-bs-target="#myModal{{ $directorio['id'] }}">
                                                <i class="text-center fa fa-close"></i> Eliminar
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>

                    </div>
                    <div>
                        <button class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#modalGestionarAlertas">Gestionar alertas</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4 bg-white py-4">
            <div style="max-height: 300px;overflow: scroll;height:auto;">
                <h3>Recomendaciones</h3>
                @if (isset($recomendaciones))
                    @foreach ($recomendaciones as $recomendacion)

                    <div class="card text-dark bg-light mb-3" >
                        <div class="card-header"><h5 class="card-title mb-0">{{ $recomendacion['mensaje'] }}</h5></div>
                        <div class="card-body">
                          <p class="card-text">{{ $recomendacion['recomendacion'] }}</p>
                        </div>
                      </div>
                    @endforeach
                @endif
            </div>


            <div style="height: 60%;overflow: scroll;">
                <h3 class="mt-4">Alertas</h3>
                @if (isset($alertas))
                    @foreach ($alertas as $recomendacion)
                        @switch(true)
                            @case($recomendacion['tipo_alerta'] == 0)
                                <div class="alert alert-danger alertaValue d-none" data-alert="0"
                                    data-target-value="{{ $recomendacion['email_users'] }}" role="alert">
                                    <h4 class="alert-heading">¡Nueva Alerta!</h4>
                                    <p>{{ $recomendacion['mensaje'] }}</p>
                                    <hr>
                                    <p class="mb-0">Recuerda que acabas de exceder el monto que habias asignado:
                                        <strong>{{ $recomendacion['email_users'] }}</strong>
                                    </p>
                                </div>
                            @break

                            @case($recomendacion['tipo_alerta'] == 1)
                                <div class="alert alert-warning alertaValue d-none" data-alert="1"
                                    data-target-value="{{ $recomendacion['email_users'] }}" role="alert">
                                    <h4 class="alert-heading">¡Nueva Alerta!</h4>
                                    <p>{{ $recomendacion['mensaje'] }}</p>
                                    <hr>
                                    <p class="mb-0">Recuerda que acabas de exceder el monto que habias asignado:
                                        <strong>{{ $recomendacion['email_users'] }}</strong>
                                    </p>
                                </div>
                            @break

                            @case($recomendacion['tipo_alerta'] == 2)
                                <div class="alert alert-success alertaValue d-none" data-alert="2"
                                    data-target-value="{{ $recomendacion['email_users'] }}" role="alert">
                                    <h4 class="alert-heading">¡Nueva Alerta!</h4>
                                    <p>{{ $recomendacion['mensaje'] }}</p>
                                    <hr>
                                    <p class="mb-0">Recuerda que acabas de exceder el monto que habias asignado:
                                        <strong>{{ $recomendacion['email_users'] }}</strong>
                                    </p>
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
        const alertList = [...document.querySelectorAll('.alertaValue')];
		let buttonClear = document.getElementById('clearDate');
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

        function searchValue(list) {
            list.forEach(items => {
                valorAlerta = items.getAttribute('data-target-value');
                valorTotal = generalTotal;
                list.forEach(items1 => {
                    if (valorTotal <= valorAlerta) {
                        items.classList.remove('d-none');
                        if (valorAlerta < items1.getAttribute('data-target-value')) {
                            items1.classList.add('d-none');
                        }
                    }
                })
            })
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

        searchValue(alertList);

        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInputInicial");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableHistory");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.getAttribute('data-value');
                    if (txtValue >= filter) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

		function clearFecha(){
			document.getElementById("myInputInicial").value = '';
			myFunction()
		}
		
    </script>
@endsection
