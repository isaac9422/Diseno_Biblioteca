<!-Doctype html>
<html>
    <head>
        <title>Página Modificar Perfil</title>
        <meta charset="utf-8">
        <style>
            .etiqueta{
		float: left
            }
        </style>
    </head>
    <body>
        <form action="{$gvar.l_global}modificarPerfil.php?option=modificar" method="post">
        <b class="etiqueta">Contraseña actual :</b><input type="password" name="contraseña" value="" /><br> 
        <b class="etiqueta">Nueva contraseña  :</b><input type="password" name="password" value="" /> <br> 
        <b class="etiqueta">Nombre            :</b><input type="text" name="nombre" value="" /> <br> 
        <b class="etiqueta">Email             :</b><input type="email" name="email" value="" /> <br> 
        <b class="etiqueta">Telefono          :</b><input type="tel" name="telefono" value="" /> <br> 
        <b class="etiqueta">Direccion         :</b><input type="text" name="direccion" value="" /> <br> 
        <br> 
        <input type="submit" value="Modificar" name="modificar" />
        <input type="button" value="Cancelar" name="cancelar" />
        </form>
    </body>
</html>