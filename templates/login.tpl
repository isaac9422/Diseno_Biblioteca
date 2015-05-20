<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <img src='images/dora.jpg' alt="Biblioteca Dora" width='60%' height="100px" />    
        <br>
        <br>
        <table cellspacing="0" cellpadding="0"><tr><td class="font-white" align="center">    
                    {if isset($smarty.session.objeto_usuario)}
                        <form class="well well-small form-search" action="{$gvar.l_global}login.php" method="post">
                            <button class="btn btn-primary" name ="btn_salir">Salir</button>
                        </form>
                    {else}
                        <form class="well well-small form-search" action="{$gvar.l_global}login.php" method="post" name="login">
                            <input name="email" type="email" class="input-small" placeholder="Email *" required><br>
                            <input name="contraseña" type="password" class="input-small" placeholder="Contraseña *" required>
                            <div class="center-block"  align="left">
                                <br>
                            <input class="radio" type="radio" name="rol" value="usuario"><font color="Black">  Usuario</font ><br>
                            <input class="radio" type="radio" name="rol" value="administrador"><font color="Black">  Administrador   </font ><br>
                            <input class="radio" type="radio" name="rol" value="empleado"><font color="Black">  Empleado   </font ><br>
                            </div>
                            <button class="btn btn-primary" name ="btn_ingresar">Ingresar</button>
                        </form>
                    {/if}
                </td></tr></table>
    </body>
</html>