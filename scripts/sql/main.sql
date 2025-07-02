-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS employees_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar la base de datos
USE employees_db;

-- Crear la tabla de empleados
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20),
    address TEXT,
    province VARCHAR(50),
    zipcode VARCHAR(10),
    primary_school VARCHAR(100),
    high_school VARCHAR(100),
    college VARCHAR(100),
    degree_title VARCHAR(100),
    job_position VARCHAR(100),
    experience TEXT,
    spouse VARCHAR(100),
    children_quantity INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Crear índices para mejorar el rendimiento
CREATE INDEX idx_email ON employees(email);
CREATE INDEX idx_name ON employees(name);
CREATE INDEX idx_job_position ON employees(job_position);

-- Insertar datos de ejemplo (opcional)
INSERT INTO employees (name, email, phone, address, province, zipcode, primary_school, high_school, college, degree_title, job_position, experience, spouse, children_quantity) VALUES
('Juan Pérez', 'juan.perez@email.com', '0999123456', 'Av. Principal 123', 'Guayas', '090101', 'Escuela Fiscal Juan Montalvo', 'Colegio Nacional', 'Universidad de Guayaquil', 'Ingeniero en Sistemas', 'Desarrollador Web', '3 años de experiencia en desarrollo web', 'María García', 2),
('Ana López', 'ana.lopez@email.com', '0987654321', 'Calle Secundaria 456', 'Pichincha', '170101', 'Escuela Particular San José', 'Colegio La Salle', 'Pontificia Universidad Católica', 'Licenciada en Administración', 'Gerente de Ventas', '5 años en gestión comercial', '', 0);