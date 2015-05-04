<html>
    <body>
        {if isset($smarty.session.objeto_usuario)}
        <td align="right"valign="top">
            <div class="btn-group-vertical">
                <button class="btn btton1 btn-small"><a href="{$gvar.l_global}index.php">Inicio</a></button>
                <button class="btn button btn-small"><a href="{$gvar.l_global}modificar_perfil.php">Modificar Perfil</a></button>
            </div>
        </td>
    {/if}
</body>
        <table cellspacing="0" cellpadding="0"><tr><td class="font-white" align="right">
                    {if isset($smarty.session.objeto_usuario)}
                        <button class="btn"><a href="{$gvar.l_global}registrar_autor.php">Registrar Autor</a></br></button>
                        <button class="btn"><a href="{$gvar.l_global}registrar_publicacion.php">Registrar Publicación</a></br></button>
                        <button class="btn"><a href="{$gvar.l_global}modificar_perfil.php">Modificar Perfil</a></br></button>

                    {/if}
                </td></tr></table>
    </body>
</html>