{if is_empty($entregas)}
    <h3>Actualmente, no tienes prestamos activos</h3>
    <br>            
    <button class="btn btn-warning" onclick="volver()" name="cancelar">Cancelar</button>
{else}
    <h4>Actualmente tienes activo los siguientes prestamos:</h4>
    <br>
    <form action="{$gvar.l_global}devolver_prestamo.php"method="post">
        <div id="example" class="square table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th></th>
                        <th>Código biblioteca</th>
                        <th>Nombre</th>
                        <th>Número de renovaciones</th>
                        <th>Fecha Inicio</th>   
                        <th>Fecha Fin</th>
                    </tr>
                </thead>
                <tbody>
                    {section loop=$entregas name=i}
                        <tr>
                            <td><input type="checkbox" name="devoluciones[]" value="{$entregas[i]->get('codigo_biblioteca')},{$entregas[i]->get('fecha_inicio')},{$entregas[i]->get('fecha_fin')},{$entregas[i]->get('cantidad_renovacion')}"> </td>
                            <td>{$entregas[i]->get('codigo_biblioteca')}</td>
                            <td>{$entregas[i]->get('nombre')}</td>
                            <td>{$entregas[i]->get('cantidad_renovacion')}</td>
                            <td>{$entregas[i]->get('fecha_inicio')}</td>
                            <td>{$entregas[i]->get('fecha_fin')}</td>
                        </tr>
                    {/section}
                </tbody>
            </table>
        </div>
        <br>            
        <button class="btn btn-success" name="devolver">Devolver</button>
        <button class="btn btn-warning" onclick="volver()" name="cancelar">Cancelar</button>
    </form>
{/if}

<script >
    function volver() {
        location.href = 'index.php';
    }
</script>