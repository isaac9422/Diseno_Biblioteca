<div class="square">
{*if isset($smarty.session.objeto_usuario)*}
    <form action="{$gvar.l_global}registrar_administrador_empleado.php" method="post">
    <table width="100%" border="0" cellpadding="0" cellspacing="5">
    <tr><td>
    <b>Registrar Empleado</b><br /><br />
    <b>E-mail:* </b> <input type="email" name="email" required/><br />
    <b>Identificación:*</b> <input type="text" name="identificacion" required/><br />
    <b>Nombre:*</b> <input type="text" name="nombre" required/><br />
    <b>Dirección:*</b> <input type="text" name="direccion" required/><br />
    <b>Teléfono:*</b> <input type="text" name="telefono" required/><br />
    <b>Contraseña:*</b> <input type="password" name="contraseña" required/><br />
    <b>Repetir contraseña:*</b> <input type="password" name="contraseña2" required/><br />
    <input class="btn btn-primary" type="submit" value="Registrar" name="btn_registrar_empleado"/>
    </td></tr></table>
    </form>   
    <form action="{$gvar.l_global}registrar_administrador_empleado.php" method="post">
    <table width="100%" border="0" cellpadding="0" cellspacing="5">
    <tr><td>
    <b>Registrar Administrador</b><br /><br />
    <b>E-mail:* </b> <input type="email" name="email" required/><br />
    <b>Identificación:*</b> <input type="text" name="identificacion" required/><br />
    <b>Nombre:*</b> <input type="text" name="nombre" required/><br />
    <b>Dirección:*</b> <input type="text" name="direccion" required/><br />
    <b>Teléfono:*</b> <input type="text" name="telefono" required/><br />
    <b>Contraseña:*</b> <input type="password" name="contraseña" required/><br />
    <b>Repetir contraseña:*</b> <input type="password" name="contraseña2" required/><br />
    <input class="btn btn-primary" type="submit" value="Registrar" name="btn_registrar_administrador"/>
    </td></tr></table>
    </form>
{*/if*}

</div>