<!-DOCTYPE html>
<html>
    <body>
        <div class="square">
            <form action="{$gvar.l_global}modificar_publicacion.php?option=add" method="post">
                <table width="100%" border="0" cellpadding="0" cellspacing="5">

                        <tr><td>

                            <b>Código de la publicación:</b> <input type="text" name="codigo_publicacion" /><br />
                            <input class="btn btn-primary" type="submit" value="Seleccionar" /><br />


                        </td></tr>
                </table>
                
            </form>
                <table width="100%" border="0" cellpadding="0" cellspacing="5">
                    <tr><td>
                    <button class="btn btn-warning" onclick="paginaInicial()" name="cancelar">  Cancelar</button>
                    </td></tr>
                </table>
        </div>
    </body>
    
    <script >
    function paginaInicial() {
        location.href = 'inicio_empleado.php';
    }
    </script>
</html>