
<!-DOCTYPE html>
<html>
    <body>

<table border="0" width="100%" cellpadding="0" cellspacing="10" >
    <tr> 
        <td> <form action="{$gvar.l_global}buscarPublicacion.php?option=lookup" method="post">
                <select name ="criterioBusqueda"> 
                    <option value="by_autor"> Autor</option>
                    <option value="by_nombre">Nombre publicación</option>
                </select> 
                <input type='text' name='textoBusqueda' placeholder='Buscar'>
                <button class="btn btn-success">Buscar</button>
            </form>
        </td> 

    </tr>
    <tr>
        <td>
            <form action="{$gvar.l_global}buscarPublicacion.php" method="post">
                {if isset($publicacion)}
                    <table id="busqueda" class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr style="font-weight: bold;"> 
                                <td>Código Publicación</td>
                                <td>Categoría</td>
                                <td>Tipo</td>
                                <td>Nombre</td>
                                <td>Fecha de publicación</td>
                                <td>Nombre Autor</td>
                                <td>Disponibles</td>
                                 {if isset($smarty.session.objeto_usuario)}
                                <td>Prestar</td>
                                {/if}

                            </tr>
                        </thead>
                        {section loop=$publicacion name=i}

                            <tr>  
                                <td> {$publicacion[i]->get('codigo_publicacion')}</td> 
                                <td> {$publicacion[i]->get('categoria')}</td> 
                                <td> {$publicacion[i]->get('tipo')}</td> 
                                <td> {$publicacion[i]->get('nombre')}</td> 
                                <td> {$publicacion[i]->get('fecha_publicacion')}</td> 
                                <td> {$publicacion[i]->auxiliars['nombreAutor']}</td> 
                                <td> {$publicacion[i]->auxiliars['cantidad']}</td>
                                {if isset($smarty.session.objeto_usuario)}
                                <td style="text-align: center;">
                                    <input {if $publicacion[i]->auxiliars['cantidad']>0}{else}disabled="disabled"{/if} type="checkbox" name="buscados[]" value="{$publicacion[i]->get('codigo_publicacion')}"/>
                                </td>
                                 {/if}
                            </tr>

                        {/section}
                    </table>  
                    <br/>
                    {if isset($smarty.session.objeto_usuario)}

                        <button class="btn btn-inverse" name="adicionar">Adicionar</button>
                        <button class="btn btn-warning" onclick="buscar()" name="cancelar">  Cancelar</button>
                    {/if}
                {/if}
            </form>
                
        </td> 
    </tr>
</table>
           
    </body>
     <script >
    function buscar() {
        location.href = 'inicio_usuario.php';
    }
    </script>
</html>