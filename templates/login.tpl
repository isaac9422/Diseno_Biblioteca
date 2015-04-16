
<b></b><br /><br />


<table cellspacing="0" cellpadding="0"><tr><td class="font-white" align="center">
{if !isset($smarty.session.usuario)}            
    <form class="well well-small form-search" action="{$gvar.l_global}index.php" method="post" name="login">
    <b><a name="login"> </a></b><br /><br />
    <input name="email" type="text" class="input-medium" placeholder="Email*" required<br /><br />
    <input name="contraseña" type="password" class="input-medium" placeholder="Contraseña*" required><br /><br />
    <input type="radio" name="rol" value="usuario" checked><font color="Black">       Usuario   </font >
    <input type="radio" name="rol" value="Administrador"><font color="Black">    Administrador   </font >
    <input type="radio" name="rol" value="Empleado"><font color="Black">     Empleado   </font ><br>
    <input type="submit" class="btn btn-primary" name ="btn_ingresar" value="Ingresar"></input>
    </form>
{else}
    
{/if}
</td></tr></table>


