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
</html>
