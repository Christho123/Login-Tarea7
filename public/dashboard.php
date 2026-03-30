<?php
session_start();

// Si no hay sesión de usuario, redirigir al login
if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit;
}

// ==================== DATOS SIMULADOS ====================

// KPIs
 $kpis = [
    [
        'label' => 'Ingresos del mes',
        'value' => '$84,254',
        'change' => '+12.5%',
        'direction' => 'up',
        'icon' => 'fa-solid fa-dollar-sign',
        'color' => 'orange',
        'miniData' => [42, 38, 45, 50, 48, 55, 60, 58, 65, 70, 68, 84]
    ],
    [
        'label' => 'Proyectos activos',
        'value' => '24',
        'change' => '+3',
        'direction' => 'up',
        'icon' => 'fa-solid fa-folder-open',
        'color' => 'blue',
        'miniData' => [18, 20, 19, 22, 21, 23, 22, 24, 23, 24, 24, 24]
    ],
    [
        'label' => 'Tareas completadas',
        'value' => '189',
        'change' => '+28.4%',
        'direction' => 'up',
        'icon' => 'fa-solid fa-check-double',
        'color' => 'green',
        'miniData' => [80, 95, 110, 120, 130, 145, 150, 158, 165, 172, 180, 189]
    ],
    [
        'label' => 'Clientes nuevos',
        'value' => '12',
        'change' => '-4.2%',
        'direction' => 'down',
        'icon' => 'fa-solid fa-user-plus',
        'color' => 'yellow',
        'miniData' => [18, 16, 15, 17, 14, 16, 15, 14, 13, 12, 13, 12]
    ]
];

// Proyectos recientes
 $projects = [
    [
        'name' => 'Rediseño Portal Corporativo',
        'client' => 'Banco Nacional',
        'icon' => 'fa-solid fa-globe',
        'iconBg' => '#3B82F6',
        'status' => 'active',
        'statusText' => 'En progreso',
        'progress' => 72,
        'progressColor' => 'green',
        'members' => [
            ['initials' => 'CR', 'bg' => '#FF6B35'],
            ['initials' => 'ML', 'bg' => '#3B82F6'],
            ['initials' => 'JP', 'bg' => '#10B981'],
        ]
    ],
    [
        'name' => 'App Gestión Inventario',
        'client' => 'LogiTrack SA',
        'icon' => 'fa-solid fa-boxes-stacked',
        'iconBg' => '#F59E0B',
        'status' => 'review',
        'statusText' => 'En revisión',
        'progress' => 91,
        'progressColor' => 'blue',
        'members' => [
            ['initials' => 'AN', 'bg' => '#8B5CF6'],
            ['initials' => 'RS', 'bg' => '#EF4444'],
        ]
    ],
    [
        'name' => 'Dashboard Analítico',
        'client' => 'DataCorp',
        'icon' => 'fa-solid fa-chart-pie',
        'iconBg' => '#10B981',
        'status' => 'pending',
        'statusText' => 'Pendiente',
        'progress' => 35,
        'progressColor' => 'yellow',
        'members' => [
            ['initials' => 'LM', 'bg' => '#F59E0B'],
            ['initials' => 'CR', 'bg' => '#FF6B35'],
            ['initials' => 'DV', 'bg' => '#3B82F6'],
            ['initials' => '+2', 'bg' => '#6B7589'],
        ]
    ],
    [
        'name' => 'Integración API Pagos',
        'client' => 'PayFlow',
        'icon' => 'fa-solid fa-credit-card',
        'iconBg' => '#EF4444',
        'status' => 'paused',
        'statusText' => 'Pausado',
        'progress' => 58,
        'progressColor' => 'orange',
        'members' => [
            ['initials' => 'JP', 'bg' => '#10B981'],
        ]
    ],
    [
        'name' => 'Plataforma E-Learning',
        'client' => 'EduPlus',
        'icon' => 'fa-solid fa-graduation-cap',
        'iconBg' => '#8B5CF6',
        'status' => 'active',
        'statusText' => 'En progreso',
        'progress' => 46,
        'progressColor' => 'green',
        'members' => [
            ['initials' => 'ML', 'bg' => '#3B82F6'],
            ['initials' => 'AN', 'bg' => '#8B5CF6'],
            ['initials' => 'CR', 'bg' => '#FF6B35'],
        ]
    ]
];

