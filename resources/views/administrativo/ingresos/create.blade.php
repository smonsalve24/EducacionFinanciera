@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @if($message = Session::get('success'))
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
        <form method="POST" action="{{ route('ingresos.store') }}">
            @csrf
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
                        <select name="categoria_ingreso_id" id="">
                            @if(isset($categorias))
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria['id']}}">{{$categoria['nombre']}}</option>

                            @endforeach
                            @endif
                        </select>
                    </div>
                    @error('categoria_ingreso_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 mt-3">
                        <input type="submit" class="btn btn-primary" value="Guardar Item">
                    </div>
                    <div class="col-md-offset-2 col-md-10 mt-3">
                        <a href="{{url('ingresos')}}" class="btn btn-danger">Regresar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection