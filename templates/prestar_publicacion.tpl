<h4>Actualmente tienes seleccionado los siguientes elementos:</h4>
<br>
<div id="example"class="square table-responsive">
    <table class="table table-hover table-condensed">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Código biblioteca</th>
                <th>Código publicación</th>   
                <th>Clasificación</th>
            </tr>
        </thead>
        <tbody>
            {section loop=$preview name=i}
                <tr>
                    {*<td><input type="checkbox" name="devoluciones[]" value="{$entregas[i]->get('codigo_biblioteca')},{$entregas[i]->get('fecha_inicio')},{$entregas[i]->get('fecha_fin')},{$entregas[i]->get('cantidad_renovacion')}"> </td>*}
                    <td> <input type="checkbox" name="" value="" checked="checked"/> </td>                    
                    <td>{$preview[i]->get('nombre')}</td>
                    <td>{$preview[i]->get('codigo_biblioteca')}</td>
                    <td>{$preview[i]->get('codigo_publicacion')}</td>
                    <td>{$preview[i]->get('clasificacion')}</td>
                </tr>
            {/section}
        </tbody>
    </table>
</div>
<br>
<button class="btn btn-info" onclick="function1()" name="prestar">Prestar</button>
<button class="btn btn-warning" onclick="function2()" name="cancelar">Cancelar</button>
<script >
    function function1() {
        location.href = 'prestar_publicacion.php?option=prestar';
    }
    function function2() {
        location.href = 'index.php';
    }
</script>
