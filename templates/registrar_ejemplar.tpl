<!-DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div class="square">
            {if isset($smarty.session.objeto_usuario)}
                <table width="100%" border="0" cellpadding="0" cellspacing="5">
                    <form action="{$gvar.l_global}registrar_ejemplar.php" method="post">
                        <tr><td>
                                <h3>Registrar Ejemplar</h3>
                                <b>Código Biblioteca:* </b> <input type="text" name="codigo_biblioteca" required value=""/><br />
                       
                            <td>
                                <b>Publicación:* </b>
                                <select  id="codigo" name="codigo_publicacion" >
                                    {section loop=$publicaciones name=i}
                                        <option value='{$publicaciones[i]->get('codigo_publicacion')}'>{$publicaciones[i]->get('nombre')}</option>
                                    {/section} 
                                </select>
                            </td>
                        </tr>
                        <tr>
                        <td>
                        <input class="btn btn-primary" type="submit" value="Registrar ejemplar" name="btn_registrar_ejemplar"/>
                        </form>              
                        <input class="btn btn-warning" type="button" value="Cancelar" name="btn_cancelar" onclick="indice()" />
                        </td>
                    </tr>

                </table>
            {/if}
        </div>
    </body>
</html>
<script>
    //$('#ejemplares').multiSelect({ keepOrder: true });
    function indice() {
        location.href = 'index.php';
    }
</script>