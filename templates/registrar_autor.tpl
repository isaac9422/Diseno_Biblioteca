<!-DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            b{
                display: inline-block;
                width: 100px;
                vertical-align: middle;
            }
            input{
                display: block;
                vertical-align: middle;
                margin: 5px;
            }
        </style>
    </head>
    <body>
        <div class="square">
            {if isset($smarty.session.objeto_usuario)}
                <table width="100%" border="0" cellpadding="0" cellspacing="5">
                    <tr><td>
                            <form action="{$gvar.l_global}registrar_autor.php" method="post">
                                <h3>Registrar autor</h3>
                                <b>Nombre:* </b> <input type="text" name="nombre" required value=""/><br />
                                <input class="btn btn-primary" type="submit" value="Registrar Autor" name="btn_registrar_autor"/>
                                <input class="btn btn-warning" type="submit" value="Cancelar" name="btn_cancelar" />
                            </form>
                        </td></tr>
                </table>
            {/if}
        </div>
    </body>
</html>
