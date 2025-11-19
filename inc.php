<?php
// inc.php
// Funções comuns e simulação de "DB" em sessão.
// Coloque require_once 'inc.php' no topo de cada ficheiro PHP.

session_start();

// Simular utilizador autenticado para teste:
// Para testar manualmente, antes de aceder às páginas, pode executar:
// $_SESSION['isLoggedIn'] = true; $_SESSION['userName'] = 'João Silva'; $_SESSION['userEmail'] = 'joao@example.com';

// Helper: check login and redirect to login page se não autenticado
function require_login() {
    if (empty($_SESSION['isLoggedIn'])) {
        header('Location: aircontrol-login.html');
        exit;
    }
}

// Escapar output para evitar XSS
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Inicializar dados de exemplo (somente se não existir)
if (!isset($_SESSION['orders'])) {
    $_SESSION['orders'] = [
        [
            'id' => 'PED-2024-001',
            'date' => '2024-11-01',
            'type' => 'Serviço',
            'intervention' => 'Limpeza',
            'technician' => 'Albino',
            'status' => 'Aberto',
            'notes' => 'Limpeza de filtros de ar condicionado'
        ],
        [
            'id' => 'PED-2024-003',
            'date' => '2024-10-30',
            'type' => 'Urgente',
            'intervention' => 'Reparação',
            'technician' => 'Albino',
            'status' => 'Aberto',
            'notes' => 'Reparação de compressor danificado - Ruído excessivo reportado'
        ],
        [
            'id' => 'PED-2024-005',
            'date' => '2024-10-31',
            'type' => 'Manutenção',
            'intervention' => 'Manutenção',
            'technician' => 'Rui',
            'status' => 'Aberto',
            'notes' => 'Verificação de níveis de gás refrigerante'
        ],
        [
            'id' => 'PED-2024-007',
            'date' => '2024-11-02',
            'type' => 'Manutenção',
            'intervention' => 'Manutenção',
            'technician' => 'Albino',
            'status' => 'Aberto',
            'notes' => 'Inspeção trimestral obrigatória'
        ],
        [
            'id' => 'PED-2024-008',
            'date' => '2024-11-03',
            'type' => 'Serviço',
            'intervention' => 'Limpeza',
            'technician' => 'Rui',
            'status' => 'Aberto',
            'notes' => 'Limpeza de condensadores e evaporadores'
        ],
    ];
}

// Dados de avaliação (copiados/convertidos do HTML)
if (!isset($_SESSION['members'])) {
    $_SESSION['members'] = [
        [
            'name' => 'James Smith',
            'score' => '69%',
            'subtitle' => '55 out of 79 task completed',
            'tasks' => [
                ['label'=>'Task Completed on Time','percent'=>'60%','value'=>49],
                ['label'=>'Task Completed Past Due','percent'=>'5%','value'=>4],
                ['label'=>'Tasks Over Due','percent'=>'35%','value'=>26],
            ],
        ],
        [
            'name' => 'Robert Steve',
            'score' => '85%',
            'subtitle' => '47 out of 55 task completed',
            'tasks' => [
                ['label'=>'Task Completed on Time','percent'=>'70%','value'=>44],
                ['label'=>'Task Completed Past Due','percent'=>'5%','value'=>3],
                ['label'=>'Tasks Over Due','percent'=>'19%','value'=>11],
            ],
        ],
        [
            'name' => 'Maria Garcia',
            'score' => '80%',
            'subtitle' => '36 out of 39 task completed',
            'tasks' => [
                ['label'=>'Task Completed on Time','percent'=>'34%','value'=>14],
                ['label'=>'Task Completed Past Due','percent'=>'45%','value'=>16],
                ['label'=>'Tasks Over Due','percent'=>'21%','value'=>8],
            ],
        ],
        [
            'name' => 'Elly Clark',
            'score' => '79%',
            'subtitle' => '39 out of 39 task completed',
            'tasks' => [
                ['label'=>'Task Completed on Time','percent'=>'63%','value'=>24],
                ['label'=>'Task Completed Past Due','percent'=>'0%','value'=>0],
                ['label'=>'Tasks Over Due','percent'=>'13%','value'=>5],
            ],
        ],
    ];
}
