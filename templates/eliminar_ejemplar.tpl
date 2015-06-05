
<!-DOCTYPE html>
<html>
    <body>
        <div class="square">
            <form action="{$gvar.l_global}eliminar_ejemplar.php?option=eliminar" method="post">

                <b>Ingrese el código:</b> <input type="text" name="codigo_biblioteca" /><br />

                <input class="btn btn-primary" type="submit" value="Eliminar" />
                <button class="btn btn-warning" onclick="paginaEmpleado()" name="cancelar">  Cancelar</button>

            </form>

        </div>
    </body>

    <script >
        function paginaEmpleado() {
            location.href = 'inicio_empleado.php';
        }
    </script>
</html>