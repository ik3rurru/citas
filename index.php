<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Citas</title>
    <script src="scripts.js"></script>
</head>
<body>
    <h2>Reserva de Citas en Clínica de Psicología</h2>
    <form id="reservaForm" action="process_reservas.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        DNI: <input type="text" name="dni" id="dni" required><br>
        Teléfono: <input type="text" name="telefono" required><br>
        Email: <input type="email" name="email" id="email" required><br>
        <label>Tipo de cita:</label><br>
        <input type="radio" id="tipo_cita_primera" name="tipo_cita" value="Primera consulta" required>
        <label for="tipo_cita_primera">Primera consulta</label><br>
        <input type="radio" id="tipo_cita_revision" name="tipo_cita" value="Revisión">
        <label for="tipo_cita_revision">Revisión</label><br>
        <button type="submit">Reservar Cita</button>
    </form>
</body>
</html>
