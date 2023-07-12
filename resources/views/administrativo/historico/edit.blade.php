@extends('layouts.app')
@section('content')
<div class="panel-header">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs text-regular" role="tablist">
        <li role="presentation" class="active">
            <a href="{{ Request::is('administrador/servicios/create') ? '/#perfil' : '#perfil' }} " aria-controls="perfil" role="tab" data-toggle="tab">Editar servicio</a>
        </li>
        <li role="presentation">
            <a href="{{ Request::is('administrador/servicios/create') ? '/#solicitud' : '#solicitud' }}" aria-controls="solicitud" role="tab" data-toggle="tab">Más servicios</a>
        </li>
    </ul>
</div>
<div>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="perfil"><br>
            @if(isset($servicios))
            	<h3 class="text-regular"><strong>Editar Item:</strong> {{$servicios['titulo']}} </h3>
                {!! Form::open(array('url'=> '/administrador/servicios/'.$servicios['id'], 'method'=> 'PUT', 'files' => true ,)) !!}
                {!! Form::token() !!}
            		<div class="form-horizontal">
                		<div class="form-group">
                			<label for="" class="control-label col-md-2">Nombre:</label>
                			<div class="col-md-6">
                				<input type="text" class="form-control" value="{{$servicios['titulo']}}" name="titulo" placeholder="Nombre">
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="" class="control-label col-md-2">Archivo:</label>
                			<div class="col-md-6">
                				<input type="file" class="form-control" value="{{$servicios['archivo']}}" name="archivo" placeholder="Archivo">
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="" class="control-label col-md-2">Descripción:</label>
                			<div class="col-md-6">
                				<textarea name="descripcion" class="form-control" placeholder="Descripción de Sider..." rows="7">{{$servicios['informacion']}}</textarea>
                			</div>
                		</div>
                		<div class="form-group">
                			<div class="col-md-offset-3 col-md-2">
                				<input type="submit" class="btn btn-success" value="Actualizar servicios">
                			</div>
                			<div class="col-md-3">
                				<a href="{{url('administrador/servicios')}}" class="btn btn-danger">Cancelar y Regresar</a>
                			</div>
                		</div>
                	</div>
            	{{Form::close()}}
            @endif
        </div>
        <div role="tabpanel" class="tab-pane" id="solicitud"><br>
            <span class="text-regular"><strong></strong> {{$servicios['titulo']}} </span>
            <a href="#" data-toggle="modal" data-target="#myModala" class="text-center btn btn-success">Agregar nuevo item</a><br>
            <div><br>
                <table class="table table">
                    <tr class="bg-primary">
                        <td>
                            <h5 class="text-center text-regular text-uppercase">
                                #ID
                            </h5>
                        </td>
                        <td>
                            <h5 class="text-center text-regular text-uppercase">
                                Nombre
                            </h5>
                        </td>
                        <td>
                            <h5 class="text-center text-regular text-uppercase">
                                Imagen
                            </h5>
                        </td>
                        <td>
                            <h5 class="text-center text-regular text-uppercase">
                                Descripción
                            </h5>
                        </td>
                        <td>
                            <h5 class="text-center text-regular text-uppercase">
                                Acciones
                            </h5>
                        </td>
                    </tr>
                    @if(isset($serviciosmas))
                        @foreach($serviciosmas as $serviciosma)
                            <tr>
                                <td class="text-center">
                                    <h5 class="text-center">
                                        {{$serviciosma['id']}}
                                    </h5>
                                </td>
                                <td class="text-center">
                                    <h5>
                                        {!! $serviciosma['titulo'] !!}
                                    </h5>
                                </td>
                                <td class="text-center">
                                    @if($serviciosma['foto'] != NULL)
                                        <img src="{{asset($serviciosma['foto'])}}" alt="" class="img-responsive center-block" style="height: 100px;">
                                    @else
                                        Imagen no disponible
                                    @endif
                                </td>
                                <td class="text-center">
                                    {!! substr($serviciosma['informacion'],0,130) !!}
                                </td>
                                <td class="text-center">
                                    <a href="#" data-toggle="modal" data-target="#myModale{{$serviciosma['id']}}" class="text-center text-info">
                                        <i class="text-center fa fa-pencil"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#myModal{{$serviciosma['id']}}" class="text-center text-danger">
                                        <i class="text-center fa fa-close"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>

            <div class="modal fade" id="myModala" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                {!! Form::open(array('url'=> '/administrador/serviciosmas', 'method'=> 'POST', 'files' => true ,)) !!}
                {!! Form::token() !!}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Crear Contenido</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-horizontal"><br>
                                <div class="form-group">
                                    <label for="" class="control-label col-md-2">Nombre:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="" name="titulo" placeholder="Nombre">
                                        <input type="hidden" class="form-control" value="{{$servicios['id']}}" name="servicio_id" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-md-2">Archivo:</label>
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" value="" name="archivo" placeholder="Archivo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-md-2">Descripción:</label>
                                    <div class="col-md-10">
                                        <textarea name="descripcion" class="form-control" placeholder="Descripción de Sider..." rows="7"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-2">
                                        <input type="submit" class="btn btn-success" value="Agregar item">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{Form::close()}}
                </div>
            </div>

        </div>
    </div>
</div>

@if(isset($serviciosmas))
    @foreach($serviciosmas as $serviciosma)
    <div class="modal fade" id="myModale{{$serviciosma['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(array('url'=> '/administrador/serviciosmas/'.$serviciosma['id'], 'method'=> 'PUT', 'files' => true ,)) !!}
            {!! Form::token() !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Contenido</h4>
                </div>
                <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="" class="control-label col-md-2">Nombre:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="{{$serviciosma['titulo']}}" name="titulo" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-2">Archivo:</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control" value="{{$serviciosma['foto']}}" name="archivo" placeholder="Archivo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-2">Descripción:</label>
                        <div class="col-md-10">
                            <textarea name="descripcion" class="form-control" placeholder="Descripción de Sider..." rows="7">{{$serviciosma['informacion']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-2">
                            <input type="submit" class="btn btn-success" value="Actualizar servicios">
                        </div>
                    </div>
                </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
    @endforeach
@endif

@if(isset($serviciosmas))
    @foreach($serviciosmas as $serviciosma)
        <!-- Modal -->
        <div class="modal fade" id="myModal{{$serviciosma['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
            {!! Form::open(array('url'=> '/administrador/serviciosmas/'.$serviciosma['id'], 'method'=> 'DELETE', 'files' => true ,)) !!}
            {!! Form::token() !!}
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
            {{Form::close()}}
            </div>
        </div>
    @endforeach
@endif
@endsection