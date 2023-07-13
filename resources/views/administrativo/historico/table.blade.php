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
                Tipo de movimiento
            </h6>
        </th>
    </tr>
    @if (isset($arrayList))
        @foreach ($arrayList as $directorio)
            <tr>
                <td>
                    {{ $directorio['descripcion'] }}
                </td>
                <td>{{ date('d M Y', strtotime($directorio['fecha'])) }}</td>
                <td>
                    $ {{ number_format($directorio['valor'], 0) }}
                </td>

                <td class="text-center d-flex justify-content-center">
                    @if (isset($directorio['categoria_egreso_id']))
                        Egreso
                    @else
                       Ingreso
                    @endif
                </td>
            </tr>
        @endforeach
    @endif
</table>