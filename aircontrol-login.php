<?php
session_start();

// Verificar se o utilizador já está autenticado
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    if ($_SESSION['userProfile'] === 'cliente') {
        header("Location: cliente-dashboard.php");
        exit;
    } elseif ($_SESSION['userProfile'] === 'gestor') {
        header("Location: gestor-dashboard.php");
        exit;
    } elseif ($_SESSION['userProfile'] === 'tecnico') {
        header("Location: tecnico-dashboard.php");
        exit;
    }
}

// Processar o formulário de login
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $perfil = $_POST["perfil"] ?? "";
    $remember = isset($_POST["remember"]);

    // Credenciais de teste — podes trocar por base de dados depois
    if ($email === "teste@gmail.com" && $password === "123") {

        // Guardar sessão
        $_SESSION["isLoggedIn"] = true;
        $_SESSION["userEmail"] = $email;
        $_SESSION["userName"] = "Utilizador Teste";
        $_SESSION["userProfile"] = $perfil;

        // Remember Me opcional (cookies)
        if ($remember) {
            setcookie("rememberEmail", $email, time() + (86400 * 30));
            setcookie("rememberPassword", $password, time() + (86400 * 30));
            setcookie("rememberProfile", $perfil, time() + (86400 * 30));
        } else {
            setcookie("rememberEmail", "", time() - 3600);
            setcookie("rememberPassword", "", time() - 3600);
            setcookie("rememberProfile", "", time() - 3600);
        }

        // Redirecionar
        if ($perfil === "cliente") {
            header("Location: cliente-dashboard.php");
            exit;
        } elseif ($perfil === "gestor") {
            header("Location: gestor-dashboard.php");
            exit;
        } elseif ($perfil === "tecnico") {
            header("Location: tecnico-dashboard.php");
            exit;
        }
    } else {
        $error = "Email ou password incorretos!";
    }
}

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirControl - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="login-card">

            <!-- Logo -->
            <div class="header">
                <div class="logo">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <circle cx="20" cy="20" r="18" fill="#3B9FF3"/>
                        <path d="M12 20L18 14L24 20L30 14" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 26L18 20L24 26L30 20" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h1>AirControl</h1>
                </div>
            </div>

            <!-- Boas-vindas -->
            <p class="welcome-text">Bem-vindo ao seu registo!</p>

            <!-- Mensagem de erro (PHP) -->
            <?php if ($error): ?>
                <div class="error-message" style="color:#e74c3c; text-align:center; margin-bottom:15px;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Formulário -->
            <form class="login-form" method="POST">
                <input type="email" name="email" placeholder="Email" class="input-field"
                       value="<?= $_COOKIE['rememberEmail'] ?? '' ?>" required>

                <input type="password" name="password" placeholder="Password" class="input-field"
                       value="<?= $_COOKIE['rememberPassword'] ?? '' ?>" required>

                <select name="perfil" class="input-field select-field" required>
                    <option value="" disabled selected>Seu perfil</option>
                    <option value="cliente" <?= (($_COOKIE['rememberProfile'] ?? '') === 'cliente') ? 'selected' : '' ?>>Cliente</option>
                    <option value="gestor" <?= (($_COOKIE['rememberProfile'] ?? '') === 'gestor') ? 'selected' : '' ?>>Gestor</option>
                    <option value="tecnico" <?= (($_COOKIE['rememberProfile'] ?? '') === 'tecnico') ? 'selected' : '' ?>>Técnico</option>
                </select>

                <div class="options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" class="checkbox">
                        <span>Remember me</span>
                    </label>

                    <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="login-button">Login</button>
            </form>

        </div>
    </div>

</body>
</html>