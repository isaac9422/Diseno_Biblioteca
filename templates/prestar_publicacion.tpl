{if isset($smarty.session.libros)}
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
{else}
    <h4>No tienes ninguna publicación seleccionada</h4>
    <br>
    <button class="btn btn-info" onclick="function1()" name="prestar" disabled>Prestar</button>
{/if}
<button class="btn btn-warning" onclick="function2()" name="cancelar">Cancelar</button>
<script >
    function function1() {
        location.href = 'prestar_publicacion.php?option=prestar';
    }
    function function2() {
        location.href = 'index.php';
    }
</script>
