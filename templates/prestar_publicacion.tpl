<h4>Actualmente tienes seleccionado los siguientes elementos:</h4>
<br>
<ul>
    {section loop=$preview name=i}
        <li>{$preview[i]->get('nombre')}</li>
        {/section}
</ul>

<button class="btn btn-info" onclick="function1()" name="prestar">Prestar</button>
<button class="btn btn-warning" onclick="function2()" name="cancelar">Cancelar</button>
<script >
    function function1() {
        location.href = 'prestar_publicacion.php?option=prestar';
    }
    function function2() {
        location.href = 'index.php';
    }
</script>
