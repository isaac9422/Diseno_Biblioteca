{*<td align="center" valign="top">*}
<div class="square">
    <h4>Actualmente tienes activo los siguientes prestamos:</h4>
    <br>
    <div id="example"class="square table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Código biblioteca</th>
                    <th>Cantidad de renovaciones</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {section loop=$prestamos name=i}
                    <tr>
                        <td>{$prestamos[i]->get('codigo_biblioteca')}</td>
                        <td>{$prestamos[i]->get('cantidad_renovacion')}</td>
                        <td>{$prestamos[i]->get('fecha_inicio')}</td>
                        <td>{$prestamos[i]->get('fecha_fin')}</td>
                        <td><form action="{$gvar.l_global}renovar_prestamo.php?option=renovar&codigo_biblioteca={$prestamos[i]->get('codigo_biblioteca')}&fecha_inicio={$prestamos[i]->get('fecha_inicio')}&fecha_fin={$prestamos[i]->get('fecha_fin')}&cantidad_renovacion={$prestamos[i]->get('cantidad_renovacion')}" 
                                  method="post">                                
                                <button class="btn btn-small btn-info">Renovar</button></form></td>
                    </tr>
                {/section}
            </tbody>
        </table>
    </div>
</div>
