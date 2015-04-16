<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <b></b><br /><br />

        <table cellspacing="0" cellpadding="0"><tr><td class="font-white" align="center">
                    {if isset($smarty.session.objeto_usuario)}
                        <form class="well well-small form-search" action="{$gvar.l_global}login.php" method="post">
                            <input type="submit" class="btn btn-primary" name ="btn_salir" value="Salir"></input>
                        </form>
                    {else}
                        <form class="well well-small form-search" action="{$gvar.l_global}login.php" method="post" name="login">

                            <input name="email" type="email" class="input-medium" placeholder="Email *" required><br /><br />
                            <input name="contraseña" type="password" class="input-medium" placeholder="Contraseña *" required><br />
                            <input class="radio" type="radio" name="rol" value="usuario" checked><font color="Black">Usuario   </font ><br>
                            <input class="radio" type="radio" name="rol" value="administrador"><font color="Black">Administrador   </font ><br>
                            <input class="radio" type="radio" name="rol" value="empleado"><font color="Black">Empleado   </font ><br>

                            <input type="submit" class="btn btn-primary" name ="btn_ingresar" value="Ingresar"></input>
                        </form>
                    {/if}
                </td></tr></table>
    </body>
</html>