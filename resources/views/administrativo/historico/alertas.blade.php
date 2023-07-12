<!-- Modal -->
<div class="modal fade" id="modalGestionarAlertas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Gestionar mis alertas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('alerts.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-horizontal text-dark">
                        <div class="form-group mb-4">
                            <label for="" class="control-label text-bold">Tipo de alerta:</label>
                            <div class="col-md-12">
                                <select name="tipo_alerta" id="">
                                    <option value="0">Alerta</option>
                                    <option value="1">Advertencia</option>
                                    <option value="2">Recomendación</option>
                                </select>
                            </div>
                            @error('tipo_alerta')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="control-label text-bold">Monto mínimo</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email_users" placeholder="Ingresa el montó minimo al que debe de llegar tu cuenta">
                                @error('email_users')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label text-bold">Mensaje:</label>
                            <div class="col-md-12">
                                <textarea name="mensaje" class="form-control" placeholder="Descripción del ingreso" rows="3"></textarea>
                                @error('mensaje')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10 mt-3">
                                <input type="submit" class="btn btn-primary" value="Guardar Item">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal eliminar --}}

@if (isset($alertas))
@foreach ($alertas as $directorio)
    <!-- Modal -->
    <div class="modal fade" id="myModal{{ $directorio['id'] }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ url('alerts/' . $directorio['id']) }}">
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

{{-- Modal editar  --}}
@if (isset($alertas))
@foreach ($alertas as $directorio)
    <!-- Modal -->
    <div class="modal fade" id="myModalEdit{{$directorio['id']}}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel{{$directorio['id']}}">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ url('alerts/' . $directorio['id']) }}">
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
                        <label for="" class="control-label text-bold">Tipo de alerta:</label>
                        <div class="col-md-12">
                            <select name="tipo_alerta" id="">
                                <option value="0" @if($directorio['tipo_alerta'] == 0) selected @endif>Alerta</option>
						        <option value="1" @if($directorio['tipo_alerta'] == 1) selected @endif>Advertencia</option>
						        <option value="2" @if($directorio['tipo_alerta'] == 2) selected @endif>Recomendación</option>
                            </select>
                        </div>
                        @error('tipo_alerta')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="" class="control-label text-bold">Monto minimo:</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="email_users"
                                placeholder="Ej:. hogar" value="{{old('email_users', $directorio['email_users'])}}">
                            @error('email_users')
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
