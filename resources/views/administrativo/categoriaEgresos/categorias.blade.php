@extends('layouts.app')
@section('content')
    <div class="container text-white">
        <div class="panel-header">
            <h1>Categorías Egresos</h1>
            <p>
                Aquí podrás ingresar el listado de las categorías pertenecientes a egresos, para que los clientes puedan
                segmentar la información ingresada
            </p>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @elseif($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <!-- Nav tabs href="{{ route('categoria-egreso.create') }}" -->
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Crear nueva categoría</a>
        </div>
        <div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="perfil"><br>
                    {{-- @include('cuentas.perfil') --}}
                    <table class="table">
                        <thead>
                            <tr class="bg-primary">
                                <th>
                                    <h5 class="text-center">
                                        Id
                                    </h5>
                                </th>
                                <th>
                                    <h5 class="text-center">
                                        Categoría
                                    </h5>
                                </th>
                                <th>
                                    <h5 class="text-center">
                                        Descripción de la categoría
                                    </h5>
                                </th>
                                <th>
                                    <h5 class="text-center">
                                        Acciones
                                    </h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($catEgreso))
                                @foreach ($catEgreso as $directorio)
                                    <tr>
                                        <td>
                                            <h5 class="text-center">
                                                {{ $directorio['id'] }}
                                            </h5>
                                        </td>
                                        <td>
                                            <h5 class="text-center">
                                                {{ $directorio['nombre'] }}
                                            </h5>
                                        </td>
                                        <td>
                                            <h5 class="text-center">
                                                {{ $directorio['mensaje'] }}
                                            </h5>   
                                        </td>
                                        <td class="text-center d-flex justify-content-center align-items-center">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if (isset($catEgreso))
        @foreach ($catEgreso as $directorio)
            <!-- Modal -->
            <div class="modal fade" id="myModal{{ $directorio['id'] }}" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="{{ url('categoria-egreso/' . $directorio['id']) }}">
                        @csrf
						{{method_field('DELETE')}}
                        <div class="modal-content">
                            <div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Eliminar {{$directorio['nombre']}}</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-regular">
                                    ¿ Realmente deseas eliminar este items <strong>{{$directorio['nombre']}}</strong>?
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
    @if (isset($catEgreso))
        @foreach ($catEgreso as $directorio)
            <!-- Modal -->
            <div class="modal fade" id="myModalEdit{{$directorio['id']}}" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel{{$directorio['id']}}">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="{{ url('categoria-egreso/' . $directorio['id']) }}">
                        @csrf
						{{method_field('PUT')}}
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Editar {{$directorio['nombre']}}</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
							<div class="modal-body">
                        <div class="form-horizontal text-dark">
							<div class="form-group mb-4">
								<label for="" class="control-label text-bold">Nombre de la categoría:</label>
								<div class="col-md-12">
									<input type="text" class="form-control" name="nombre_categoria"
										placeholder="Ej:. hogar" value="{{old('nombre_categoria', $directorio['nombre'])}}">
									@error('nombre_categoria')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label text-bold">Mensaje:</label>
								<div class="col-md-12">
									<textarea name="mensaje" class="form-control" placeholder="Descripción detallada de la categoría..." rows="5">{{old('mensaje', $directorio['mensaje'])}}</textarea>
									@error('mensaje')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Actualizar</button>
					</div>
					</div>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Categoría egresos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('categoria-egreso.store') }}">
                <div class="modal-body">
                    @csrf
                    <div class="form-horizontal text-dark">
                        <div class="form-group mb-4">
                            <label for="" class="control-label text-bold">Nombre de la categoría:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nombre_categoria"
                                    placeholder="Ej:. hogar">
                                @error('nombre_categoria')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label text-bold">Mensaje:</label>
                            <div class="col-md-12">
                                <textarea name="mensaje" class="form-control" placeholder="Descripción detallada de la categoría..." rows="5"></textarea>
                                @error('mensaje')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
