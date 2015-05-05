<!-DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <style>
            b{
                display: inline-block;
                width: 90px;
                vertical-align: middle;
            }
            input{
                display: block;
                vertical-align: middle;
                margin: 3px;
            }
        </style>
    </head>
    <body>

<div class="square">
    <form action="{$gvar.l_global}modificar_publicacion.php?option=modificar" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="5">
        <tr><td>
          
        
            <b>MODIFICAR PUBLICACION</b><br /><br />
       
            <b>Código Biblioteca:</b> <input type="text" name="codigo_biblioteca" value="{if isset($object)}{$object->get('codigo_biblioteca')}{/if}" readonly="readonly" /><br />
            <b>Código Publicación:</b> <input type="text" name="codigo_publicacion" value="{if isset($object)}{$object->get('codigo_publicacion')}{/if}"/><br />
            <b>Categoría:</b> <input type="text" name="categoria" value="{if isset($object)}{$object->get('categoria')}{/if}"/><br />
            <b>Tipo:</b> <input type="text" name="tipo" value="{if isset($object)}{$object->get('tipo')}{/if}"/><br />
            <b>Nombre:</b> <input type="text" name="nombre" value="{if isset($object)}{$object->get('nombre')}{/if}"/><br />
            <b>Fecha de publicación:</b> <input type="text" name="fecha_publicacion" value="{if isset($object)}{$object->get('fecha_publicacion')}{/if}"/><br />
            <b>Clasificación:</b> <input type="text" name="clasificacion" value="{if isset($object)}{$object->get('clasificacion')}{/if}" /><br />
            <b>Ejemplares disponibles:</b> <input type="text" name="cantidad_disponible" value="{if isset($object)}{$object->get('cantidad_disponible')}{/if}" /><br />
            <b>cantidad total:</b> <input type="text" name="cantidad_total" value="{if isset($object)}{$object->get('cantidad_total')}{/if}" /><br />
            <input class="btn btn-primary" type="submit" value="Modificar" /><br />
            
                      
        </td></tr></table>
    </form>
</div>
</body>
</html>