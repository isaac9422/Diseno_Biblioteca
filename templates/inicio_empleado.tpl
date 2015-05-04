<html>
    <head>
        <style>
            button{
                border-bottom-right-radius: 20px;
                border-bottom-left-radius: 20px;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
        </style>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0"><tr><td class="font-white" align="right">
                    {if isset($smarty.session.objeto_usuario)}
                        <button class="btn"><a href="{$gvar.l_global}registrar_autor.php">Registrar Autor</a></br></button>
                        <button class="btn"><a href="{$gvar.l_global}registrar_publicacion.php">Registrar Publicación</a></br></button>
                        <button class="btn"><a href="{$gvar.l_global}modificar_perfil.php">Modificar Perfil</a></br></button>

                    {/if}
                </td></tr></table>
    </body>
</html>