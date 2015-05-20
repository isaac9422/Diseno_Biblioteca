
<div class="square">
    {if isset($smarty.session.objeto_usuario)}
        <form action="{$gvar.l_global}modificar_perfil.php" method="post" >
            <b class="etiq">Contraseña actual :</b><input class="campos" type="password" name="contraseñaA" /><br>
            <b class="etiq">Nueva contraseña  :</b><input class="campos" type="password" name="contraseña" /> <br>
            <input type="hidden" name="contraseñaActual" value="{$objeto->get('contraseña')}" />
            <input type="hidden" name="identificacion" value="{$objeto->get('identificacion')}" />
            <b class="etiq">Nombre            :</b><input class="campos" type="text" name="nombre" value="{$objeto->get('nombre')}" /> <br> 
            <b class="etiq">Email             :</b><input class="campos" type="email" name="email" value="{$objeto->get('email')}" /> <br>
            <b class="etiq">Telefono          :</b><input class="campos" type="tel" name="telefono" value="{$objeto->get('telefono')}" /> <br> 
            <b class="etiq">Direccion         :</b><input class="campos" type="text" name="direccion" value="{$objeto->get('direccion')}"/> <br> 
            <br> 
            <input class="btn btn-success" type="submit" value="Modificar" name="modificar" />
            <input class="btn btn-warning" type="submit" value="Cancelar" name="cancelar" />
        </form>
    {/if}
</div>