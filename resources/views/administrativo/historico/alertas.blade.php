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
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="" class="control-label col-md-12">Tipo de alerta:</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="valor" placeholder="Valor">
                            @error('Valor')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-12">Ingresa el monto mínimo para generar la alerta:</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="valor" placeholder="Valor">
                            @error('Valor')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-12">Nota:</label>
                        <div class="col-md-12">
                            <textarea name="descripcion" class="form-control" placeholder="Descripción del ingreso" rows="3"></textarea>
                            @error('descripcion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
            </form>
        </div>
    </div>
</div>
