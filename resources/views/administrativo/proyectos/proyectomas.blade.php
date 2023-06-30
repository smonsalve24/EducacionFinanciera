|@extends('layouts.app')
@section('content')
<div class="panel-header">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs text-regular" role="tablist">
        <li role="presentation" class="active">
            <a href="{{ Request::is('administrador/proyectos/create') ? '/#perfil' : '#perfil' }} " aria-controls="perfil" role="tab" data-toggle="tab">Editar proyecto</a>
        </li>
        <li role="presentation">
            <a href="#galeria" aria-controls="galeria" role="tab" data-toggle="tab">Galería</a>
        </li>
    </ul>
</div>
<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="perfil"><br>
        @if(isset($proyectos))
        	<h3 class="text-regular"><strong>Editar Item:</strong> {{$proyectos['titulo']}} </h3>
            {!! Form::open(array('url'=> '/administrador/proyectosmas/'.$proyectos['id'], 'method'=> 'PUT', 'files' => true ,)) !!}
            {!! Form::token() !!}
        		<div class="form-horizontal">
            		<div class="form-group">
            			<label for="" class="control-label col-md-2">Nombre:</label>
            			<div class="col-md-6">
            				<input type="text" class="form-control" value="{{$proyectos['titulo']}}" name="titulo" placeholder="Nombre">
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="" class="control-label col-md-2">Archivo:</label>
            			<div class="col-md-6">
            				<input type="file" class="form-control" value="{{$proyectos['archivo']}}" name="archivo" placeholder="Archivo">
            			</div>
            		</div>
            		<div class="form-group">
            			<label for="" class="control-label col-md-2">Descripción:</label>
            			<div class="col-md-6">
            				<textarea name="descripcion" class="form-control" placeholder="Descripción de Sider..." rows="7">{{$proyectos['informacion']}}</textarea>
            			</div>
            		</div>
            		<div class="form-group">
            			<div class="col-md-offset-3 col-md-2">
            				<input type="submit" class="btn btn-success" value="Actualizar Slider">
            			</div>
            			<div class="col-md-3">
            				<a href="{{url('administrador/proyectos')}}" class="btn btn-danger">Cancelar y Regresar</a>
            			</div>
            		</div>
            	</div>
        	{{Form::close()}}
        @endif
     </div>
     <div role="tabpanel" class="tab-pane" id="galeria">
        <h2 class="text-regular text-left">Galería</h2>
            <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-info">Crear Galeria</a>
        @if(isset($galerias) && count($galerias) > 0)
            <hr>
            @foreach($galerias as $galeria)
                <div class="col-md-3 text-center">
                    <img src="{{asset($galeria['foto'])}}" alt="" class="img-responsive center-block" style="max-height: 180px;">
                    <h5 class="text-center text-regular">{{$galeria['titulo']}}</h5>
                    <br>
                    <span data-toggle="modal" data-target="#myModale{{$galeria['id']}}">
                        <i class="fa fa-pencil text-success" style="font-size: 22px;"></i>
                    </span>
                    <span data-toggle="modal" data-target="#myModal{{$galeria['id']}}">
                        <i class="fa fa-close text-danger" style="font-size: 22px;"></i>
                    </span>
                </div>
            @endforeach
        @endif
    </div>
    <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                    {!! Form::open(array('url'=> '/administrador/galeria','method'=> 'POST', 'files' => true ,)) !!}
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
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" value="" name="titulo" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label col-md-2">Imagen:</label>
                                        <div class="col-md-10">
                                        {{-- <textarea name="descripcion" id="" class="form-control"></textarea> --}}
                                            <input type="file" name="foto" value="" class="form-control" >
                                            <input type="hidden" name="subproyecto_id" value="{{$proyectos['id']}}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="text-center col-md-12">
                                            <input type="submit" class="btn btn-primary" value="Crear">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{Form::close()}}
                    </div>
                </div>
                @if(isset($galerias) && count($galerias) > 0)
                    @foreach($galerias as $galeria)
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$galeria['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                            {!! Form::open(array('url'=> '/administrador/galeria/'.$galeria['id'], 'method'=> 'DELETE', 'files' => true ,)) !!}
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
                        <!-- Modal -->
                        <div class="modal fade" id="myModale{{$galeria['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                            {!! Form::open(array('url'=> '/administrador/galeria/'.$galeria['id'],'method'=> 'PUT', 'files' => true ,)) !!}
                            {!! Form::token() !!}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Actualizar Contenido</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-horizontal"><br>
                                            <div class="form-group">
                                                <label for="" class="control-label col-md-2">Nombre:</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" value="{{$galeria['titulo']}}" name="titulo" placeholder="Nombre">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label col-md-2">Imagen:</label>
                                                <div class="col-md-10">
                                                {{-- <textarea name="descripcion" id="" class="form-control"></textarea> --}}
                                                    <input type="file" name="foto" value="{{$galeria['foto']}}" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="text-center col-md-12">
                                                    <input type="submit" class="btn btn-success" value="Actualizar">
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

    </div>
</div>
@endsection