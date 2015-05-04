<html>
    <body>
        {if isset($smarty.session.objeto_usuario)}
            {if $smarty.session.tipo_usuario == 'administrador'}
            <td align="right"valign="top">
                <div class="btn-group-vertical">
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}index.php">Inicio</a></button>
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}modificar_perfil.php">Modificar Perfil</a></button>
                </div>
            </td>
        {else if $smarty.session.tipo_usuario == 'empleado'}
            <td align="right"valign="top">
                <div class="btn-group-vertical">
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}index.php">Inicio</a></button>
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}modificar_perfil.php">Modificar Perfil</a></button>
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}registrar_autor.php">Registrar Autor</a></br></button>
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}registrar_publicacion.php">Registrar Publicación</a></br></button>

                </div>
            </td>
        {else}
            <td align="right"valign="top">
                <div class="btn-group-vertical">
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}index.php">Inicio</a></button>
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}modificar_perfil.php">Modificar Perfil</a></button>
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}prestar_publicacion.php">Prestar Publicación</a></button>
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}renovar_prestamo.php">Renovar Prestamo</a></button>
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}devolver_prestamo.php">Devolver Prestamo</a></button>
                </div>
            </td>
        {/if}
    {else}
        <td align="right"valign="top">
                <div class="btn-group-vertical">
                    <button class="btn  btn-xs"><a href="{$gvar.l_global}registrar_usuario.php">Registrar Usuario</a></br></button>
                </div>
            </td>
        {/if}
</body>
</html>
