<?php
session_start();

// Verificar se o utilizador está autenticado
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: aircontrol-login.php");
    exit();
}

// Recuperar nome do utilizador
$userName = $_SESSION['userName'] ?? "Utilizador";
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirControl - Dashboard do Gestor</title>
    <link rel="stylesheet" href="gestor-dashboard-styles.css">
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-container">
            <svg width="32" height="32" viewBox="0 0 40 40" fill="none">
                <circle cx="20" cy="20" r="18" fill="#3B9FF3"/>
                <path d="M12 20L18 14L24 20L30 14" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 26L18 20L24 26L30 20" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2>AirControl</h2>
        </div>

        <nav class="nav-menu">
            <a href="gestor-dashboard.php" class="nav-item active">HOME</a>
            <a href="gestor-tecnicos.php" class="nav-item">Técnicos</a>
            <a href="gestor-clientes.php" class="nav-item">Clientes</a>
            <a href="gestor-pedidos-aprimorado.php" class="nav-item">Pedidos</a>
            <a href="gestor-relatorio.php" class="nav-item">Relatório</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Header -->
        <header class="header">
            <h1 class="welcome-title">Dashboard do Gestor</h1>

            <div class="user-profile" onclick="toggleLogoutMenu()">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <circle cx="10" cy="6" r="4" fill="#6B7280"/>
                    <path d="M4 18C4 14.6863 6.68629 12 10 12C13.3137 12 16 14.6863 16 18" stroke="#6B7280" stroke-width="2"/>
                </svg>

                <span><?= htmlspecialchars($userName) ?></span>

                <div class="logout-dropdown" id="logoutMenu">
                    <a href="logout.php" class="logout-link">Logout</a>
                </div>
            </div>

            <script>
                function toggleLogoutMenu() {
                    document.getElementById('logoutMenu').classList.toggle('show');
                }

                window.onclick = function(event) {
                    if (!event.target.closest('.user-profile')) {
                        var dropdown = document.getElementById('logoutMenu');
                        if (dropdown) dropdown.classList.remove('show');
                    }
                }
            </script>
        </header>

        <!-- TODO: Todo o conteúdo do dashboard aqui (mantido igual ao HTML original) -->
        <?php include "dashboard-content.html"; ?>

    </main>
</body>
</html>
