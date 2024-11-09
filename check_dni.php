<?php
// Incluir archivo de configuración para la base de datos (db_config.php)
require 'db_config.php';

// Verificar que el valor de DNI se haya recibido
if (isset($_POST['dni']) && !empty($_POST['dni'])) {
    // Obtener el valor del DNI
    $dni = trim($_POST['dni']); // Sanitizamos el DNI para quitar espacios al inicio y al final
    
    try {
        // Preparar la consulta para verificar si el DNI ya existe en la base de datos
        $stmt = $pdo->prepare("SELECT id FROM pacientes WHERE dni = :dni LIMIT 1");
        $stmt->bindParam(':dni', $dni, PDO::PARAM_STR); // Usamos bindParam para evitar inyecciones SQL
        $stmt->execute();
        
        // Verificamos si se ha encontrado un registro con ese DNI
        if ($stmt->rowCount() > 0) {
            // Si existe el DNI, devolvemos "existe"
            echo "existe";
        } else {
            // Si no existe el DNI, devolvemos "no existe"
            echo "no existe";
        }
    } catch (PDOException $e) {
        // En caso de error en la consulta o la conexión a la base de datos
        echo "error"; // Se puede ajustar para enviar un mensaje más detallado si se desea
        error_log("Error en consulta de DNI: " . $e->getMessage()); // Guardamos el error en el log del servidor
    }
} else {
    // Si el DNI no fue recibido correctamente
    echo "no existe";
}
?>
