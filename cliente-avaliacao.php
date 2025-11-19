<?php
require_once 'inc.php';
require_login();
$userName = $_SESSION['userName'] ?? 'Utilizador';
$members = $_SESSION['members'];
?><!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirControl - Avaliação</title>
    <link rel="stylesheet" href="cliente-avaliacao-styles.css">
    <style>
        /* Pequeno estilo inline para facilitar visualização se não tiver CSS */
        body{font-family:Arial, sans-serif}
        .sidebar{float:left;width:200px;padding:16px;background:#f4f6f8;height:100vh}
        .main-content{margin-left:220px;padding:20px}
        .member-card{border:1px solid #ddd;padding:12px;border-radius:6px;margin-bottom:12px}
        .progress-bar{background:#eee;height:10px;border-radius:6px;overflow:hidden}
        .progress-fill{height:100%}
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-container">
            <h2>AirControl</h2>
        </div>
        <nav class="nav-menu">
            <a href="cliente-dashboard.php" class="nav-item">HOME</a><br>
            <a href="cliente-registo-pedidos.php" class="nav-item">Registar Pedidos</a><br>
            <a href="cliente-consultar-pedidos.php" class="nav-item">Consultar Pedidos</a><br>
            <a href="cliente-avaliacao.php" class="nav-item active">Avaliação</a>
        </nav>
    </aside>

    <main class="main-content">
        <header class="header">
            <h1 class="page-title">Avaliação</h1>
            <div class="user-profile">
                <span><?= e($userName) ?></span>
                <a href="aircontrol-login.html" onclick="event.preventDefault(); fetch('logout.php').then(()=>location.href='aircontrol-login.html')">Logout</a>
            </div>
        </header>

        <section class="report-section">
            <div class="report-header">
                <h2>Relatório de avaliação de desempenho dos membros da equipe de pesquisa</h2>
            </div>

            <p>
                Os indicadores de avaliação são apresentados de acordo com a avaliação de desempenho, análise de comportamento e avaliação de atitude dos membros da equipe de pesquisa.
            </p>

            <div class="team-grid">
                <?php foreach ($members as $m): ?>
                    <div class="member-card">
                        <div class="member-header">
                            <h3 class="member-name"><?= e($m['name']) ?></h3>
                            <div class="member-score"><?= e($m['score']) ?></div>
                        </div>
                        <p class="member-subtitle"><?= e($m['subtitle']) ?></p>

                        <?php foreach ($m['tasks'] as $task): 
                            // extrair número da percentagem para largura
                            $pct = intval($task['percent']);
                        ?>
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span><?= e($task['label']) ?></span>
                                    <span class="progress-percentage"><?= e($task['percent']) ?></span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= $pct ?>%; background: #777;"></div>
                                </div>
                                <div class="progress-value"><?= e($task['value']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>
