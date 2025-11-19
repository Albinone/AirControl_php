<?php
require_once 'inc.php';
require_login();
$userName = $_SESSION['userName'] ?? 'Utilizador';
$orders = $_SESSION['orders'];

// Filtrar (simples) se vier um query param
$filterType = $_GET['type'] ?? '';
$filtered = array_filter($orders, function($o) use ($filterType){
    if (!$filterType) return true;
    return strcasecmp($o['type'], $filterType) === 0;
});
?><!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirControl - Consultar Pedidos</title>
    <link rel="stylesheet" href="cliente-consultar-pedidos-styles.css">
    <style>body{font-family:Arial, sans-serif}.sidebar{float:left;width:200px;padding:16px;background:#f4f6f8;height:100vh}.main-content{margin-left:220px;padding:20px}table{width:100%;border-collapse:collapse}th,td{border:1px solid #ddd;padding:8px}</style>
</head>
<body>
    <aside class="sidebar">
        <h2>AirControl</h2>
        <nav>
            <a href="cliente-dashboard.php">HOME</a><br>
            <a href="cliente-registo-pedidos.php">Registar Pedido</a><br>
            <a href="cliente-consultar-pedidos.php" class="active">Consultar Pedidos</a><br>
            <a href="cliente-avaliacao.php">Avaliação</a>
        </nav>
    </aside>

    <main class="main-content">
        <header><h1>Meus Pedidos</h1><div>Utilizador: <?= e($userName) ?></div></header>

        <section class="orders-section">
            <div class="section-header">
                <h2>Histórico de Pedidos</h2>
                <div class="header-actions">
                    <form method="get" style="display:inline">
                        <select name="type">
                            <option value="">Todos os tipos</option>
                            <option value="Serviço" <?= $filterType==='Serviço' ? 'selected':'' ?>>Serviço</option>
                            <option value="Manutenção" <?= $filterType==='Manutenção' ? 'selected':'' ?>>Manutenção</option>
                            <option value="Urgente" <?= $filterType==='Urgente' ? 'selected':'' ?>>Urgente</option>
                        </select>
                        <button type="submit">Filtrar</button>
                    </form>
                    <form method="post" action="export.php" style="display:inline">
                        <button type="submit">Exportar CSV</button>
                    </form>
                </div>
            </div>

            <div class="table-container">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Data Pedido</th>
                            <th>Tipo Pedido</th>
                            <th>Intervenção</th>
                            <th>Técnico</th>
                            <th>Estado</th>
                            <th>Observações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filtered as $o): ?>
                        <tr>
                            <td><?= e($o['id']) ?></td>
                            <td><?= e(date('d/m/Y', strtotime($o['date']))) ?></td>
                            <td><?= e($o['type']) ?></td>
                            <td><?= e($o['intervention']) ?></td>
                            <td><?= e($o['technician']) ?></td>
                            <td><span class="badge badge-open"><?= e($o['status']) ?></span></td>
                            <td><?= e($o['notes']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Resumo simples -->
            <div class="summary-section" style="margin-top:16px">
                <h3>Resumo Rápido</h3>
                <ul>
                    <li>Total Pedidos: <?= count($orders) ?></li>
                    <li>Abertos: <?= count(array_filter($orders, fn($x)=>$x['status']==='Aberto')) ?></li>
                    <li>Concluídos: <?= count(array_filter($orders, fn($x)=>$x['status']==='Concluído')) ?></li>
                </ul>
            </div>
        </section>
    </main>
</body>
</html>
