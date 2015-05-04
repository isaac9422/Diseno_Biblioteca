<table border="0" width="100%" cellpadding="0" cellspacing="10">
<tr><td><b></b></td></tr>
<tr> <td> <img src='images/dora.jpg' width='80' height="100"/></td> </tr>
<tr> 
    <td> <form action="{$gvar.l_global}buscarPublicacion.php?option=lookup" method="post">
        <select name ="criterioBusqueda">
            {section loop=$criterio name=j}
                <option value="{$criterio[j][0]}"> {$criterio[j][1]}</option>
                
            {/section}
        </select> 
        <input type='text' name='textoBusqueda' placeholder='buscar'/>
        <input type='submit' value='buscar' style='margin-bottom: 12px;'/>
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