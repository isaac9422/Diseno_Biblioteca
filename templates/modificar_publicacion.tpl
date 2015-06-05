<!-DOCTYPE html>
<html>
    <body>
        <div class="square">
            <form action="{$gvar.l_global}modificar_publicacion.php?option=add" method="post">

                <b>Código de la publicación:</b> <input type="text" name="codigo_publicacion" /><br />
                <button class="btn btn-primary" type="submit" value="Seleccionar" >Seleccionar</button>
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