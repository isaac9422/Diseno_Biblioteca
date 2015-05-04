<td align="left" valign="top">
    <h4>Actualmente tienes seleccionado los siguientes elementos:</h4>
    <br>
    <ul>
        {section loop=$preview name=i}
            <li>{$preview[i]->get('nombre')}</li>
        {/section}
    </ul>

    <button class="btn btn-info btn-block" onclick="function1()" name="prestar">Prestar</button>
</td>
<script >
    function function1() {
        location.href='prestar_publicacion.php?option=prestar';
    }
</script>
