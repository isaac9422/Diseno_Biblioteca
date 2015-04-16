<!-Doctype html>
<html>
    <head>
        <title>Página Modificar Perfil</title>
        <meta charset="utf-8">
        <style>
            .etiq{
                display: inline-block;
                width: 95px;
                vertical-align: middle;
            }
            .campos{
                display: block;
                vertical-align: middle;
                margin: 10px;
            }
        </style>
    </head>
    <body>
        <form action="{$gvar.l_global}modificarPerfil.php" method="post">
            <b class="etiq">Contraseña actual :</b><input class="campos" type="password" name="password" value="{$objeto->get('contraseña')}" /><br> 
            <b class="etiq">Nueva contraseña  :</b><input class="campos" type="password" name="contraseña" value="" /> <br> 
            <b class="etiq">Nombre            :</b><input class="campos" type="text" name="nombre" value="{$objeto->get('nombre')}" /> <br> 
            <b class="etiq">Email             :</b><input class="campos" type="email" name="email" value="{$objeto->get('email')}" /> <br>
            <b class="etiq">Email             :</b><input class="campos" type="hidden" name="emailOld" value="{$objeto->get('email')}" /> <br>
            <b class="etiq">Telefono          :</b><input class="campos" type="tel" name="telefono" value="{$objeto->get('telefono')}" /> <br> 
            <b class="etiq">Direccion         :</b><input class="campos" type="text" name="direccion" value="{$objeto->get('direccion')}" /> <br> 
            <br> 
            <input class="btn btn-primary" type="submit" value="Modificar" name="modificar" />
            <input class="btn btn-warning" type="submit" value="Cancelar" name="cancelar" />
        </form>
    </body>
</html>