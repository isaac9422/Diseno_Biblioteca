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
                {section loop=$entregas name=i}
                    <tr>
                        <td>{$entregas[i]->get('codigo_biblioteca')}</td>
                        <td>{$entregas[i]->get('cantidad_renovacion')}</td>
                        <td>{$entregas[i]->get('fecha_inicio')}</td>
                        <td>{$entregas[i]->get('fecha_fin')}</td>
                        <td><form action="{$gvar.l_global}devolver_prestamo.php?option=devolver&codigo_biblioteca={$entregas[i]->get('codigo_biblioteca')}&fecha_inicio={$entregas[i]->get('fecha_inicio')}&fecha_fin={$entregas[i]->get('fecha_fin')}&cantidad_renovacion={$entregas[i]->get('cantidad_renovacion')}" 
                                  method="post">                                
                                <button class="btn btn-small btn-info">Devolver</button></form></td>
                    </tr>
                {/section}
            </tbody>
        </table>
    </div>
</div>
