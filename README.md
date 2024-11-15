# Sistema de Reservas Online para Clínica de Psicología

Este proyecto es una aplicación web de reservas para una clínica de psicología, donde los pacientes pueden registrar sus citas. El sistema permite la creación de nuevas citas o la actualización de citas existentes, asignando automáticamente una fecha y hora disponible para las consultas. 

## Requisitos

- **PHP 7.4+**
- **MySQL 5.7+**
- **Servidor web (por ejemplo yo he utulizado XAMP)**


## Instalación y configuración

Sigue estos pasos para instalar y ejecutar el proyecto en tu servidor local o en producción.

### 1. Clonar el proyecto en el directorio httpdocs.
````
git clone https://github.com/ik3rurru/citas.git
cd Citas
````

ubicar archivos del ptoyecto en un servidor

### 3. Crear tablas para la base de datos

Vamos a crear las tablas que usaremos

citas:

````
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    tipo_cita ENUM('Primera consulta', 'Revisión') NOT NULL,
    fecha DATETIME NOT NULL,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
);


````
Pacientes 

````
CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    dni VARCHAR(20) UNIQUE NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL
);
`````

## Archivos importantes
***check_dni.php***: Verifica si el DNI proporcionado ya existe en la base de datos.

***process_reserva.php***: Procesa las solicitudes de reserva y asigna una cita al paciente.

***db_config.php***: Archivo de configuración para la conexión a la base de datos.

## Envío de correos electrónicos (opcional)

Esta parte no esta completada. hay parte del codigo hecho pero por falta de tiempo no está terminada
