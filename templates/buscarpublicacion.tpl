
<table border="0" width="100%" cellpadding="0" cellspacing="10" >
    <tr> 
        <td> <form action="{$gvar.l_global}buscarPublicacion.php?option=lookup" method="post">
                <select name ="criterioBusqueda">
                    <option value="by_codigo_publicacion">código de publicación</option>
                    <option value="by_autor"> autor</option>
                    <option value="by_nombre">nombre publicación</option>
                </select> 
                <input type='text' name='textoBusqueda' placeholder='Buscar'>
                <button class="btn btn-success">Buscar</button>
            </form>
        </td> 

    </tr>
    <tr>
        <td>
            <form action="{$gvar.l_global}buscarPublicacion.php" method="post">
            <table id="busqueda" class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr style="font-weight: bold;">
                        <td>Código Biblioteca</td>
                        <td>Código Publicación</td>
                        <td>Categoría</td>
                        <td>Tipo</td>
                        <td>Nombre</td>
                        <td>Fecha de publicación</td>
                        <td>Nombre Autor</td>
                        <td>Prestar</td>
                    </tr>
                </thead>
                {section loop=$publicacion name=i}

                    <tr>
                        <td> {$publicacion[i]->get('codigo_biblioteca')}</td>   
                        <td> {$publicacion[i]->get('codigo_publicacion')}</td> 
                        <td> {$publicacion[i]->get('categoria')}</td> 
                        <td> {$publicacion[i]->get('tipo')}</td> 
                        <td> {$publicacion[i]->get('nombre')}</td> 
                        <td> {$publicacion[i]->get('fecha_publicacion')}</td> 
                        <td> {$publicacion[i]->auxiliars['nombreAutor']}</td> 
                        <td style="text-align: center;"><input type="checkbox" name="buscados[]" value="{$publicacion[i]->get('nombre')},{$publicacion[i]->get('codigo_biblioteca')},{$publicacion[i]->get('codigo_publicacion')},{$publicacion[i]->get('clasificacion')}"/></td>
                    </tr>

                {/section}


            </table>
                
            <br/>
            <button class="btn btn-success">Prestar</button>
            <button class="btn btn-inverse" name="adicionar">Adicionar</button>
            </form>
        </td> 
    </tr>
</table>