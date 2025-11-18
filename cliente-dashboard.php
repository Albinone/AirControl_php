<?php
session_start();

// Verificar autenticação
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: aircontrol-login.php");
    exit;
}

$userName = $_SESSION['userName'] ?? "Utilizador";
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirControl - Dashboard do Cliente</title>
    <link rel="stylesheet" href="cliente-dashboard-styles.css">
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-container">
            <svg width="32" height="32" viewBox="0 0 40 40" fill="none">
                <circle cx="20" cy="20" r="18" fill="#3B9FF3"/>
                <path d="M12 20L18 14L24 20L30 14" stroke="white" stroke-width="3"/>
                <path d="M12 26L18 20L24 26L30 20" stroke="white" stroke-width="3"/>
            </svg>
            <h2>AirControl</h2>
        </div>

        <nav class="nav-menu">
            <a href="cliente-dashboard.php" class="nav-item active">HOME</a>
            <a href="cliente-registo-pedidos.php" class="nav-item">Registo de Pedidos</a>
            <a href="cliente-consultar-pedidos.php" class="nav-item">Consultar Pedidos</a>
            <a href="cliente-avaliacao.php" class="nav-item">Avaliação</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Header -->
        <header class="header">
            <h1 class="welcome-title">Dashboard do Cliente</h1>

            <div class="user-profile" onclick="toggleLogoutMenu()">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <circle cx="10" cy="6" r="4" fill="#6B7280"/>
                    <path d="M4 18C4 14.6863 6.68629 12 10 12C13.3137 12 16 14.6863 16 18" stroke="#6B7280" stroke-width="2"/>
                </svg>
                <span><?php echo htmlspecialchars($userName); ?></span>

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
                        if (dropdown && dropdown.classList.contains('show')) {
                            dropdown.classList.remove('show');
                        }
                    }
                }
            </script>
        </header>

        <!-- Top Stats Cards -->
        <section class="top-stats">
            <div class="top-stat-card">
                <h3>Pedidos</h3>
                <p class="stat-number">24</p>
            </div>
            <div class="top-stat-card highlighted">
                <h3>Abertos</h3>
                <p class="stat-number">6</p>
            </div>
            <div class="top-stat-card">
                <h3>Em Curso</h3>
                <p class="stat-number">4</p>
            </div>
        </section>

        <!-- Dashboard Section -->
        <section class="dashboard-section">
            <h2 class="section-title">Dashboard</h2>

            <!-- Colored Stats Cards -->
            <div class="colored-stats">
                <div class="colored-card indigo">
                    <p class="card-number">14</p>
                    <p class="card-label">Pedidos Concluídos</p>
                </div>
                <div class="colored-card pink">
                    <p class="card-number">92%</p>
                    <p class="card-label">Satisfação</p>
                </div>
                <div class="colored-card emerald">
                    <p class="card-number">3.2 dias</p>
                    <p class="card-label">Tempo Médio</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-container">
                <!-- (todos os gráficos são mantidos tal como no HTML original) -->
                <?php /* Aqui mantemos todos os SVG e estrutura HTML exatamente iguais */ ?>
                <?= file_get_contents("cliente-dashboard-graficos.html"); ?>
            </div>
        </section>

    </main>
</body>
</html>
