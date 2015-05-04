
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
            {if !isset($smarty.session.objeto_usuario)}
                <table width="90%" cellpadding="1" cellspacing="">
                    <tr><td>
                            <form action="{$gvar.l_global}registrar_usuario.php" method="post">

                                <h4>Registrar usuario</h4>
                                <b>E-mail:* </b> <input type="email" name="email" required value="{if isset($object->email)}{$object->email}{/if}"/><br />
                                <b>Identificación:*</b> <input type="text" name="identificacion" required value="{if isset($object->identificacion)}{$object->identificacion}{/if}"/><br />
                                <b>Nombre:*</b> <input type="text" name="nombre" required value="{if isset($object->nombre)}{$object->nombre}{/if}"/><br />
                                <b>Dirección:*</b> <input type="text" name="direccion" required/><br />
                                <b>Teléfono:*</b> <input type="text" name="telefono" required/><br />
                                <b>Contraseña:*</b> <input type="password" name="contraseña" required/><br />
                                <b>Repetir contraseña:*</b> <input type="password" name="contraseña2" required/><br />
                                <input class="btn btn-primary" type="submit" value="Registrar Usuario" name="btn_registrar_usuario"/>
                            </form>
                            <form action="{$gvar.l_global}registrar_usuario.php" method="post">
                                <input class="btn btn-warning" type="submit" value="Cancelar" name="btn_cancelar" />
                            </form>
                        </td></tr>
                </table>
            {/if}
        </div>
    </body>
</html>
