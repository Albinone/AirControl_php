<?php
require_once 'inc.php';
require_login();
$userName = $_SESSION['userName'] ?? 'Utilizador';
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ler campos
    $nome = trim($_POST['nome'] ?? '');
    $clienteNo = trim($_POST['cliente_no'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    // Validações simples
    if ($nome === '') $errors[] = 'Nome é obrigatório.';
    if ($clienteNo === '') $errors[] = 'N.º Cliente é obrigatório.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido.';
    if ($descricao === '') $errors[] = 'Descrição do problema é obrigatória.';

    if (empty($errors)) {
        // Criar novo pedido (simulado)
        $newId = 'PED-'.date('Y').'-'.str_pad(count($_SESSION['orders'])+1, 3, '0', STR_PAD_LEFT);
        $newOrder = [
            'id' => $newId,
            'date' => date('Y-m-d'),
            'type' => 'Serviço',
            'intervention' => 'Limpeza',
            'technician' => 'A atribuir',
            'status' => 'Aberto',
            'notes' => $descricao . " (Contact: $nome / $email / Cliente: $clienteNo)"
        ];
        $_SESSION['orders'][] = $newOrder;
        $success = "Pedido $newId registado com sucesso.";
        // limpar POST (prático)
        $_POST = [];
    }
}
?><!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirControl - Registar Pedidos</title>
    <link rel="stylesheet" href="cliente-registo-pedidos-styles.css">
    <style>body{font-family:Arial, sans-serif}.sidebar{float:left;width:200px;padding:16px;background:#f4f6f8;height:100vh}.main-content{margin-left:220px;padding:20px}.form-card{border:1px solid #ddd;padding:16px;border-radius:8px}</style>
</head>
<body>
    <aside class="sidebar">
        <h2>AirControl</h2>
        <nav>
            <a href="cliente-dashboard.php">HOME</a><br>
            <a href="cliente-registo-pedidos.php" class="active">Registar Pedidos</a><br>
            <a href="cliente-consultar-pedidos.php">Consultar Pedidos</a><br>
            <a href="cliente-avaliacao.php">Avaliação</a>
        </nav>
    </aside>

    <main class="main-content">
        <header><h1>Registar Pedidos</h1><div>Utilizador: <?= e($userName) ?></div></header>

        <section class="form-container">
            <div class="form-card">
                <?php if ($success): ?>
                    <div style="padding:8px;background:#d1fae5;border:1px solid #10b981;margin-bottom:12px"><?= e($success) ?></div>
                <?php endif; ?>

                <?php if (!empty($errors)): ?>
                    <div style="padding:8px;background:#fee2e2;border:1px solid #ef4444;margin-bottom:12px">
                        <ul>
                        <?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" class="support-form">
                    <div>
                        <input type="text" name="nome" class="form-input" placeholder="Nome" value="<?= e($_POST['nome'] ?? '') ?>" required>
                    </div>
                    <div>
                        <input type="text" name="cliente_no" class="form-input" placeholder="N.º Cliente" value="<?= e($_POST['cliente_no'] ?? '') ?>" required>
                    </div>
                    <div>
                        <input type="email" name="email" class="form-input" placeholder="Email" value="<?= e($_POST['email'] ?? '') ?>" required>
                    </div>
                    <div>
                        <textarea name="descricao" class="form-textarea" placeholder="Descrição do Problema" rows="6" required><?= e($_POST['descricao'] ?? '') ?></textarea>
                    </div>

                    <div style="margin-top:12px">
                        <button type="submit">ENVIAR</button>
                        <button type="button" onclick="window.location.href='cliente-dashboard.php'">CANCELAR</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
