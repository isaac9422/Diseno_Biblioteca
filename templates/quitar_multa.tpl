<div class="square">
    <form action="{$gvar.l_global}quitar_multa.php?option=update" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="5">
            <tr><td>

                    <b>Ingrese el id del Usuario a quitar multa:</b><br /><br />

                    <b>Identificacion:</b> <input type="text" name="identificacion" /><br />

                </td></tr></table>  
        <input class="btn btn-info" type="submit" value="Seleccionar" />
        <button class="btn btn-warning" onclick="indice()" name="cancelar">  Cancelar</button>
        <script >
            function indice() {
                location.href = 'index.php';
            }
        </script>
    </form>
</div>
<br>            
