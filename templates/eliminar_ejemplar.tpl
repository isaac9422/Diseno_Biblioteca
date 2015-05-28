
<!-DOCTYPE html>
<html>
    <body>
        <div class="square">
            <form action="{$gvar.l_global}eliminar_ejemplar.php?option=eliminar" method="post">
                <table width="100%" border="0" cellpadding="0" cellspacing="5">
                <tr><td>

                    <b>Ingrese el código:</b> <input type="text" name="codigo_biblioteca" /><br />

                    <input class="btn btn-primary" type="submit" value="Eliminar" />
                    
                </td></tr></table>
            </form>
                <table width="100%" border="0" cellpadding="0" cellspacing="5">
                    <tr><td>
                    <button class="btn btn-warning" onclick="paginaEmpleado()" name="cancelar">  Cancelar</button>
                    </td></tr>
                </table>
        </div>
    </body>
    
    <script >
    function paginaEmpleado() {
        location.href = 'inicio_empleado.php';
    }
    </script>
</html>