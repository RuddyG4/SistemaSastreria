<x-slot:title>
    Inventario
    </x-slot>

<div>
    <div id="tab-3" class="tab-pane">
        <div class="ibox ">
            <div class="ibox-content">
                
                <div class="ibox-content">
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <h4><strong>Reporte Inventario</strong></h4>
                            
                        </div>
                        <div class="col-sm-6 text-right">
                            <h4 class="text-navy">Sastreria Maya</h4>
                            <address>
                                Av. Ballivian<br>
                                Santa Cruz Bolivia<br>
                                <abbr title="Phone"></abbr> +591 75517256
                            </address>
                            <p>
                                <span><strong>Fecha Reporte:</strong> {{now()->format('d/m/Y') }}</span>
                            </p>
                        </div>
                    </div>

                    <!--TABLA DE REPORTE DIARIO-->
                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Unidad Medida</th>
                                    <th>Cantidad Disponible</th>
                                    <th>Ubicado</th>
                                    <th>Almacen</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($datos as $dato)
                            <tr>
                                <td>{{ $dato->material->nombre }}</td>
                                <td>{{ $dato->material->medida->tipo_medida }}</td>
                                <td>
                                    {{ $dato->cantidad }} 
                                </td>
                                <td>{{ $dato->almacen->ubicacion}}</td>
                                <td>{{ $dato->almacen->nombre}}</td>
  
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                   

                </div>
            </div>
        </div>
    </div>
</div>

