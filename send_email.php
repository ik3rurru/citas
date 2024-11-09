<?php
function sendEmail($email, $fecha, $hora, $tipo_cita) {
    $subject = "Confirmación de Cita";
    $message = "Su cita ha sido reservada para el $fecha a las $hora.\nTipo de cita: $tipo_cita";
    mail($email, $subject, $message);
}
?>
