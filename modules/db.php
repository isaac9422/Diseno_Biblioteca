<?php

/**
 * Project:     Framework G - G Light
 * File:        db.php
 * 
 * For questions, help, comments, discussion, etc., please join to the
 * website www.frameworkg.com
 * 
 * @link http://www.frameworkg.com/
 * @copyright 2013-02-07
 * @author Group Framework G  <info at frameworkg dot com>
 * @version 1.2
 */
class db {

    var $server = C_DB_SERVER; //DB server
    var $user = C_DB_USER; //DB user
    var $pass = C_DB_PASS; //DB password
    var $db = C_DB_DATABASE_NAME; //DB database name
    var $limit = C_DB_LIMIT; //DB limit of elements by page
    var $cn;
    var $numpages;

    public function db() {
        
    }

    //connect to database
    public function connect() {
        $this->cn = mysqli_connect($this->server, $this->user, $this->pass);
        if (!$this->cn) {
            die("Failed connection to the database: " . mysqli_error($this->cn));
        }
        if (!mysqli_select_db($this->cn, $this->db)) {
            die("Unable to communicate with the database $db: " . mysqli_error($this->cn));
        }
        mysqli_query($this->cn, "SET NAMES utf8");
    }

    //function for doing multiple queries
    public function do_operation($operation, $class = NULL) {
        $result = mysqli_query($this->cn, $operation);
        if (!$result) {
            $this->throw_sql_exception($class);
        }
    }

