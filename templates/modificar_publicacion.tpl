<div class="square">
    <form action="{$gvar.l_global}modificar_publicacion.php?option=add" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="5">
        <tr><td>
          
            <b>Ingrese el id:</b> <input type="text" name="codigo_biblioteca" /><br />
            <input class="btn btn-primary" type="submit" value="Modificar" /><br />
            
                    {if isset($codigo_biblioteca)}
                        <b>Datos de la publicación: </b> {$codigo_biblioteca}</br><br>
                    {/if}   
                    
            
   
        <tr><td>
                <b>Código Biblioteca:</b> <input type="text" name="codigo_biblioteca" /><br />
                <b>Código Publicación:</b> <input type="text" name="codigo_publicacion" /><br />
                <b>Categoría:</b> <input type="text" name="categoria" /><br />
                <b>Tipo:</b> <input type="text" name="tipo" /><br />
                <b>Nombre:</b> <input type="text" name="nombre" /><br />
                <b>Fecha de publicación:</b> <input type="text" name="fecha_publicacion" /><br />
                <b>Clasificación:</b> <input type="text" name="clasificacion" /><br />
                
    
        </td></tr>

    
            
        </td></tr></table>
    </form>
</div>