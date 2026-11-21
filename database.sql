CREATE DATABASE IF NOT EXISTS Lotificacion CHARACTER SET utf8 COLLATE utf8_general_ci;
USE Lotificacion;

CREATE TABLE cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    	nombre VARCHAR(100) NOT NULL,
    	dpi VARCHAR(20),
    	telefono VARCHAR(20),
    	direccion VARCHAR(150)  );

CREATE TABLE proyecto (
    id_proyecto INT AUTO_INCREMENT PRIMARY KEY,
    	nombre VARCHAR(100) NOT NULL,
    	ubicacion VARCHAR(150)
);

CREATE TABLE lote (
    id_lote INT AUTO_INCREMENT PRIMARY KEY,
    	codigo VARCHAR(30) NOT NULL,
    	id_proyecto INT,
    	area DECIMAL(10,2),
    	precio DECIMAL(10,2) NOT NULL,
    	estado VARCHAR(20) DEFAULT 'Disponible',
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto) );

CREATE TABLE financiamiento (
    
    id_financiamiento INT AUTO_INCREMENT PRIMARY KEY,
    	id_lote INT,
    	id_cliente INT,
    	meses INT NOT NULL,
    	cuota_mensual DECIMAL(10,2) NOT NULL,
    	fecha_inicio DATE,
    	saldo DECIMAL(10,2),
    FOREIGN KEY (id_lote) REFERENCES lote(id_lote),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);


CREATE TABLE cobro (
    id_cobro INT AUTO_INCREMENT PRIMARY KEY,
    id_financiamiento INT,
    fecha DATE,
    monto DECIMAL(10,2),
    capital DECIMAL(10,2),
    interes DECIMAL(10,2),
    FOREIGN KEY (id_financiamiento) REFERENCES financiamiento(id_financiamiento)
);

INSERT INTO proyecto (nombre, ubicacion) VALUES

('Lotificacion Las Flores', 'Zona 7'),

	('Residencial San Pedro', 'Km 15');


INSERT INTO cliente (nombre, dpi, telefono, direccion) VALUES
	('Juan Perez', '1234', '5555-1111', 'Ciudad');


INSERT INTO lote (codigo, id_proyecto, area, precio, estado) VALUES
	('A-01', 1, 180.00, 35000.00, 'Disponible'),
		('A-02', 1, 200.00, 42000.00, 'Disponible');