    //function for obtain data from db in object form
    private function get_data($operation) {
        $data = array();
        $result = mysqli_query($this->cn, $operation) or die(mysqli_error($this->cn));
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    //throw exception to web document
    private function throw_sql_exception($class) {
        $errno = mysqli_errno($this->cn);
        $error = mysqli_error($this->cn);
        $msg = $error . "<br /><br /><b>Error number:</b> " . $errno;
        throw new Exception($msg);
    }

    //for avoid sql injections, this functions cleans the variables
    private function escape_string(&$data) {
        if (is_object($data)) {
            foreach ($data->metadata() as $key => $attribute) {
                if (!is_empty($data->get($key))) {
                    $data->set($key, mysqli_real_escape_string($this->cn, $data->get($key)));
                }
            }
        } else if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (!is_array($value)) {
                    $data[$key] = mysqli_real_escape_string($this->cn, $value);
                }
            }
        }
    }

    //function for add data to db
    public function insert($options, $object) {
        switch ($options['lvl1']) {
            case "usuario":
                switch ($options['lvl2']) {
                    case "normal":
                        $identificacion = mysqli_real_escape_string($this->cn, $object->get('identificacion'));
                        $email = mysqli_real_escape_string($this->cn, $object->get('email'));
                        $nombre = mysqli_real_escape_string($this->cn, $object->get('nombre'));
                        $direccion = mysqli_real_escape_string($this->cn, $object->get('direccion'));
                        $telefono = mysqli_real_escape_string($this->cn, $object->get('telefono'));
                        $contraseña = mysqli_real_escape_string($this->cn, $object->get('contraseña'));
                        $this->do_operation("INSERT INTO usuario (identificacion,nombre, contraseña,"
                                . "email,direccion,telefono,estado,multa) "
                                . "VALUES ('$identificacion', '$nombre', '$contraseña', '$email',"
                                . "'$direccion', '$telefono', 'ACTIVO','0');");
                        break;
                }
                break;
            case "empleado":
                switch ($options['lvl2']) {
                    case "normal":
                        $identificacion = mysqli_real_escape_string($this->cn, $object->get('identificacion'));
                        $email = mysqli_real_escape_string($this->cn, $object->get('email'));
                        $nombre = mysqli_real_escape_string($this->cn, $object->get('nombre'));
                        $direccion = mysqli_real_escape_string($this->cn, $object->get('direccion'));
                        $telefono = mysqli_real_escape_string($this->cn, $object->get('telefono'));
                        $contraseña = mysqli_real_escape_string($this->cn, $object->get('contraseña'));
                        $this->do_operation("INSERT INTO empleado (identificacion,nombre, contraseña,"
                                . "email,direccion,telefono) "
                                . "VALUES ('$identificacion', '$nombre', '$contraseña', '$email',"
                                . "'$direccion', '$telefono');");
                        break;
                }
                break;
            case "administrador":
                switch ($options['lvl2']) {
                    case "normal":
                        $identificacion = mysqli_real_escape_string($this->cn, $object->get('identificacion'));
                        $email = mysqli_real_escape_string($this->cn, $object->get('email'));
                        $nombre = mysqli_real_escape_string($this->cn, $object->get('nombre'));
                        $direccion = mysqli_real_escape_string($this->cn, $object->get('direccion'));
                        $telefono = mysqli_real_escape_string($this->cn, $object->get('telefono'));
                        $contraseña = mysqli_real_escape_string($this->cn, $object->get('contraseña'));
                        $this->do_operation("INSERT INTO administrador (identificacion,nombre, contraseña,"
                                . "email,direccion,telefono) "
                                . "VALUES ('$identificacion', '$nombre', '$contraseña', '$email',"
                                . "'$direccion', '$telefono');");
                        break;
                }
                break;

            case "prestamo":
                switch ($options['lvl2']) {
                    case "normal":
                        $usuario = mysqli_real_escape_string($this->cn, $object->get('usuario'));
                        $codigoBiblioteca = mysqli_real_escape_string($this->cn, $object->get('codigoBiblioteca'));
                        $fechaInicio = mysqli_real_escape_string($this->cn, $object->get('fechaInicio'));
                        $fechaFin = mysqli_real_escape_string($this->cn, $object->get('fechaFin'));
                        $fechaEntrega = null;
                        $cantidadRenovacion = 1;
                        $this->do_operation("INSERT INTO prestamo (usuario,codigo_biblioteca, fecha_inicio,"
                                . "fecha_fin,fecha_entrega,cantidad_renovacion) "
                                . "VALUES ('$usuario', '$codigoBiblioteca', '$fechaInicio', '$fechaFin',"
                                . "'$fechaEntrega', '$cantidadRenovacion');");
                        break;
                }
                break;
             case "autor":
                switch ($options['lvl2']) {
                    case "normal":
                        $nombre = mysqli_real_escape_string($this->cn, $object->get('nombre'));
                        $this->do_operation("INSERT INTO autor (nombre) VALUES ('$nombre');");
                        break;
                }
                break;
              case "publicacion":
                switch ($options['lvl2']) {
                    case "normal":
                        $codigo_biblioteca = mysqli_real_escape_string($this->cn, $object->get('codigo_biblioteca'));
                        $codigo_publicacion = mysqli_real_escape_string($this->cn, $object->get('codigo_publicacion'));
                        $nombre = mysqli_real_escape_string($this->cn, $object->get('nombre'));
                        $categoria = mysqli_real_escape_string($this->cn, $object->get('categoria'));
                        $tipo = mysqli_real_escape_string($this->cn, $object->get('tipo'));
                        $clasificacion = mysqli_real_escape_string($this->cn, $object->get('clasificacion'));
                        $fecha_publicacion = mysqli_real_escape_string($this->cn, $object->get('fecha_publicacion'));
                        $this->do_operation("INSERT INTO publicacion (codigo_biblioteca,codigo_publicacion, nombre,"
                                . "categoria,tipo,clasificacion,fecha_publicacion) "
                                . "VALUES ('$codigo_biblioteca', '$codigo_publicacion', '$nombre', '$categoria',"
                                . "'$tipo', '$clasificacion', '$fecha_publicacion');");
                        break;
                }
                break;
            default: break;
        }
    }

    //function for edit data from db
    public function update($options, $object) {
        switch ($options['lvl1']) {
            case "usuario":
                switch ($options['lvl2']) {
                    case "normal":
                        $identificacion = mysqli_real_escape_string($this->cn, $object->get('identificacion'));
                        $email = mysqli_real_escape_string($this->cn, $object->get('email'));
                        $nombre = mysqli_real_escape_string($this->cn, $object->get('nombre'));
                        $direccion = mysqli_real_escape_string($this->cn, $object->get('direccion'));
                        $telefono = mysqli_real_escape_string($this->cn, $object->get('telefono'));
                        $contraseña = mysqli_real_escape_string($this->cn, $object->get('contraseña'));

                        $this->do_operation("UPDATE  usuario SET nombre = '$nombre', contraseña = '$contraseña'"
                                . ", email = '$email', direccion = '$direccion'"
                                . ", telefono = '$telefono' WHERE identificacion = '$identificacion';");
                        break;
                    
                    case "multar":
                        $identificacion = mysqli_real_escape_string($this->cn, $object->get('identificacion'));
                        $multa = mysqli_real_escape_string($this->cn, $object->get('multa'));
                        $this->do_operation("UPDATE usuario SET estado='INACTIVO', multa = '$multa'"
                                . " WHERE identificacion = '$identificacion';");
                        break;
                    
                    case "multa":
                        $identificacion = mysqli_real_escape_string($this->cn, $object->get('identificacion'));

                        $this->do_operation("UPDATE  usuario SET multa=0, estado='ACTIVO' WHERE identificacion = '$identificacion';");
                        break;
                    
                    case "bloquear":
                        $identificacion = mysqli_real_escape_string($this->cn, $object->get('identificacion'));
                         $estado = mysqli_real_escape_string($this->cn, $object->get('estado'));
                        $this->do_operation("UPDATE  usuario SET multa=0, estado='$estado' WHERE identificacion = '$identificacion';");
                        break;
                    
                }
                break;

            case "empleado":
                switch ($options['lvl2']) {
                    case "normal":
                        $identificacion = mysqli_real_escape_string($this->cn, $object->get('identificacion'));
                        $email = mysqli_real_escape_string($this->cn, $object->get('email'));
                        $nombre = mysqli_real_escape_string($this->cn, $object->get('nombre'));
                        $direccion = mysqli_real_escape_string($this->cn, $object->get('direccion'));
                        $telefono = mysqli_real_escape_string($this->cn, $object->get('telefono'));
                        $contraseña = mysqli_real_escape_string($this->cn, $object->get('contraseña'));

                        $this->do_operation("UPDATE  empleado SET identificacion = '$identificacion',nombre = '$nombre'"
                                . "contraseña = '$contraseña', email = '$email', direccion = '$direccion'"
                                . ",telefono = '$telefono' WHERE identificacion = '$identificacion';");
                        break;
                }
                break;

            case "administrador":
                switch ($options['lvl2']) {
                    case "normal":
                        $identificacion = mysqli_real_escape_string($this->cn, $object->get('identificacion'));
                        $email = mysqli_real_escape_string($this->cn, $object->get('email'));
                        $nombre = mysqli_real_escape_string($this->cn, $object->get('nombre'));
                        $direccion = mysqli_real_escape_string($this->cn, $object->get('direccion'));
                        $telefono = mysqli_real_escape_string($this->cn, $object->get('telefono'));
                        $contraseña = mysqli_real_escape_string($this->cn, $object->get('contraseña'));

                        $this->do_operation("UPDATE  administrador SET identificacion = '$identificacion',nombre = '$nombre'"
                                . "contraseña = '$contraseña', email = '$email', direccion = '$direccion'"
                                . ",telefono = '$telefono' WHERE identificacion = '$identificacion';");
                        break;
                }
                break;
            


            case "prestamo":
                switch ($options['lvl2']) {
                    case "normal":
                        $usuario = mysqli_real_escape_string($this->cn, $object->get('usuario'));
                        $codigo_biblioteca = mysqli_real_escape_string($this->cn, $object->get('codigo_biblioteca'));
                        $fecha_inicio = mysqli_real_escape_string($this->cn, $object->get('fecha_inicio'));
                        $cantidad_renovacion = mysqli_real_escape_string($this->cn, $object->get('cantidad_renovacion'));
                        $fecha_fin = mysqli_real_escape_string($this->cn, $object->get('fecha_fin'));

                        $this->do_operation("UPDATE  prestamo SET cantidad_renovacion = '$cantidad_renovacion', "
                                . "fecha_fin = '$fecha_fin' WHERE usuario = '$usuario' AND "
                                . "fecha_inicio = '$fecha_inicio' AND codigo_biblioteca = '$codigo_biblioteca';");
                        break;
                    case "return":
                        $usuario = mysqli_real_escape_string($this->cn, $object->get('usuario'));
                        $codigo_biblioteca = mysqli_real_escape_string($this->cn, $object->get('codigo_biblioteca'));
                        $fecha_inicio = mysqli_real_escape_string($this->cn, $object->get('fecha_inicio'));
                        $fecha_entrega = mysqli_real_escape_string($this->cn, $object->get('fecha_entrega'));

                        $this->do_operation("UPDATE  prestamo SET fecha_entrega = '$fecha_entrega' WHERE "
                                . "usuario = '$usuario' AND fecha_inicio = '$fecha_inicio' AND "
                                . "codigo_biblioteca = '$codigo_biblioteca';");
                        break;
                }
                break;
            
            
             case "publicacion":
                switch($options['lvl2'])
                {
                        case "normal":
                        $codigo_publicacion=mysqli_real_escape_string($this->cn,$object->get('codigo_publicacion'));
                        $codigo_biblioteca=mysqli_real_escape_string($this->cn,$object->get('codigo_biblioteca'));
                        $categoria=mysqli_real_escape_string($this->cn,$object->get('categoria'));
                        $tipo=mysqli_real_escape_string($this->cn,$object->get('tipo'));
                        $nombre=mysqli_real_escape_string($this->cn,$object->get('nombre'));
                        $fecha_publicacion=mysqli_real_escape_string($this->cn,$object->get('fecha_publicacion'));
                        $clasificacion=mysqli_real_escape_string($this->cn,$object->get('clasificacion'));
                        //$cantidad_disponible=mysqli_real_escape_string($this->cn,$object->get('cantidad_disponible'));
                        //$cantidad_total=mysqli_real_escape_string($this->cn,$object->get('cantidad_total'));
                        //$codigo_biblioteca=mysqli_real_escape_string($this->cn,$object->auxiliars['codigo_biblioteca']);
                        //$id_ant=mysqli_real_escape_string($this->cn,$object->auxiliars['id_ant']);
                        //echo "-->>>>> " . $object->auxiliars['id_ant'];
                        //echo("UPDATE publicacion SET codigo_publicacion='$codigo_publicacion', codigo_biblioteca='$codigo_biblioteca', categoria='$categoria', tipo='$tipo', nombre='$nombre', fecha_publicacion='$fecha_publicacion', clasificacion='$clasificacion' WHERE codigo_biblioteca='$codigo_biblioteca';");
                        $this->do_operation("UPDATE publicacion SET codigo_publicacion='$codigo_publicacion', codigo_biblioteca='$codigo_biblioteca', categoria='$categoria', tipo='$tipo', nombre='$nombre', fecha_publicacion='$fecha_publicacion', clasificacion='$clasificacion' WHERE codigo_biblioteca='$codigo_biblioteca';"); //WHERE codigo_biblioteca='$id_ant' para modificar el codigo_biblioteca
                        break;
                }
                break;

            default: break;
        }
    }

    //function for delete data from db
    public function delete($options, $object) {
        switch ($options['lvl1']) {
            case "user":
                switch ($options['lvl2']) {
                    case "normal":
                        //
                        break;
                }
                break;
            
            case "publicacion":
                switch ($options['lvl2']) {
                    case "normal":
                        $codigo_biblioteca=mysqli_real_escape_string($this->cn,$object->get("codigo_biblioteca"));
			$this->do_operation("delete from publicacion where codigo_biblioteca='$codigo_biblioteca'"); 
                    break;
                }
                break;

            default: break;
        }
    }

    //function that returns an array with data from a operation
    public function select($option, $data) {
        $info = array();
        switch ($option['lvl1']) {
            case "usuario":

                switch ($option['lvl2']) {
                    case "all" :
                        $info = $this->get_data("SELECT * FROM usuario;");
                        break;
                    case "by_email":
                        $email = mysqli_real_escape_string($this->cn, $data['email']);
                        $info = $this->get_data("SELECT * FROM usuario WHERE email='$email';");
                        break;
                    case "id":
                        $identificacion = mysqli_real_escape_string($this->cn, $data['identificacion']);
                        $info = $this->get_data("SELECT * FROM usuario WHERE identificacion='$identificacion';");
                        break;                   
                }
                break;
            case "empleado":
                switch ($option['lvl2']) {
                    case "all" :
                        $info = $this->get_data("SELECT * FROM empleado;");
                        break;
                    case "by_email":
                        $email = mysqli_real_escape_string($this->cn, $data['email']);
                        $info = $this->get_data("SELECT * FROM empleado WHERE email='$email';");
                        break;
                }
                break;

            case "administrador":
                switch ($option['lvl2']) {
                    case "all" :
                        $info = $this->get_data("SELECT * FROM administrador;");
                        break;
                    case "by_email":
                        $email = mysqli_real_escape_string($this->cn, $data['email']);
                        $info = $this->get_data("SELECT * FROM administrador WHERE email='$email';");
                        break;
                }
                break;

            case "publicacion":
                switch ($option['lvl2']) {
                    case "all" :
                        $info = $this->get_data("SELECT * FROM publicacion;");
                        break;
                    case "one" :
                        $codigo_biblioteca = mysqli_real_escape_string($this->cn, $data['codigo_biblioteca']);
                        $info = $this->get_data("SELECT * FROM publicacion WHERE codigo_biblioteca = '$codigo_biblioteca'");
                        break;

                    case "by_codigo_publicacion":
                        $codigo_publicacion= mysqli_real_escape_string($this->cn, $data['textoBusqueda']);
                        $info = $this->get_data("select p.*, a.nombre as nombreAutor from publicacion p inner join colaboracion c on c.codigo_biblioteca=p.codigo_biblioteca inner join autor a on a.consecutivo=c.autor WHERE p.codigo_publicacion='$codigo_publicacion';");
                        break;

                    case "by_nombre":
                        $nombre= mysqli_real_escape_string($this->cn, $data['textoBusqueda']);
                        $info = $this->get_data("select p.*, a.nombre as nombreAutor from publicacion p inner join colaboracion c on c.codigo_biblioteca=p.codigo_biblioteca inner join autor a on a.consecutivo=c.autor  WHERE p.nombre like '%$nombre%';");
                        break;

                    case "by_autor":
                        $autor= mysqli_real_escape_string($this->cn, $data['textoBusqueda']);
                        $info = $this->get_data("select p.*, a.nombre as nombreAutor from publicacion p inner join colaboracion c on c.codigo_biblioteca=p.codigo_biblioteca inner join autor a on a.consecutivo=c.autor where a.nombre like '%$autor%';");
                        break;
                }
                break;

            case "prestamo":
                switch ($option['lvl2']) {
                    case "all" :
                        $info = $this->get_data("SELECT * FROM prestamo;");
                        break;
                    case "for_renew":
                        $usuario = mysqli_real_escape_string($this->cn, $data['usuario']);
                        $info = $this->get_data("SELECT * FROM prestamo WHERE usuario= '$usuario' AND "
                                . "cantidad_renovacion < 3 AND fecha_entrega IS NULL;");
                        break;
                    case "for_return":
                        $usuario = mysqli_real_escape_string($this->cn, $data['usuario']);
                        $info = $this->get_data("SELECT * FROM prestamo WHERE usuario='$usuario' AND fecha_entrega IS NULL;");
                        break;
                }
                break;

            default: break;
        }
        return $info;
    }

    //close the db connection
    public function close() {
        if ($this->cn) {
            mysqli_close($this->cn);
        }
    }

}

?>
