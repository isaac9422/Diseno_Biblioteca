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

            <b>Código Publicación:</b> <input type="text" name="codigo_publicacion" value="{if isset($object)}{$object->get('codigo_publicacion')}{/if}"/><br />
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
                <option value="arte" {if $object->get('categoria') == 'arte'}selected{/if}>Arte</option>
                <option value="ciencia" {if $object->get('categoria') == 'ciencia'}selected{/if}>Ciencia</option>
                <option value="deporte" {if $object->get('categoria') == 'deporte'}selected{/if}>Deporte</option>
                <option value="economia" {if $object->get('categoria') == 'economia'}selected{/if}>Economía</option>
                <option value="enciclopedia" {if $object->get('categoria') == 'enciclopedia'}selected{/if}>Enciclopedia</option>
                <option value="espectaculos" {if $object->get('categoria') == 'espectaculos'}selected{/if}>Espectáculos</option>
                <option value="filosofia" {if $object->get('categoria') == 'filosofia'}selected{/if}>Filosofía</option>
                <option value="literatura colombiana" {if $object->get('categoria') == 'literatura colombiana'}selected{/if}>Literatura Colombiana</option>
                <option value="literatura infantil" {if $object->get('categoria') == 'literatura infantil'}selected{/if}>Literatura Infantil</option>
                <option value="literatura juvenil" {if $object->get('categoria') == 'literatura juvenil'}selected{/if}>Literatura Juvenil</option>
                <option value="literatura universal" {if $object->get('categoria') == 'literatura universal'}selected{/if}>Literatura Universal</option>
                <option value="matematica" {if $object->get('categoria') == 'matematica'}selected{/if}>Matemática</option>
                <option value="politica" {if $object->get('categoria') == 'politica'}selected{/if}>Política</option>
                <option value="quimica" {if $object->get('categoria') == 'quimica'}selected{/if}>Química</option>
                <option value="religion" {if $object->get('categoria') == 'religion'}selected{/if}>Religión</option>
                <option value="salud" {if $object->get('categoria') == 'salud'}selected{/if}>Salud</option>
                <option value="tecnologia" {if $object->get('categoria') == 'tecnologia'}selected{/if}>Tecnología</option>
                <option value="otros" {if $object->get('categoria') == 'otros'}selected{/if}>--Otros--</option>
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