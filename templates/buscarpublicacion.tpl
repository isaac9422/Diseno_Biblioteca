
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
    {section loop=$publicacion name=i}
        <tr><td><b>Código Biblioteca:</b> {$publicacion[i]->get('codigo_biblioteca')}<br />
                <b>Código Publicación:</b> {$publicacion[i]->get('codigo_publicacion')}<br />
                <b>Categoría:</b> {$publicacion[i]->get('categoria')}<br />
                <b>Tipo:</b> {$publicacion[i]->get('tipo')}<br />
                <b>Nombre:</b> {$publicacion[i]->get('nombre')}<br />
                <b>Fecha de publicación:</b> {$publicacion[i]->get('fecha_publicacion')}<br />
                <b>Nombre Autor:</b> {$publicacion[i]->auxiliars['nombreAutor']}<br />

            </td></tr>
        {/section}
</table>