// Datos del gráfico de ingresos (últimos 12 meses)
 $chartMonths = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
 $chartIngresos = [42000, 38500, 45200, 50100, 48300, 55400, 60200, 58100, 65400, 70200, 68300, 84254];
 $chartGastos = [28000, 26000, 30000, 32000, 31000, 34000, 36000, 35000, 38000, 41000, 39000, 44000];

// Distribución de proyectos por categoría
 $doughnutData = [
    ['name' => 'Desarrollo Web', 'value' => 42, 'color' => '#FF6B35'],
    ['name' => 'Apps Móviles', 'value' => 28, 'color' => '#3B82F6'],
    ['name' => 'Consultoría', 'value' => 18, 'color' => '#10B981'],
    ['name' => 'Diseño UI/UX', 'value' => 12, 'color' => '#F59E0B'],
];

// Actividad reciente
 $activities = [
    [
        'icon' => 'fa-solid fa-code-commit',
        'color' => 'orange',
        'text' => '<strong>Carlos R.</strong> subió 3 commits al branch <strong>main</strong>',
        'time' => 'Hace 12 minutos'
    ],
    [
        'icon' => 'fa-solid fa-comment',
        'color' => 'blue',
        'text' => '<strong>María L.</strong> comentó en "Rediseño Portal Corporativo"',
        'time' => 'Hace 34 minutos'
    ],
    [
        'icon' => 'fa-solid fa-check-circle',
        'color' => 'green',
        'text' => '<strong>Juan P.</strong> completó la tarea "API endpoints usuarios"',
        'time' => 'Hace 1 hora'
    ],
    [
        'icon' => 'fa-solid fa-user-plus',
        'color' => 'yellow',
        'text' => '<strong>Andrea N.</strong> se unió al proyecto "Dashboard Analítico"',
        'time' => 'Hace 2 horas'
    ],
    [
        'icon' => 'fa-solid fa-file-arrow-up',
        'color' => 'blue',
        'text' => '<strong>Roberto S.</strong> subió 8 archivos de diseño',
        'time' => 'Hace 3 horas'
    ]
];

// Equipo
 $team = [
    ['name' => 'Carlos Ramírez', 'role' => 'Lead Developer', 'initials' => 'CR', 'bg' => '#FF6B35', 'status' => 'online'],
    ['name' => 'María López', 'role' => 'Diseñadora UI/UX', 'initials' => 'ML', 'bg' => '#3B82F6', 'status' => 'online'],
    ['name' => 'Juan Pérez', 'role' => 'Backend Developer', 'initials' => 'JP', 'bg' => '#10B981', 'status' => 'away'],
    ['name' => 'Andrea Navarro', 'role' => 'Project Manager', 'initials' => 'AN', 'bg' => '#8B5CF6', 'status' => 'online'],
    ['name' => 'Roberto Sánchez', 'role' => 'Frontend Developer', 'initials' => 'RS', 'bg' => '#EF4444', 'status' => 'offline'],
];

// Tareas
 $tasks = [
    ['title' => 'Finalizar módulo de reportes', 'priority' => 'high', 'priorityText' => 'Alta', 'project' => 'Dashboard Analítico', 'done' => false],
    ['title' => 'Revisar pull request #247', 'priority' => 'medium', 'priorityText' => 'Media', 'project' => 'Portal Corporativo', 'done' => false],
    ['title' => 'Actualizar documentación API', 'priority' => 'low', 'priorityText' => 'Baja', 'project' => 'App Inventario', 'done' => true],
    ['title' => 'Diseñar flujo de onboarding', 'priority' => 'high', 'priorityText' => 'Alta', 'project' => 'E-Learning', 'done' => false],
    ['title' => 'Corregir bug en checkout', 'priority' => 'medium', 'priorityText' => 'Media', 'project' => 'API Pagos', 'done' => true],
];

 $userName = htmlspecialchars($_SESSION['user_name'] ?? 'Carlos Ramírez');
 $userRole = htmlspecialchars($_SESSION['user_role'] ?? 'Lead Developer');
 $userInitials = htmlspecialchars($_SESSION['user_initials'] ?? 'CR');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Vertex</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="/Login-Seminario/public/css/dashboard.css">
</head>
<body>

