CREATE TABLE publicacion (
codigo_biblioteca VARCHAR(30) NOT NULL,  
codigo_publicacion VARCHAR(30) NOT NULL,
categoria VARCHAR(30) NOT NULL,
tipo VARCHAR(30) NOT NULL,  
nombre VARCHAR(30) NOT NULL,
clasificacion VARCHAR(30) NOT NULL,  
fecha_publicacion DATE NOT NULL,
PRIMARY KEY (codigo_biblioteca)
);  
 
 
CREATE TABLE usuario(
identificacion INTEGER(20) NOT NULL,
nombre VARCHAR(30) NOT NULL,
contraseña VARCHAR(100) NOT NULL,
direccion VARCHAR(40) NOT NULL,
telefono INTEGER(20) NOT NULL,
estado VARCHAR(20) NOT NULL,
multa INTEGER(20) NOT NULL,
email VARCHAR(40) UNIQUE NOT NULL,
PRIMARY KEY(identificacion));

CREATE TABLE empleado(
identificacion INTEGER(20) NOT NULL,
nombre VARCHAR(30) NOT NULL,
contraseña VARCHAR(100) NOT NULL,
direccion VARCHAR(40) NOT NULL,
telefono INTEGER(20) NOT NULL,
email VARCHAR(40) UNIQUE NOT NULL,
PRIMARY KEY (identificacion)
);
 
CREATE TABLE administrador(
identificacion INTEGER(20) NOT NULL,
nombre VARCHAR(30) NOT NULL,
contraseña VARCHAR(100) NOT NULL,
direccion VARCHAR(40) NOT NULL,
telefono INTEGER(20) NOT NULL,
email VARCHAR(40) UNIQUE NOT NULL,
PRIMARY KEY (identificacion)
);
 
CREATE TABLE autor
(
consecutivo INTEGER(20) NOT NULL AUTO_INCREMENT,
nombre VARCHAR(30) not null,
PRIMARY KEY(consecutivo)
);
 
CREATE TABLE prestamo(
fecha_inicio DATE NOT NULL,
fecha_entrega DATE,
fecha_fin DATE NOT NULL,
codigo_biblioteca VARCHAR(30) NOT NULL,
usuario INTEGER(20) NOT NULL,
cantidad_renovacion INTEGER(20) NOT NULL,
FOREIGN KEY (codigo_biblioteca) REFERENCES publicacion(codigo_biblioteca),
FOREIGN KEY (usuario) REFERENCES usuario(identificacion),
PRIMARY KEY(codigo_biblioteca,usuario,fecha_inicio));
 
 
CREATE TABLE colaboracion (
    autor INTEGER(20),
    codigo_biblioteca VARCHAR(30),
    FOREIGN KEY (autor) REFERENCES autor(consecutivo),
    FOREIGN KEY (codigo_biblioteca) REFERENCES publicacion(codigo_biblioteca),
    PRIMARY KEY (autor, codigo_biblioteca)
);
