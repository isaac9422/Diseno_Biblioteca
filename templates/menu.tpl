{if isset($smarty.session.objeto_usuario)}
    <td align="right"valign="top">
        <div class="btn-group-vertical">            
            <button class="btn btn-xs" onclick="inicio()"><a>Inicio</a></button>
            <button class="btn btn-xs" onclick="modifyPerfil()"><a>Modificar Perfil</a></button>
            {if $smarty.session.tipo_usuario == 'administrador'}
                <button class="btn btn-xs" onclick="quitMulta()"><a>Quitar Multa</a></button>
                <button class="btn btn-xs" onclick="adminCuenta()"><a>Administrar cuenta</a></button>
            {else if $smarty.session.tipo_usuario == 'empleado'}
                <button class="btn btn-xs" onclick="registryAutor()"><a>Registrar Autor</a></br></button>
                <button class="btn btn-xs" onclick="registryPublicacion()"><a>Registrar Publicación</a></button>
                <button class="btn btn-xs" onclick="registryEjemplar()"><a>Registrar Ejemplar</a></button>
                <button class="btn btn-xs" onclick="modifyPublicacion()"><a>Modificar Publicacion</a></button>
                <button class="btn btn-xs" onclick="deletePublicacion()"><a>Eliminar Publicacion</a></button>
                <button class="btn btn-xs" onclick="deleteEjemplar()"><a>Eliminar Ejemplar</a></button>
            {else}
                <button class="btn btn-xs" onclick="prestar()"><a>Prestar Publicación</a></button>
                <button class="btn btn-xs" onclick="renovar()"><a>Renovar Prestamo</a></button>
                <button class="btn btn-xs" onclick="devolver()"><a>Devolver Prestamo</a></button>
            {/if}
        </div>
    </td>
{else}
    <td align="right"valign="top">
        <div class="btn-group-vertical">         
            <button class="btn btn-xs" onclick="registryUser()"><a>Registrar Usuario</a></br></button>
        </div>
    </td>
{/if}
<script>
    function inicio() {
        location.href = 'index.php';
    }
    function modifyPerfil() {
        location.href = 'modificar_perfil.php';
    }
    function modifyPublicacion() {
        location.href = 'modificar_publicacion.php';
    }
    function prestar() {
        location.href = 'prestar_publicacion.php';
    }
    function renovar() {
        location.href = 'renovar_prestamo.php';
    }
    function devolver() {
        location.href = 'devolver_prestamo.php';
    }
    function registryUser() {
        location.href = 'registrar_usuario.php';
    }
    function registryAutor() {
        location.href = 'registrar_autor.php';
    }
    function quitMulta() {
        location.href = 'quitar_multa.php';
    }
    function adminCuenta() {
        location.href = 'administrar_cuenta.php';
    }
    function registryEjemplar() {
        location.href = 'registrar_ejemplar.php';
    }
    function registryPublicacion(){
        location.href = 'registrar_publicacion.php';
    }
    function deletePublicacion(){
        location.href = 'eliminar_publicacion.php';
    }
    function deleteEjemplar(){
        location.href = 'eliminar_ejemplar.php';
    }
</script>
