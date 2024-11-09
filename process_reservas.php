<?php

// Conexión a la base de datos
require 'db_config.php';

$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$tipo_cita = $_POST['tipo_cita'];

// Verificar si el paciente ya existe o insertar nuevo
$stmt = $pdo->prepare("SELECT id FROM pacientes WHERE dni = ?");
$stmt->execute([$dni]);
$paciente = $stmt->fetch();

if (!$paciente) {
    $stmt = $pdo->prepare("INSERT INTO pacientes (nombre, dni, telefono, email) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $dni, $telefono, $email]);
    $paciente_id = $pdo->lastInsertId();
} else {
    $paciente_id = $paciente['id'];
}

// Asignación de fecha y hora
$fecha = new DateTime();
$fecha->setTime(10, 0); // Inicio del horario laboral

while (true) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM citas WHERE fecha = ? AND hora = ?");
    $stmt->execute([$fecha->format('Y-m-d'), $fecha->format('H:i:s')]);
    if ($stmt->fetchColumn() == 0) {
        break;
    }
    $fecha->modify('+1 hour');
    if ($fecha->format('H') >= 22) {
        $fecha->modify('+1 day')->setTime(10, 0);
    }
}

// Insertar la cita
$stmt = $pdo->prepare("INSERT INTO citas (paciente_id, fecha, hora, tipo_cita) VALUES (?, ?, ?, ?)");
$stmt->execute([$paciente_id, $fecha->format('Y-m-d'), $fecha->format('H:i:s'), $tipo_cita]);

// Enviar correo de confirmación
// include 'send_email.php';
// sendEmail($email, $fecha->format('Y-m-d'), $fecha->format('H:i:s'), $tipo_cita);

// echo "Cita reservada para el " . $fecha->format('Y-m-d') . " a las " . $fecha->format('H:i');


print_r($_POST);
exit;


?>
