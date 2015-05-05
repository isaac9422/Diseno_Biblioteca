<div class="square">
    <form action="{$gvar.l_global}quitar_multa.php?option=update" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="5">
            <tr><td>

                    <b>Ingrese el id del Usuario a quitar multa:</b><br /><br />

                    <b>Identificacion:</b> <input type="text" name="identificacion" /><br />

                    <input class="btn btn-info" type="submit" value="Seleccionar" />
                </td></tr></table>  
    </form>
    <table width="100%" border="0" cellpadding="0" cellspacing="5">
        <tr><td>
                <button class="btn btn-warning" onclick="function2()" name="cancelar">  Cancelar</button>
            </td></tr></table>  
</div>
<br>            

<script >
    function function2() {
        location.href = 'index.php';
    }
</script>