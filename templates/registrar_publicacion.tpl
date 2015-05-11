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
                    <form action="{$gvar.l_global}registrar_publicacion.php" method="post">
                        <tr><td>
                                <h3>Registrar publicación</h3>
                                <b>Código biblioteca:* </b> <input type="text" name="codigo_biblioteca" required value=""/><br />
                                <b>Código publicación:* </b> <input type="text" name="codigo_publicacion" required value=""/><br />
                                <b>Nombre:* </b> <input type="text" name="nombre" required value=""/><br />
                                <b>Tipo:* </b>
                                <select name ="tipo">
                                    <option value="libro">Libro</option>
                                    <option value="revista">Revista</option>
                                    <option value="cd">CD</option>
                                </select> <br />
                                <b>Categoría:* </b>
                                <select name ="categoria">
                                    <option value="ciencia">Ciencia</option>
                                    <option value="deporte">Deporte</option>
                                    <option value="espectáculos">Espéctaculos</option>
                                    <option value="literatura">Literatura</option>
                                </select> <br />
                                <b>Clasificación:* </b>
                                <select name ="clasificacion">
                                    <option value="general">General</option>
                                    <option value="reserva">Reserva</option>                                    
                                </select> <br />
                                <b>Fecha publicación:* </b> <input type="date" name="fecha_publicacion" required value=""/><br />
                            </td>                         
                            <td>
                                <b>Autor(es):* </b>
                                <select multiple="multiple" id="autores" name="mis_autores[]" style="width:200px;height:400px">
                                    {section loop=$autores name=i}
                                        <option value='{$autores[i]->get('consecutivo')}'>{$autores[i]->get('nombre')}</option>
                                    {/section} 
                                </select>
                            </td>
                        </tr>
                        <tr>
                        <td>
                        <input class="btn btn-primary" type="submit" value="Registrar Publicación" name="btn_registrar_publicacion"/>
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
    $('#autores').multiSelect({ keepOrder: true });
    function indice() {
        location.href = 'index.php';
    }
  
    {*var n=2;
    function agregarAutor() {

        var t = document.getElementById("autores");
        t.innerHTML += "<b>Autor"+n+":* </b> <input type='text' name='autor"+n+"' required value=''/><br />"
        n++;
    }
    function quitarAutor() {
        var t = document.getElementById("autores");
        t.
        t.innerHTML --;//= "<b>Autor"+n+":* </b> <input type='text' name='autor"+n+"' required value=''/><br />"
        n--;
    }*}
</script>