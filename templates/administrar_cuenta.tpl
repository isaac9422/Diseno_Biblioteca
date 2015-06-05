
<div class="square" >
    <form action="{$gvar.l_global}administrar_cuenta.php?option=administrar" method="post">
        {* <table width="100%" border="0" cellpadding="0" cellspacing="5">
        <tr><td>
        *}
        <h5>Ingrese la identificacion del usuario a Administrar Cuenta:</h5
        <br>

        <b>Identificacion:</b> <input type="text" name="identificacion" /><br />

        <h5>Seleccione el Estado a Modificar:</h5>
        <input class="radio" type="radio" name="estado" value="bloqueado" checked style="display: inline">    Bloqueado  <br>
        <input class="radio" type="radio" name="estado" value="activo" style="display: inline">     Activo <br>
        <br />
        <input class="btn btn-info" type="submit" value="Seleccionar" />
        <button class="btn btn-warning" onclick="function2()" name="cancelar">  Cancelar</button>
        {* </td></tr>
        </table>*}
    </form>  
</div>
<br>            

<script >
    function function2() {
        location.href = 'index.php';
    }
</script>