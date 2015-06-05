<!-DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div class="square">
            {if isset($smarty.session.objeto_usuario)}
                <table width="100%" border="0" cellpadding="0" cellspacing="5">
                    <form action="{$gvar.l_global}registrar_publicacion.php" method="post">
                        <tr><td>
                                <h3>Registrar publicación</h3>
                                <b>Código publicación:* </b> <input type="text" name="codigo_publicacion" required value="{if isset($objeto)}{$objeto->get('codigo_publicacion')}{/if}"/><br />
                                <b>Nombre:* </b> <input type="text" name="nombre" required value="{if isset($objeto)}{$objeto->get('nombre')}{/if}"/><br />
                                <b>Tipo:* </b>
                                <select name ="tipo">
                                    <option value="libro">Libro</option>
                                    <option value="revista">Revista</option>
                                    <option value="documento">Documento</option>
                                    <option value="audio">Audio</option>
                                    <option value="periodico">Periódico</option>
                                    <option value="video">Video</option>
                                </select> <br />
                                <b>Categoría:* </b>
                                <select name ="categoria">
                                    <option value="arte">Arte</option>
                                    <option value="ciencia">Ciencia</option>
                                    <option value="deporte">Deporte</option>
                                    <option value="economia">Economía</option>
                                    <option value="enciclopedia">Enciclopedia</option>
                                    <option value="espectaculos">Espectáculos</option>
                                    <option value="filosofia">Filosofía</option>
                                    <option value="fisica">Física</option>
                                    <option value="literatura colombiana">Literatura Colombiana</option>
                                    <option value="literatura infantil">Literatura Infantil</option>
                                    <option value="literatura juvenil">Literatura Juvenil</option>                                    
                                    <option value="literatura universal">Literatura Universal</option>
                                    <option value="matematica">Matemática</option>
                                    <option value="politica">Política</option>
                                    <option value="quimica">Química</option>
                                    <option value="religion">Religión</option>
                                    <option value="salud">Salud</option>
                                    <option value="tecnologia">Tecnología</option>
                                     <option value="tecnologia">Networking</option>
                                      <option value="tecnologia">Ingeniería</option>
                                    <option value="otros">--Otros--</option>
                                </select> <br />
                                <b>Clasificación:* </b>
                                <select name ="clasificacion">
                                    <option value="general">General</option>
                                    <option value="reserva">Reserva</option>                                    
                                </select> <br />
                                <b>Fecha publicación (dd/mm/aaaa):* </b> <input type="date" name="fecha_publicacion" required value="{if isset($objeto)}{$objeto->get('fecha_publicacion')}{/if}" placeholder="dd/mm/aaaa"/><br />
                            </td>                         
                            <td>
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
    $('#autores').multiSelect({
        keepOrder: true,
        selectableHeader: "<div><h5>Lista de autores</h5></div>",
        selectionHeader: "<div><h5>Autores seleccionados</h5></div>",
    });
    //$('#autores').multiSelect({ keepOrder: true });
    function indice() {
        location.href = 'index.php';
    }
</script>