<!-- Modal -->
<div class="modal fade" id="modalCreateEgreso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Egresos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

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
            <form method="POST" action="{{ route('egresos.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="control-label col-md-2">Valor:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="valor" placeholder="Valor">
                                @error('Valor')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-2">Fecha:</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="fecha" placeholder="fecha">
                                @error('fecha')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-2">Nota:</label>
                            <div class="col-md-6">
                                <textarea name="descripcion" class="form-control" placeholder="Descripción del ingreso" rows="3"></textarea>
                                @error('descripcion')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-2">Categoria:</label>
                            <div class="col-md-6">
                                <select name="categoria_egreso_id" id="">
                                    @if (isset($categoriasE))
                                        @foreach ($categoriasE as $categoria)
                                            <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @error('categoria_egreso_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10 mt-3">
                                <input type="submit" class="btn btn-primary" value="Guardar Item">
                            </div>
                            <div class="col-md-offset-2 col-md-10 mt-3">
                                <a href="{{ url('egresos') }}" class="btn btn-danger">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal eliminar  --}}
@if (isset($arrayList))
@foreach ($arrayList as $directorio)
    <!-- Modal -->
    @if(isset($directorio['categoria_egreso_id']))
    <div class="modal fade" id="myModalEgreso{{ $directorio['id'] }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ url('egresos/' . $directorio['id']) }}">
                @csrf
                {{method_field('DELETE')}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Eliminar {{$directorio['valor']}}</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-regular">
                            ¿ Realmente deseas eliminar este items <strong>{{$directorio['valor']}}</strong>?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
@endforeach
@endif

{{-- Modal editar  --}}
@if (isset($arrayList))
@foreach ($arrayList as $directorio)
    <!-- Modal -->
    @if(isset($directorio['categoria_egreso_id']))
    <div class="modal fade" id="myModalEditEgreso{{$directorio['id']}}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel{{$directorio['id']}}">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ url('egresos/' . $directorio['id']) }}">
                @csrf
                {{method_field('PUT')}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Editar {{$directorio['valor']}}</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                <div class="form-horizontal text-dark">

                    <div class="form-group">
                        <label for="" class="control-label col-md-2">Valor:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="valor" value="{{old('valor', $directorio['valor'])}}"placeholder="Valor">
                            @error('valor')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-2">Fecha:</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control" name="fecha" value="{{old('fecha', $directorio['fecha'])}}" placeholder="fecha">
                            @error('fecha')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label text-bold">Mensaje:</label>
                        <div class="col-md-12">
                            <textarea name="descripcion" class="form-control" placeholder="Descripción detallada de la categoría..." rows="5">{{old('descripcion', $directorio['descripcion'])}}</textarea>
                            @error('descripcion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-2">Categoria:</label>
                        <div class="col-md-6">
                            <select name="categoria_egreso_id" id="">
                                @if(isset($categoriasE))
                                    @foreach($categoriasE as $categoria)
                                        <option value="{{$categoria['id']}}" @if($categoria['id'] == $directorio['categoria_egreso_id']) selected @endif>{{$categoria['nombre']}}</option>
    
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @error('categoria_egreso_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
    @endif
@endforeach
@endif
