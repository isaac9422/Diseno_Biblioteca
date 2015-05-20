{if isset($smarty.session.libros)}
    <h4>Actualmente tienes seleccionado los siguientes elementos:</h4>
    <br>
    <form action="{$gvar.l_global}prestar_publicacion.php" method="post"> 
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
                            <td> <input type="checkbox" name="prestados[]" value="{$preview[i]->get('codigo_biblioteca')},{$preview[i]->get('codigo_publicacion')}" checked="checked"/> </td>                    
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
        <button class="btn btn-success" onclick="function1()" name="prestar">Prestar</button>
        <button class="btn btn-warning" onclick="inicio()" name="cancelar">Cancelar</button>
    </form>
{else}
    <h4>No tienes ninguna publicación seleccionada</h4>
    <br>
    <button class="btn btn-success" onclick="function1()" name="prestar" disabled>Prestar</button>
    <button class="btn btn-warning" onclick="inicio()" name="cancelar">Cancelar</button>
{/if}
<script >
    function function1() {
        location.href = 'prestar_publicacion.php?option=prestar';
    }
    function inicio() {
        location.href = 'index.php';
    }
</script>
