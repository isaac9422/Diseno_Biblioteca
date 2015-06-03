<!-DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <style>
            b{
                display: inline-block;
                width: 90px;
                vertical-align: middle;
            }
            input{
                display: block;
                vertical-align: middle;
                margin: 3px;
            }
        </style>
    </head>
    <body>

<div class="square">
    <form action="{$gvar.l_global}modificar_publicacion.php?option=modificar" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="5">
        <tr><td>
          
        
            <b>MODIFICAR PUBLICACION</b><br /><br />       

            <b>Código Publicación:</b> <input type="text" disabled="disabled" value="{if isset($object)}{$object->get('codigo_publicacion')}{/if}"/><br />
                                        <input type="hidden" name="codigo_publicacion"  value="{if isset($object)}{$object->get('codigo_publicacion')}{/if}"/>
            <b>Nombre:</b> <input type="text" name="nombre" value="{if isset($object)}{$object->get('nombre')}{/if}"/><br />
            <b>Tipo:* </b>
            <select name ="tipo">
                <option value="libro" {if $object->get('tipo') == 'libro'}selected{/if}>Libro</option>
                <option value="revista" {if $object->get('tipo') == 'revista'}selected{/if}>Revista</option>
                <option value="documento" {if $object->get('tipo') == 'documento'}selected{/if}>Documento</option>
                <option value="audio" {if $object->get('tipo') == 'audio'}selected{/if}>Audio</option>
                <option value="periodico" {if $object->get('tipo') == 'periodico'}selected{/if}>Periódico</option>
                <option value="revista" {if $object->get('tipo') == 'revista'}selected{/if}>Revista</option>
                <option value="video" {if $object->get('tipo') == 'video'}selected{/if}>Video</option>
            </select> <br />
            <b>Categoría:* </b>
            <select name ="categoria">
                <option value="ciencia" {if $object->get('categoria') == 'ciencia'}selected{/if}>Ciencia</option>
                <option value="deporte" {if $object->get('categoria') == 'deporte'}selected{/if}>Deporte</option>
                <option value="espectáculos" {if $object->get('categoria') == 'espectáculos'}selected{/if}>Espéctaculos</option>
                <option value="literatura" {if $object->get('categoria') == 'literatura'}selected{/if}>Literatura</option>
            </select> <br />
            <b>Clasificación:* </b>
            <select name ="clasificacion">
                <option value="general" {if $object->get('clasificacion') == 'general'}selected{/if}>General</option>
                <option value="reserva" {if $object->get('clasificacion') == 'reserva'}selected{/if}>Reserva</option>                                    
            </select> <br />
            <b>Fecha de publicación:</b> <input type="date" name="fecha_publicacion" value="{if isset($object)}{$object->get('fecha_publicacion')}{/if}"/><br />
  
            
            <input class="btn btn-primary" type="submit" value="Modificar" /><br />
            
                      
        </td></tr></table>
    </form>

                <table width="100%" border="0" cellpadding="0" cellspacing="5">
        <tr><td>
                <button class="btn btn-warning" onclick="paginaInicial()" name="cancelar">  Cancelar</button>
            </td></tr></table>  
</div>
</body>

<script >
    function paginaInicial() {
        location.href = 'inicio_empleado.php';
    }
</script>
</html>