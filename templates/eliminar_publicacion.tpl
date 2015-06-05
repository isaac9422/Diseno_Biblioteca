<!-DOCTYPE html>
<html>
    <body>

        <div class="square">
            <form action="{$gvar.l_global}eliminar_publicacion.php?option=eliminar" method="post">
                <b>Ingrese el código:</b> <input type="text" name="codigo_publicacion" /><br />

                <input class="btn btn-primary" type="submit" value="Eliminar" />
                <button class="btn btn-warning" onclick="paginaInicial()" name="cancelar">  Cancelar</button>
            </form>


        </div>
    </body>

    <script >
        function paginaInicial() {
            location.href = 'inicio_empleado.php';
        }
    </script>
</html>