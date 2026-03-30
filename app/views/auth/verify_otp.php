<?php 
session_start();

if (!isset($_SESSION['otp_user'])) {
    header("Location: /Login-Seminario/public/index.php?url=auth/login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código — Vertex</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- TU CSS -->
    <link rel="stylesheet" href="/Login-Seminario/public/css/verify_otp.css">
</head>
<body>

<div class="otp-container">

    <!-- PANEL IZQUIERDO -->
    <aside class="brand-panel">
        <div class="brand-pattern"></div>

        <div class="brand-content">
            <div class="brand-logo">
                <div class="logo-icon">V</div>
                <span class="logo-text">Vertex</span>
            </div>

            <h1 class="brand-tagline">
                Verifica tu <span>identidad</span>
            </h1>

            <p class="brand-description">
                Ingresa el código enviado a tu correo para completar el inicio de sesión.
            </p>

            <div class="otp-visual">
                <div class="otp-icon-wrapper">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="otp-visual-text">Verificación segura</div>
            </div>
        </div>
    </aside>

    <!-- PANEL DERECHO -->
    <main class="form-panel">
        <div class="form-wrapper">

            <div class="form-header">
                <div class="form-icon">
                    <i class="fa-regular fa-message"></i>
                </div>
                <h2 class="form-title">Código OTP</h2>
                <p class="form-subtitle">
                    Ingresa el código de 6 dígitos
                </p>
            </div>

            <!-- FORM -->
            <form action="/Login-Seminario/public/index.php?url=auth/verifyOTPPost" method="POST">

                <!-- INPUTS BONITOS -->
                <div class="otp-inputs">
                    <input type="text" maxlength="1" class="otp-digit">
                    <input type="text" maxlength="1" class="otp-digit">
                    <input type="text" maxlength="1" class="otp-digit">
                    <input type="text" maxlength="1" class="otp-digit">
                    <input type="text" maxlength="1" class="otp-digit">
                    <input type="text" maxlength="1" class="otp-digit">
                </div>

                <!-- INPUT REAL -->
                <input type="hidden" name="code" id="codeHidden">

                <button type="submit" class="btn-primary">
                    Verificar código
                </button>
            </form>

            <div class="bottom-divider">
                <span>¿Te equivocaste?</span>
            </div>

            <a href="/Login-Seminario/public/index.php?url=auth/login" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                Volver al login
            </a>

            <div class="form-footer">
                &copy; 2025 Vertex
            </div>

        </div>
    </main>

</div>

<!-- JS PARA OTP -->
<script>
const inputs = document.querySelectorAll(".otp-digit");
const hidden = document.getElementById("codeHidden");

inputs.forEach((input, index) => {

    input.addEventListener("input", () => {
        input.value = input.value.replace(/[^0-9]/g, '');

        if (input.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }

        updateCode();
    });

    input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !input.value && index > 0) {
            inputs[index - 1].focus();
        }
    });
});

function updateCode() {
    let code = "";
    inputs.forEach(i => code += i.value);
    hidden.value = code;
}
</script>

</body>
</html>