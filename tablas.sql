 
CREATE TABLE publicacion (
codigo_biblioteca VARCHAR(30) NOT NULL,  
codigo_publicacion VARCHAR(30) NOT NULL,
categoria VARCHAR(30) NOT NULL,
tipo VARCHAR(30) NOT NULL,  
nombre VARCHAR(30) NOT NULL,  
fecha_publicacion DATE NOT NULL,
PRIMARY KEY (codigo_biblioteca, codigo_publicacion)
);  
 
 
CREATE TABLE usuario(
identificacion INTEGER(20) NOT NULL,
nombre VARCHAR(30) NOT NULL,
contraseña VARCHAR(100) NOT NULL,
direccion VARCHAR(40) NOT NULL,
telefono INTEGER(20) NOT NULL,
estado VARCHAR(20) NOT NULL,
multa INTEGER(20) NOT NULL,
email VARCHAR(40) NOT NULL,
PRIMARY KEY(identificacion));

INSERT INTO usuario VALUE('100','pablo','1234','calle 4',5555555,'ACTIVO',0,'pablo@correo.com');
INSERT INTO usuario VALUE('200','diana','gato','calle 4',5555555,'ACTIVO',0,'diana@correo.com');
INSERT INTO usuario VALUE('300','omar','casa2000perro','calle 4',5555555,'ACTIVO',0,'omar@correo.com');
 
CREATE TABLE empleado(
identificacion INTEGER(20) NOT NULL,
nombre VARCHAR(30) NOT NULL,
contraseña VARCHAR(100) NOT NULL,
direccion VARCHAR(40) NOT NULL,
telefono INTEGER(20) NOT NULL,
email VARCHAR(40) NOT NULL,
PRIMARY KEY (identificacion)
);
 
CREATE TABLE administrador(
identificacion INTEGER(20) NOT NULL,
nombre VARCHAR(30) NOT NULL,
contraseña VARCHAR(100) NOT NULL,
direccion VARCHAR(40) NOT NULL,
telefono INTEGER(20) NOT NULL,
email VARCHAR(40) NOT NULL,
PRIMARY KEY (identificacion)
);
 
CREATE TABLE autor
(
consecutivo INTEGER(20),
nombre VARCHAR(30) not null,
PRIMARY KEY(consecutivo)
);
 
CREATE TABLE prestamo(
fecha_inicio DATE NOT NULL,
fecha_fin DATE NOT NULL,
codigo_biblioteca VARCHAR(30) NOT NULL,
codigo_publicacion VARCHAR(30) NOT NULL,
usuario INTEGER(20) NOT NULL,
FOREIGN KEY (codigo_biblioteca,codigo_publicacion) REFERENCES publicacion(codigo_biblioteca,codigo_publicacion),
FOREIGN KEY (usuario) REFERENCES usuario(identificacion),
PRIMARY KEY(codigo_biblioteca,codigo_publicacion,usuario));
 
 
CREATE TABLE colaboracion (
    autor INTEGER(20),
    codigo_biblioteca VARCHAR(30),
    codigo_publicacion VARCHAR(30),
    PRIMARY KEY (autor, codigo_biblioteca, codigo_publicacion),
    FOREIGN KEY (autor) REFERENCES autor(consecutivo),
    FOREIGN KEY (codigo_biblioteca,codigo_publicacion) REFERENCES publicacion(codigo_biblioteca,codigo_publicacion)
);

