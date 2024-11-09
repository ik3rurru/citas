document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("reservaForm");
    const dniInput = document.getElementById("dni");
    const emailInput = document.getElementById("email");
    const tipoCitaPrimera = document.getElementById("tipo_cita_primera");
    const tipoCitaRevision = document.getElementById("tipo_cita_revision");

    // Función para validar el formato de correo electrónico
    function validarEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Evento para verificar si el DNI existe en la base de datos cuando el usuario ingresa su DNI
    dniInput.addEventListener("blur", function() {
        const dni = dniInput.value;
        
        if (dni) { // Solo realiza la consulta si hay un DNI ingresado
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "check_dni.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText === "existe") {
                        tipoCitaRevision.checked = true;
                        tipoCitaPrimera.disabled = true;
                    } else {
                        tipoCitaPrimera.checked = true;
                        tipoCitaRevision.disabled = true;
                    }
                }
            };
            xhr.send("dni=" + encodeURIComponent(dni));
        }
    });

    // Evento de envío del formulario
    form.addEventListener("submit", function(event) {
        // Validar el email antes de enviar el formulario
        if (!validarEmail(emailInput.value)) {
            alert("Por favor, introduce un correo electrónico válido.");
            event.preventDefault(); // Evita que el formulario se envíe si la validación falla
        }
    });
});