<div class="dashboard-layout">

    <!-- Overlay mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">V</div>
            <span class="logo-text">Vertex</span>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Principal</div>
            <a href="#" class="nav-item active">
                <i class="fa-solid fa-grid-2"></i>
                <span class="nav-label">Dashboard</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-folder-open"></i>
                <span class="nav-label">Proyectos</span>
                <span class="nav-badge">24</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-list-check"></i>
                <span class="nav-label">Tareas</span>
                <span class="nav-badge">8</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fa-regular fa-calendar"></i>
                <span class="nav-label">Calendario</span>
            </a>

            <div class="nav-section-label">Equipo</div>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-users"></i>
                <span class="nav-label">Miembros</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fa-regular fa-message"></i>
                <span class="nav-label">Mensajes</span>
                <span class="nav-badge">3</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-file-lines"></i>
                <span class="nav-label">Documentos</span>
            </a>

            <div class="nav-section-label">Sistema</div>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-chart-line"></i>
                <span class="nav-label">Analítica</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-gear"></i>
                <span class="nav-label">Configuración</span>
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="sidebar-user-avatar"><?php echo $userInitials; ?></div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name"><?php echo $userName; ?></div>
                <div class="sidebar-user-role"><?php echo $userRole; ?></div>
            </div>
        </div>
    </aside>

    <!-- ==================== CONTENIDO PRINCIPAL ==================== -->
    <div class="main-content">

        <!-- Topbar -->
        <header class="topbar">
            <button class="topbar-toggle" id="sidebarToggle" aria-label="Toggle menú">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="topbar-breadcrumb">
                Principal / <strong>Dashboard</strong>
            </div>

            <div class="topbar-spacer"></div>

            <div class="topbar-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar proyectos, tareas...">
            </div>

            <button class="topbar-icon-btn" aria-label="Notificaciones">
                <i class="fa-regular fa-bell"></i>
                <span class="badge-dot"></span>
            </button>

            <div class="topbar-user">
                <div class="topbar-user-avatar"><?php echo $userInitials; ?></div>
                <span class="topbar-user-name"><?php echo $userName; ?> <i class="fa-solid fa-chevron-down"></i></span>
            </div>
        </header>

        <!-- Contenido -->
        <div class="content-area">

            <!-- Encabezado de página -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Buenos días, <?php echo explode(' ', $userName)[0]; ?></h1>
                    <p class="page-subtitle">Aquí tienes un resumen de la actividad de tu equipo hoy.</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-ghost">
                        <i class="fa-solid fa-download"></i> Exportar
                    </button>
                    <button class="btn btn-accent">
                        <i class="fa-solid fa-plus"></i> Nuevo Proyecto
                    </button>
                </div>
            </div>

            <!-- KPIs -->
            <div class="kpi-grid">
                <?php foreach ($kpis as $i => $kpi): ?>
                <div class="kpi-card <?php echo $kpi['color']; ?>">
                    <div class="kpi-top">
                        <div class="kpi-icon <?php echo $kpi['color']; ?>">
                            <i class="<?php echo $kpi['icon']; ?>"></i>
                        </div>
                        <div class="kpi-change <?php echo $kpi['direction']; ?>">
                            <i class="fa-solid fa-arrow-<?php echo $kpi['direction']; ?>"></i>
                            <?php echo $kpi['change']; ?>
                        </div>
                    </div>
                    <div class="kpi-value"><?php echo $kpi['value']; ?></div>
                    <div class="kpi-label"><?php echo $kpi['label']; ?></div>
                    <div class="kpi-mini-chart">
                        <canvas id="miniChart<?php echo $i; ?>"></canvas>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Gráficos principales -->
            <div class="content-grid">
                <!-- Gráfico de línea: Ingresos vs Gastos -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ingresos vs Gastos</h3>
                        <a href="#" class="card-action">Ver detalle <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <div class="legend-dot" style="background: #FF6B35;"></div>
                                Ingresos
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot" style="background: #3B82F6;"></div>
                                Gastos
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Doughnut: Distribución -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Distribución de Proyectos</h3>
                        <a href="#" class="card-action">Ver todos <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="doughnut-wrapper">
                            <div class="doughnut-chart-container">
                                <canvas id="doughnutChart"></canvas>
                                <div class="doughnut-center-label">
                                    <div class="doughnut-center-value">100</div>
                                    <div class="doughnut-center-sub">Total</div>
                                </div>
                            </div>
                            <div class="doughnut-stats">
                                <?php foreach ($doughnutData as $cat): ?>
                                <div class="doughnut-stat">
                                    <div class="doughnut-stat-left">
                                        <div class="doughnut-stat-dot" style="background: <?php echo $cat['color']; ?>;"></div>
                                        <span class="doughnut-stat-name"><?php echo $cat['name']; ?></span>
                                    </div>
                                    <span class="doughnut-stat-value"><?php echo $cat['value']; ?>%</span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de proyectos -->
            <div class="card" style="margin-bottom: 28px;">
                <div class="card-header">
                    <h3 class="card-title">Proyectos Recientes</h3>
                    <a href="#" class="card-action">Ver todos <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="card-body" style="padding-top: 8px;">
                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Proyecto</th>
                                    <th>Estado</th>
                                    <th>Progreso</th>
                                    <th>Equipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($projects as $proj): ?>
                                <tr>
                                    <td>
                                        <div class="project-cell">
                                            <div class="project-avatar" style="background: <?php echo $proj['iconBg']; ?>15; color: <?php echo $proj['iconBg']; ?>;">
                                                <i class="<?php echo $proj['icon']; ?>"></i>
                                            </div>
                                            <div>
                                                <div class="project-name"><?php echo $proj['name']; ?></div>
                                                <div class="project-client"><?php echo $proj['client']; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge <?php echo $proj['status']; ?>">
                                            <span class="status-dot"></span>
                                            <?php echo $proj['statusText']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress-bar-wrapper">
                                            <div class="progress-bar">
                                                <div class="progress-bar-fill <?php echo $proj['progressColor']; ?>" data-width="<?php echo $proj['progress']; ?>"></div>
                                            </div>
                                            <span class="progress-text"><?php echo $proj['progress']; ?>%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-stack">
                                            <?php foreach ($proj['members'] as $m): ?>
                                            <div class="avatar-stack-item" style="background: <?php echo $m['bg']; ?>;" title="<?php echo $m['initials']; ?>">
                                                <?php echo $m['initials']; ?>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bottom grid: Actividad + Equipo + Tareas -->
            <div class="bottom-grid">

                <!-- Actividad reciente -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Actividad Reciente</h3>
                    </div>
                    <div class="card-body">
                        <div class="activity-list">
                            <?php foreach ($activities as $act): ?>
                            <div class="activity-item">
                                <div class="activity-icon <?php echo $act['color']; ?>">
                                    <i class="<?php echo $act['icon']; ?>"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-text"><?php echo $act['text']; ?></div>
                                    <div class="activity-time"><?php echo $act['time']; ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Equipo -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Equipo</h3>
                        <a href="#" class="card-action">Ver todos <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="team-list">
                            <?php foreach ($team as $member): ?>
                            <div class="team-member">
                                <div class="team-avatar" style="background: <?php echo $member['bg']; ?>;">
                                    <?php echo $member['initials']; ?>
                                </div>
                                <div class="team-info">
                                    <div class="team-name"><?php echo $member['name']; ?></div>
                                    <div class="team-role"><?php echo $member['role']; ?></div>
                                </div>
                                <div class="team-status <?php echo $member['status']; ?>" title="<?php echo ucfirst($member['status']); ?>"></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Tareas rápidas -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tareas Pendientes</h3>
                        <a href="#" class="card-action">Ver todas <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="task-list">
                            <?php foreach ($tasks as $ti => $task): ?>
                            <div class="task-item">
                                <div class="task-checkbox <?php echo $task['done'] ? 'checked' : ''; ?>" onclick="toggleTask(this)" role="checkbox" aria-checked="<?php echo $task['done'] ? 'true' : 'false'; ?>" tabindex="0">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <div class="task-content">
                                    <div class="task-title <?php echo $task['done'] ? 'done' : ''; ?>"><?php echo $task['title']; ?></div>
                                    <div class="task-meta">
                                        <span class="task-priority <?php echo $task['priority']; ?>"><?php echo $task['priorityText']; ?></span>
                                        <span><?php echo $task['project']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /content-area -->
    </div><!-- /main-content -->
