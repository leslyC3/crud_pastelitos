CREATE DATABASE PastelesDB;
USE PastelesDB;
CREATE TABLE Pastel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
	descripcion TEXT,
    fecha_vencimiento DECIMAL(10, 2),
    Precio DECIMAL(10, 2)
);
CREATE TABLE ingrediente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
     fecha_ingreso DECIMAL (10, 2),
    fecha_vencimiento DECIMAL(10, 2)
);
INSERT INTO Pasteles (nombre, tipo, precio, fecha_vencimiento) VALUES
('Pastel de Chocolate', 'Chocolate', 20.00, 'pastel de chocolate con crema de vainilla.'),
('Pastel de Fresa', 'Frutas', 18.50, ' pastel de fresa con relleno de crema.'),
('Pastel de Zanahoria', 'Zanahoria', 22.00, 'Jugoso pastel de zanahoria.');

SELECT * FROM Pasteles;
