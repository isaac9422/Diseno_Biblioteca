<table cellspacing="0" cellpadding="0"><tr><td class="font-white" align="center">
{if isset($smarty.session.objeto)}
    {if ($smarty.session.tipo_usuario eq "administrador")}
        <a href="{$gvar.l_global}registrar_usuario.php">Registrar Usuario</a></br>
    {/if}
{/if}
</td></tr></table>
