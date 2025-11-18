<?php
// Aqui podes ativar sessões caso desejes autenticação em PHP
// session_start();
// if (!isset($_SESSION["logged_in"])) {
//     header("Location: aircontrol-login.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirControl - Dashboard do Técnico</title>
    <link rel="stylesheet" href="tecnico-dashboard-styles.css">
</head>
<body>
    <script>
        // Verificar autenticação via localStorage (mantive igual ao original)
        if (!localStorage.getItem('isLoggedIn')) {
            window.location.href = 'aircontrol-login.html';
        }
        
        // Atualizar nome do utilizador
        window.addEventListener('DOMContentLoaded', function() {
            const userName = localStorage.getItem('userName') || 'Utilizador';
            const userNameElements = document.querySelectorAll('.user-profile span');
            userNameElements.forEach(el => {
                if (el.textContent.includes('Nome do utilizador')) {
                    el.textContent = userName;
                }
            });
        });
    </script>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-container">
            <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="20" r="18" fill="#3B9FF3"/>
                <path d="M12 20L18 14L24 20L30 14" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 26L18 20L24 26L30 20" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2>AirControl</h2>
        </div>

        <nav class="nav-menu">
            <a href="tecnico-dashboard.php" class="nav-item active">HOME</a>
            <a href="tecnico-ordens.php" class="nav-item">Ordens de Serviço</a>
            <a href="tecnico-documentacao.php" class="nav-item">Documentação</a>
            <a href="tecnico-materiais.php" class="nav-item">Equipamentos e Materiais</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="header">
            <h1 class="welcome-title">Dashboard do Técnico</h1>
            <div class="user-profile" onclick="toggleLogoutMenu()">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="10" cy="6" r="4" fill="#6B7280"/>
                    <path d="M4 18C4 14.6863 6.68629 12 10 12C13.3137 12 16 14.6863 16 18" stroke="#6B7280" stroke-width="2"/>
                </svg>
                <span>Nome do utilizador</span>
                <div class="logout-dropdown" id="logoutMenu">
                    <a href="aircontrol-login.php" class="logout-link" onclick="handleLogout()">Logout</a>
                </div>
            </div>

            <script>
                function toggleLogoutMenu() {
                    document.getElementById('logoutMenu').classList.toggle('show');
                }
                
                function handleLogout() {
                    const rememberMe = localStorage.getItem('rememberMe');
                    if (rememberMe === 'true') {
                        localStorage.removeItem('isLoggedIn');
                        localStorage.removeItem('userEmail');
                        localStorage.removeItem('userName');
                        localStorage.removeItem('userProfile');
                    } else {
                        localStorage.clear();
                    }
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
                <h3>Atribuídos</h3>
                <p class="stat-number">15</p>
            </div>
            <div class="top-stat-card highlighted">
                <h3>Abertos</h3>
                <p class="stat-number">8</p>
            </div>
            <div class="top-stat-card">
                <h3>Fechados</h3>
                <p class="stat-number">7</p>
            </div>
        </section>

        <!-- Dashboard Section -->
        <section class="dashboard-section">
            <h2 class="section-title">Dashboard</h2>

            <!-- Colored Stats Cards -->
            <div class="colored-stats">
                <div class="colored-card purple">
                    <p class="card-number">23</p>
                    <p class="card-label">Serviços Este Mês</p>
                </div>
                <div class="colored-card blue">
                    <p class="card-number">95%</p>
                    <p class="card-label">Taxa de Conclusão</p>
                </div>
                <div class="colored-card teal">
                    <p class="card-number">4.8</p>
                    <p class="card-label">Avaliação Média</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-container">

                <!-- Serviços Chart -->
                <div class="chart-card">
                    <div class="chart-header"><h3>Serviços</h3></div>
                    <div class="chart-content">
                        <!-- SVG mantido igual -->
                        <?php /* O teu SVG permanece exatamente igual ao HTML */ ?>
                        <svg class="donut-chart" viewBox="0 0 200 200">
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#E5E7EB" stroke-width="30"/>
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#F59E0B" stroke-width="30"
                                stroke-dasharray="266 502" stroke-dashoffset="0" transform="rotate(-90 100 100)"/>
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#10B981" stroke-width="30"
                                stroke-dasharray="236 502" stroke-dashoffset="-266" transform="rotate(-90 100 100)"/>
                            <text x="100" y="95" text-anchor="middle" font-size="32" font-weight="bold" fill="#1F2937">15</text>
                            <text x="100" y="115" text-anchor="middle" font-size="12" fill="#6B7280">Total</text>
                        </svg>

                        <div class="chart-legend">
                            <div class="legend-item">
                                <span class="legend-dot" style="background: #F59E0B;"></span>
                                <span class="legend-label">Abertos</span>
                                <span class="legend-value">8</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-dot" style="background: #10B981;"></span>
                                <span class="legend-label">Fechados</span>
                                <span class="legend-value">7</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prioridade Chart -->
                <div class="chart-card">
                    <div class="chart-header"><h3>Prioridade</h3></div>
                    <div class="chart-content">
                        <svg class="donut-chart" viewBox="0 0 200 200">
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#E5E7EB" stroke-width="30"/>
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#EF4444" stroke-width="30"
                                stroke-dasharray="201 502" stroke-dashoffset="0" transform="rotate(-90 100 100)"/>
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#F59E0B" stroke-width="30"
                                stroke-dasharray="166 502" stroke-dashoffset="-201" transform="rotate(-90 100 100)"/>
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#3B82F6" stroke-width="30"
                                stroke-dasharray="136 502" stroke-dashoffset="-367" transform="rotate(-90 100 100)"/>
                            <text x="100" y="95" text-anchor="middle" font-size="32" font-weight="bold" fill="#1F2937">15</text>
                            <text x="100" y="115" text-anchor="middle" font-size="12" fill="#6B7280">Total</text>
                        </svg>

                        <div class="chart-legend">
                            <div class="legend-item"><span class="legend-dot" style="background:#EF4444"></span><span class="legend-label">Alta</span><span class="legend-value">6</span></div>
                            <div class="legend-item"><span class="legend-dot" style="background:#F59E0B"></span><span class="legend-label">Média</span><span class="legend-value">5</span></div>
                            <div class="legend-item"><span class="legend-dot" style="background:#3B82F6"></span><span class="legend-label">Baixa</span><span class="legend-value">4</span></div>
                        </div>
                    </div>
                </div>

                <!-- Equipamentos Chart -->
                <div class="chart-card">
                    <div class="chart-header"><h3>Equipamentos</h3></div>
                    <div class="chart-content">
                        <svg class="donut-chart" viewBox="0 0 200 200">
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#E5E7EB" stroke-width="30"/>
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#10B981" stroke-width="30"
                                stroke-dasharray="352 502" stroke-dashoffset="0" transform="rotate(-90 100 100)"/>
                            <circle cx="100" cy="100" r="80" fill="none" stroke="#F59E0B" stroke-width="30"
                                stroke-dasharray="151 502" stroke-dashoffset="-352" transform="rotate(-90 100 100)"/>
                            <text x="100" y="95" text-anchor="middle" font-size="32" font-weight="bold" fill="#1F2937">20</text>
                            <text x="100" y="115" text-anchor="middle" font-size="12" fill="#6B7280">Total</text>
                        </svg>

                        <div class="chart-legend">
                            <div class="legend-item"><span class="legend-dot" style="background:#10B981"></span><span class="legend-label">Disponíveis</span><span class="legend-value">14</span></div>
                            <div class="legend-item"><span class="legend-dot" style="background:#F59E0B"></span><span class="legend-label">Em Uso</span><span class="legend-value">6</span></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

</body>
</html>