</div><!-- /dashboard-layout -->

<script>
(function() {
    // ==================== SIDEBAR TOGGLE ====================
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle = document.getElementById('sidebarToggle');
    const isMobile = () => window.innerWidth <= 960;

    toggle.addEventListener('click', function() {
        if (isMobile()) {
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('show');
        } else {
            sidebar.classList.toggle('collapsed');
        }
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('show');
    });

    // ==================== MINI CHARTS (KPIs) ====================
    const miniData = <?php echo json_encode(array_column($kpis, 'miniData')); ?>;
    const miniColors = ['#FF6B35', '#3B82F6', '#10B981', '#F59E0B'];

    miniData.forEach(function(data, i) {
        const ctx = document.getElementById('miniChart' + i);
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(function(_, j) { return j; }),
                datasets: [{
                    data: data,
                    borderColor: miniColors[i],
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: miniColors[i] + '12',
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                scales: {
                    x: { display: false },
                    y: { display: false }
                },
                elements: { line: { borderCapStyle: 'round' } },
                interaction: { intersect: false, mode: 'index' }
            }
        });
    });

    // ==================== GRÁFICO DE INGRESOS ====================
    const months = <?php echo json_encode($chartMonths); ?>;
    const ingresos = <?php echo json_encode($chartIngresos); ?>;
    const gastos = <?php echo json_encode($chartGastos); ?>;

    const revenueCtx = document.getElementById('revenueChart');
    if (revenueCtx) {
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Ingresos',
                        data: ingresos,
                        borderColor: '#FF6B35',
                        borderWidth: 2.5,
                        fill: true,
                        backgroundColor: function(ctx) {
                            const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 260);
                            g.addColorStop(0, 'rgba(255, 107, 53, 0.15)');
                            g.addColorStop(1, 'rgba(255, 107, 53, 0)');
                            return g;
                        },
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#FF6B35',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 3,
                    },
                    {
                        label: 'Gastos',
                        data: gastos,
                        borderColor: '#3B82F6',
                        borderWidth: 2.5,
                        fill: true,
                        backgroundColor: function(ctx) {
                            const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 260);
                            g.addColorStop(0, 'rgba(59, 130, 246, 0.08)');
                            g.addColorStop(1, 'rgba(59, 130, 246, 0)');
                            return g;
                        },
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#3B82F6',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 3,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1A1E2E',
                        titleFont: { family: 'Plus Jakarta Sans', size: 12, weight: '600' },
                        bodyFont: { family: 'Sora', size: 13, weight: '700' },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: true,
                        boxPadding: 4,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.dataset.label + ': $' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 11.5 },
                            color: '#9CA3B4'
                        },
                        border: { display: false }
                    },
                    y: {
                        grid: { color: '#F0F2F5', drawTicks: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 11.5 },
                            color: '#9CA3B4',
                            padding: 8,
                            callback: function(val) {
                                return '$' + (val / 1000) + 'k';
                            }
                        },
                        border: { display: false },
                        beginAtZero: true
                    }
                },
                interaction: { intersect: false, mode: 'index' }
            }
        });
    }

    // ==================== GRÁFICO DOUGHNUT ====================
    const doughnutItems = <?php echo json_encode($doughnutData); ?>;
    const doughnutCtx = document.getElementById('doughnutChart');
    if (doughnutCtx) {
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: doughnutItems.map(function(d) { return d.name; }),
                datasets: [{
                    data: doughnutItems.map(function(d) { return d.value; }),
                    backgroundColor: doughnutItems.map(function(d) { return d.color; }),
                    borderWidth: 0,
                    hoverOffset: 6,
                    spacing: 3,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1A1E2E',
                        titleFont: { family: 'Plus Jakarta Sans', size: 12, weight: '600' },
                        bodyFont: { family: 'Sora', size: 13, weight: '700' },
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                }
            }
        });
    }

    // ==================== ANIMAR BARRAS DE PROGRESO ====================
    setTimeout(function() {
        document.querySelectorAll('.progress-bar-fill').forEach(function(bar) {
            bar.style.width = bar.getAttribute('data-width') + '%';
        });
    }, 400);

})();

// ==================== TOGGLE TAREAS ====================
function toggleTask(checkbox) {
    checkbox.classList.toggle('checked');
    const title = checkbox.closest('.task-item').querySelector('.task-title');
    title.classList.toggle('done');
    checkbox.setAttribute('aria-checked', checkbox.classList.contains('checked'));
}
</script>

</body>
</html>