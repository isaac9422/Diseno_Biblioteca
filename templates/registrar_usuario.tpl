<div class="square">
<form action="{$gvar.l_global}registrar_usuario.php" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="5">
<tr><td>
<b>Registrar usuario</b><br /><br />
<b>E-mail:* </b> <input type="email" name="email" required value="{if isset($object->email)}{$object->email}{/if}"/><br />
<b>Identificación:*</b> <input type="text" name="identificacion" required value="{if isset($object->identificacion)}{$object->identificacion}{/if}"/><br />
<b>Nombre:*</b> <input type="text" name="nombre" required value="{if isset($object->nombre)}{$object->nombre}{/if}"/><br />
<b>Dirección:*</b> <input type="text" name="direccion" required/><br />
<b>Teléfono:*</b> <input type="text" name="telefono" required/><br />
<b>Contraseña:*</b> <input type="password" name="contraseña" required/><br />
<b>Repetir contraseña:*</b> <input type="password" name="contraseña2" required/><br />
<input class="btn btn-primary" type="submit" value="Registrar Usuario" name="btn_registrar_usuario"/>
</td></tr></table>
</form>
</div>