<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Carita Feliz - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../assets/css/main.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/logo.ico" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b border-blue-200 fixed w-full top-0 z-30">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo y título -->
                <div class="flex items-center space-x-4">
                    <button id="sidebar-toggle" class="lg:hidden text-gray-600 hover:text-gray-800">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex items-center space-x-3">
                        <img src="../assets/images/logo.png" alt="Logo" class="h-8">
                        <div>
                            <h1 class="text-xl font-bold text-gray-800">Clínica Carita Feliz</h1>
                            <p class="text-xs text-gray-600">Dashboard de Gestión TI</p>
                        </div>
                    </div>
                </div>
                
                <!-- Usuario y controles -->
                <div class="flex items-center space-x-4">
                    <div id="user-info" class="flex items-center space-x-2 bg-blue-100 text-blue-800 px-3 py-2 rounded-lg">
                        <i class="fas fa-user-circle"></i>
                        <span id="user-name" class="font-medium text-sm">Usuario</span>
                        <span id="user-role" class="text-xs bg-blue-200 px-2 py-1 rounded-full">ROL</span>
                    </div>
                    <button id="chat-toggle" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-robot mr-2"></i>
                        <span class="hidden sm:inline">Asistente</span>
                    </button>
                    <button id="index-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-home mr-2"></i>
                        <span class="hidden sm:inline">Inicio</span>
                    </button>
                    <button id="logout-btn" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-16 w-64 h-full bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-20">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Menú de Gestión</h2>
            <nav class="space-y-2">
                <!-- Dashboard - siempre visible -->
                <a href="#" id="dashboard-tab" class="nav-link active" data-tab="dashboard">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                
                <!-- Responder Incidencias - admin y técnico -->
                <a href="#" id="respuesta-tab" class="nav-link" data-tab="respuesta">
                    <i class="fas fa-reply mr-3"></i>
                    Responder Incidencias
                </a>
                
                <!-- NUEVO: Reportes Avanzados - admin y técnico -->
                    <a href="#" id="reportes-tab" class="nav-link" data-tab="reportes">
                        <i class="fas fa-chart-line mr-3"></i>
                        Reportes Avanzados
                    </a>



                <!-- Secciones solo para admin -->
                <div id="admin-section" class="hidden">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-3">Administración</h3>
                    
                    <a href="#" class="nav-link" data-tab="incidencias">
                        <i class="fas fa-exclamation-triangle mr-3"></i>
                        Gestión Incidencias
                    </a>

                    
                    
                    <a href="#" class="nav-link" data-tab="usuario">
                        <i class="fas fa-users mr-3"></i>
                        Usuarios
                    </a>
                    
                    <a href="#" class="nav-link" data-tab="sedes">
                        <i class="fas fa-building mr-3"></i>
                        Sedes
                    </a>
                    
                    <a href="#" class="nav-link" data-tab="areas">
                        <i class="fas fa-map-marker-alt mr-3"></i>
                        Áreas
                    </a>
                    
                    <a href="#" class="nav-link" data-tab="tipo_incidencia">
                        <i class="fas fa-tags mr-3"></i>
                        Tipos de Incidencia
                    </a>

                    <a href="#" class="nav-link" data-tab="subtipo_incidencia">
                        <i class="fas fa-tags mr-3"></i>
                        SubTipos de Incidencia
                    </a>
                    
                    <a href="#" class="nav-link" data-tab="rol_usuario">
                        <i class="fas fa-user-tag mr-3"></i>
                        Roles de Usuario
                    </a>
                </div>
                
                <!-- Reportes -->
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-3">Reportes</h3>
                <button id="generate-report" class="nav-link w-full text-left">
                    <i class="fas fa-file-pdf mr-3"></i>
                    Generar Reporte PDF
                </button>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-16 min-h-screen">
        <div class="p-6">
            <!-- Dashboard Tab -->
            <div id="dashboard-content" class="tab-content">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Principal</h2>
                    <p class="text-gray-600">Resumen general del estado de incidencias técnicas</p>
                </div>

                <!-- Estadísticas Cards -->
                <div id="stats-cards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Las cards se llenarán dinámicamente -->
                </div>

                <!-- Gráficos -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Gráfico de Estados -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Incidencias por Estado</h3>
                        <canvas id="statusChart" width="400" height="300"></canvas>
                    </div>
                    
                    <!-- Gráfico de Prioridades -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Incidencias por Prioridad</h3>
                        <canvas id="priorityChart" width="400" height="300"></canvas>
                    </div>
                </div>

                <!-- Botón para abrir modal de más gráficos 
                <div class="flex justify-end mb-4">
                        <button id="open-charts-modal" 
                            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-chart-pie mr-2"></i> Ver más gráficos
                        </button>
                    </div>-->

                <!-- Incidencias Recientes -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Incidencias Recientes</h3>
                    <div id="recent-incidents" class="space-y-4">
                        <!-- Se llenarán dinámicamente -->
                    </div>
                </div>

                
            </div>

           

            

            <!-- Contenido dinámico para otras pestañas -->
            <div id="dynamic-content" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-center h-64">
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500">Cargando contenido...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Chat Assistant -->
    <div id="chat-container" class="fixed bottom-4 right-4 w-80 bg-white rounded-lg shadow-2xl hidden z-40">
        <div class="bg-blue-600 text-white p-4 rounded-t-lg flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i class="fas fa-robot"></i>
                <span class="font-medium">Asistente Técnico</span>
            </div>
            <button id="chat-close" class="text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div id="chat-messages" class="h-80 overflow-y-auto p-4 space-y-3">
            <div class="flex items-start space-x-2">
                <div class="bg-blue-100 text-blue-800 p-2 rounded-full">
                    <i class="fas fa-robot text-sm"></i>
                </div>
                <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                    <p class="text-sm">¡Hola! Soy tu asistente técnico. Puedo ayudarte con problemas de hardware, software, conectividad y mantenimiento. ¿En qué puedo ayudarte?</p>
                </div>
            </div>
        </div>
        
        <div class="p-4 border-t">
            <div class="flex space-x-2">
                <input 
                    type="text" 
                    id="chat-input" 
                    placeholder="Escribe tu pregunta..." 
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                <button id="chat-send" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>









    
















    <!-- Overlay para cerrar sidebar en mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden lg:hidden"></div>

    <!-- Access Denied Message -->
    <div id="access-denied" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md mx-4 text-center">
            <i class="fas fa-lock text-red-500 text-4xl mb-4"></i>
            <h2 class="text-xl font-bold text-gray-800 mb-2">Acceso Denegado</h2>
            <p class="text-gray-600 mb-4">Solo administradores y técnicos pueden acceder al dashboard.</p>
            <button onclick="window.location.href='login.php'" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Iniciar Sesión
            </button>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50"></div>



                      


    <style>
        .nav-link {
            @apply flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition duration-200 cursor-pointer;
        }
        .nav-link.active {
            @apply bg-blue-100 text-blue-600 font-medium;
        }
        .tab-content {
            @apply block;
        }
        .tab-content.hidden {
            @apply hidden;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        // URLs de las APIs
        const INCIDENCIAS_API = '../api/controllers/incidencias.php';
        const CHAT_API = '../api/controllers/chat.php';

        // Variables globales
        let currentUser = null;
        let incidenciasData = [];
        let chatMessagesData = [];
        let isAdmin = false;

        // Elementos del DOM
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const userInfo = document.getElementById('user-info');
        const userName = document.getElementById('user-name');
        const userRole = document.getElementById('user-role');
        const accessDenied = document.getElementById('access-denied');
        
        // Chat elements
        const chatToggle = document.getElementById('chat-toggle');
        const chatContainer = document.getElementById('chat-container');
        const chatClose = document.getElementById('chat-close');
        const chatMessages = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input');
        const chatSend = document.getElementById('chat-send');
        
        // Tabs
        const dashboardTab = document.getElementById('dashboard-tab');
        const respuestaTab = document.getElementById('respuesta-tab');
        const adminSection = document.getElementById('admin-section');
        
        // Content areas
        const dashboardContent = document.getElementById('dashboard-content');
        const dynamicContent = document.getElementById('dynamic-content');

        // Función para mostrar toast
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
            
            toast.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg mb-4 transform transition-all duration-300 translate-x-full`;
            toast.textContent = message;
            
            document.getElementById('toast-container').appendChild(toast);
            
            setTimeout(() => toast.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Verificar autenticación y permisos - CORREGIDO
        function checkAuthentication() {
            const userSession = localStorage.getItem('user_session') || sessionStorage.getItem('user_session');
            
            if (!userSession) {
                console.log('No hay sesión de usuario');
                accessDenied.classList.remove('hidden');
                return false;
            }

            try {
                const session = JSON.parse(userSession);
                console.log('Sesión encontrada:', session); // Debug
                
                // Verificar que tenga los campos mínimos necesarios - CORREGIDO
                if (!session.username) {
                    console.log('Sesión inválida: sin username');
                    accessDenied.classList.remove('hidden');
                    return false;
                }
                
                // Verificar tiempo de sesión
                if (session.loginTime) {
                    const currentTime = new Date().getTime();
                    const loginTime = session.loginTime;
                    const timeDiff = currentTime - loginTime;
                    
                    // Verificar que la sesión sea válida (menos de 24 horas)
                    if (timeDiff >= 24 * 60 * 60 * 1000) {
                        console.log('Sesión expirada');
                        clearUserSession();
                        accessDenied.classList.remove('hidden');
                        return false;
                    }
                }
                
                // Verificar que sea técnico o admin
                if (session.rol !== 'admin' && session.rol !== 'tecnico') {
                    console.log('Usuario sin permisos para dashboard:', session.rol);
                    // Redirigir a index para usuarios normales
                    showToast('Los usuarios normales no pueden acceder al dashboard', 'error');
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 2000);
                    return false;
                }
                
                currentUser = session;
                isAdmin = session.rol === 'admin';
                console.log('Usuario autenticado:', currentUser); // Debug
                updateUI();
                return true;
            } catch (e) {
                console.error('Error parseando sesión:', e);
                clearUserSession();
                accessDenied.classList.remove('hidden');
                return false;
            }
        }

        // Actualizar UI según permisos - CORREGIDO
        function updateUI() {
            if (!currentUser) {
                console.log('No hay currentUser para actualizar UI');
                return;
            }
            
            console.log('Actualizando UI con usuario:', currentUser); // Debug
            
            // Obtener el nombre del usuario - CORREGIDO
            let displayName = 'Usuario Desconocido';
            if (currentUser.nombre_completo) {
                displayName = currentUser.nombre_completo;
            } else if (currentUser.nombre) {
                displayName = currentUser.nombre;
            } else if (currentUser.username) {
                displayName = currentUser.username;
            }
            
            userName.textContent = displayName;
            userRole.textContent = currentUser.rol.toUpperCase();
            
            // Cambiar color del rol
            const roleColors = {
                'admin': 'bg-red-100 text-red-800',
                'tecnico': 'bg-blue-100 text-blue-800'
            };
            
            // Limpiar clases anteriores y aplicar nuevas
            userRole.className = `text-xs px-2 py-1 rounded-full ${roleColors[currentUser.rol] || 'bg-gray-100 text-gray-800'}`;
            
            // Mostrar/ocultar sección de admin
            if (isAdmin) {
                adminSection.classList.remove('hidden');
                console.log('Mostrando sección de admin');
            } else {
                adminSection.classList.add('hidden');
                console.log('Ocultando sección de admin - usuario técnico');
            }
            
            // Ocultar mensaje de acceso denegado si está visible
            accessDenied.classList.add('hidden');
        }

        // Limpiar sesión de usuario
        function clearUserSession() {
            localStorage.removeItem('user_session');
            sessionStorage.removeItem('user_session');
            localStorage.removeItem('remember_user');
            currentUser = null;
            isAdmin = false;
        }

        // Cargar estadísticas del dashboard
        async function loadDashboardStats() {
            try {
                const response = await fetch(`${INCIDENCIAS_API}?action=stats`);
                const result = await response.json();
                
                if (result.stats) {
                    renderStatsCards(result.stats);
                    renderCharts(result.stats);
                }
            } catch (error) {
                console.error('Error cargando estadísticas:', error);
                showToast('Error cargando estadísticas', 'error');
            }
        }

        // Renderizar cards de estadísticas
        function renderStatsCards(stats) {
            let total = 0, abiertas = 0, proceso = 0, cerradas = 0;
            
            if (stats.por_estado) {
                stats.por_estado.forEach(estado => {
                    total += parseInt(estado.count);
                    switch(estado.estado) {
                        case 'abierta': abiertas = estado.count; break;
                        case 'en_proceso': proceso = estado.count; break;
                        case 'cerrada': cerradas = estado.count; break;
                    }
                });
            }

            document.getElementById('stats-cards').innerHTML = `
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-exclamation-triangle text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Incidencias</p>
                            <p class="text-2xl font-bold text-gray-800">${total}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 mr-4">
                            <i class="fas fa-folder-open text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Abiertas</p>
                            <p class="text-2xl font-bold text-red-600">${abiertas}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 mr-4">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">En Proceso</p>
                            <p class="text-2xl font-bold text-yellow-600">${proceso}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Cerradas</p>
                            <p class="text-2xl font-bold text-green-600">${cerradas}</p>
                        </div>
                    </div>
                </div>
            `;
        }

        // Renderizar gráficos
            // Renderizar gráficos
        
                // Variables globales para guardar las instancias de Chart.js
                let priorityChartInstance = null;
                let trendsChartInstance = null;
                let statusChartInstance = null;

                // Renderizar gráficos
                function renderCharts(stats) {
                    if (!stats.por_estado) return;

                    // ======================
                    // Gráfico de estados
                    // ======================
                    const statusCtx = document.getElementById('statusChart').getContext('2d');
                    const statusData = {
                        labels: [],
                        datasets: [{
                            data: [],
                            backgroundColor: ['#ef4444', '#f59e0b', '#10b981', '#6b7280']
                        }]
                    };

                    stats.por_estado.forEach(estado => {
                        statusData.labels.push(estado.estado.replace('_', ' ').toUpperCase());
                        statusData.datasets[0].data.push(estado.count);
                    });

                    // 🔹 Si ya existe un gráfico, destruirlo antes de crear otro
                    if (statusChartInstance) {
                        statusChartInstance.destroy();
                    }

                    statusChartInstance = new Chart(statusCtx, {
                        type: 'doughnut',
                        data: statusData,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });

                    // ======================
                    // Gráfico de prioridades
                    // ======================
                    if (stats.por_prioridad) {
                        const priorityCtx = document.getElementById('priorityChart').getContext('2d');
                        const priorityData = {
                            labels: [],
                            datasets: [{
                                data: [],
                                backgroundColor: ['#10b981', '#f59e0b', '#f97316', '#ef4444']
                            }]
                        };

                        stats.por_prioridad.forEach(prioridad => {
                            priorityData.labels.push(prioridad.prioridad.toUpperCase());
                            priorityData.datasets[0].data.push(prioridad.count);
                        });

                        // 🔹 Destruir gráfico previo antes de crear otro
                        if (priorityChartInstance) {
                            priorityChartInstance.destroy();
                        }

                        priorityChartInstance = new Chart(priorityCtx, {
                            type: 'bar',
                            data: priorityData,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    }
                }
















        // Cargar incidencias recientes
        async function loadRecentIncidents() {
            try {
                const response = await fetch(`${INCIDENCIAS_API}?limit=5`);
                const result = await response.json();
                
                if (result.records) {
                    renderRecentIncidents(result.records);
                }
            } catch (error) {
                console.error('Error cargando incidencias recientes:', error);
            }
        }

        // Renderizar incidencias recientes
        function renderRecentIncidents(incidents) {
            const container = document.getElementById('recent-incidents');
            
            if (!incidents || incidents.length === 0) {
                container.innerHTML = '<p class="text-gray-500 text-center py-4">No hay incidencias recientes</p>';
                return;
            }
            
            container.innerHTML = incidents.map(incident => `
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-800">#${incident.id_incidencia} - ${incident.titulo}</h4>
                        <p class="text-sm text-gray-600 line-clamp-2">${incident.descripcion}</p>
                        <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                            <span>Reportado: ${formatDate(incident.fecha_reporte)}</span>
                            <span class="px-2 py-1 rounded-full ${getEstadoClass(incident.estado)}">${incident.estado.replace('_', ' ').toUpperCase()}</span>
                            <span class="px-2 py-1 rounded-full ${getPrioridadClass(incident.prioridad)}">${incident.prioridad.toUpperCase()}</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <button onclick="viewIncident(${incident.id_incidencia})" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                            Ver
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Funciones auxiliares
        function getEstadoClass(estado) {
            const classes = {
                'abierta': 'bg-red-100 text-red-800',
                'en_proceso': 'bg-yellow-100 text-yellow-800',
                'cerrada': 'bg-green-100 text-green-800',
                'cancelada': 'bg-gray-100 text-gray-800'
            };
            return classes[estado] || 'bg-gray-100 text-gray-800';
        }

        function getPrioridadClass(prioridad) {
            const classes = {
                'baja': 'bg-green-100 text-green-800',
                'media': 'bg-yellow-100 text-yellow-800',
                'alta': 'bg-orange-100 text-orange-800',
                'critica': 'bg-red-100 text-red-800'
            };
            return classes[prioridad] || 'bg-gray-100 text-gray-800';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('es-ES', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Navegación entre tabs
                function switchTab(tabName) {
            // Remover clase active de todos los nav-links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            // Ocultar todos los contenidos
            dashboardContent.classList.add('hidden');
            dynamicContent.classList.add('hidden');
            
            if (tabName === 'dashboard') {
                dashboardContent.classList.remove('hidden');
                dashboardTab.classList.add('active');
                loadDashboardStats();
                loadRecentIncidents();
            } else if (tabName === 'respuesta') {
                loadExternalContent('respuesta.php');
                respuestaTab.classList.add('active');
            } else if (tabName === 'reportes') {  // NUEVO
                loadExternalContent('graficos_reporte.php');
                document.getElementById('reportes-tab').classList.add('active');
            } else {
                // Para otros CRUDs (solo admin)
                if (isAdmin) {
                    loadExternalContent(`${tabName}.php`);
                    document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
                } else {
                    showToast('Sin permisos para acceder a esta sección', 'error');
                }
            }
        }

        // Cargar contenido externo en iframe
        function loadExternalContent(fileName) {
            dynamicContent.classList.remove('hidden');
            dynamicContent.innerHTML = `
                <div class="bg-white rounded-lg shadow-md h-full">
                    <iframe src="${fileName}" class="w-full h-screen border-0 rounded-lg"></iframe>
                </div>
            `;
        }

        // Ver detalles de incidencia
        function viewIncident(id) {
            switchTab('respuesta');
            // Aquí podrías agregar lógica para mostrar la incidencia específica
        }

        // Generar reporte PDF
        // Reemplaza la función generateReport() en dashboard.php:

                            // Generar reporte PDF
                                // Generar reporte PDF
            async function generateReport() {
                if (!currentUser) {
                    showToast('Error: No hay usuario autenticado', 'error');
                    return;
                }

                try {
                    // Mostrar loading en el botón
                    const reportBtn = document.getElementById('generate-report');
                    const originalText = reportBtn.innerHTML;
                    reportBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generando...';
                    reportBtn.disabled = true;

                    // Petición al servidor
                    const response = await fetch('../generate_report.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            type: 'general',
                            user_id: currentUser.username // usar identificador del usuario
                        })
                    });

                    // Restaurar botón
                    reportBtn.innerHTML = originalText;
                    reportBtn.disabled = false;

                    if (!response.ok) {
                        showToast('Error generando reporte', 'error');
                        return;
                    }

                    // Descargar PDF si la respuesta es correcta
                    const blob = await response.blob();
                    const url = window.URL.createObjectURL(blob);

                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'reporte_incidencias.pdf';
                    document.body.appendChild(a);
                    a.click();

                    // Liberar memoria
                    a.remove();
                    window.URL.revokeObjectURL(url);

                    showToast('Reporte generado correctamente', 'success');
                } catch (error) {
                    console.error('Error en generateReport:', error);
                    showToast('Error al generar reporte', 'error');
                }
            }








        // Chat functionality
        let isTyping = false;

        function toggleChat() {
            chatContainer.classList.toggle('hidden');
            if (!chatContainer.classList.contains('hidden')) {
                chatInput.focus();
            }
        }

        function closeChat() {
            chatContainer.classList.add('hidden');
        }

        function addChatMessage(message, isUser = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex items-start space-x-2 ${isUser ? 'justify-end' : ''}`;
            
            const avatarClass = isUser ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600';
            const messageClass = isUser ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-800';
            
            messageDiv.innerHTML = `
                ${!isUser ? `<div class="${avatarClass} p-2 rounded-full flex-shrink-0">
                    <i class="fas fa-robot text-sm"></i>
                </div>` : ''}
                <div class="${messageClass} rounded-lg p-3 max-w-xs">
                    <p class="text-sm whitespace-pre-wrap">${message}</p>
                </div>
                ${isUser ? `<div class="${avatarClass} p-2 rounded-full flex-shrink-0">
                    <i class="fas fa-user text-sm"></i>
                </div>` : ''}
            `;
            
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function showTypingIndicator() {
            if (isTyping) return;
            isTyping = true;
            
            const typingDiv = document.createElement('div');
            typingDiv.id = 'typing-indicator';
            typingDiv.className = 'flex items-start space-x-2';
            typingDiv.innerHTML = `
                <div class="bg-gray-100 text-gray-600 p-2 rounded-full">
                    <i class="fas fa-robot text-sm"></i>
                </div>
                <div class="bg-gray-100 rounded-lg p-3">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
            `;
            
            chatMessages.appendChild(typingDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function hideTypingIndicator() {
            const typingIndicator = document.getElementById('typing-indicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
            isTyping = false;
        }



        // Enviar mensaje al chat
                                    async function sendChatMessage() {
                                const message = chatInput.value.trim();
                                if (!message) return;
                                
                                addChatMessage(message, true);
                                chatInput.value = '';
                                showTypingIndicator();
                                
                                try {
                                    // Obtener sesión del usuario
                                    const userSession = localStorage.getItem('user_session') || sessionStorage.getItem('user_session');
                                    
                                    if (!userSession) {
                                        hideTypingIndicator();
                                        addChatMessage('Error: No hay sesión activa. Por favor inicia sesión nuevamente.', false);
                                        return;
                                    }
                                    
                                    console.log('UserSession:', JSON.parse(userSession)); // Debug
                                    const token = btoa(userSession);
                                    console.log('Token (primeros 50 chars):', token.substring(0, 50)); // Debug
                                    
                                    const response = await fetch(CHAT_API, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Authorization': `Bearer ${token}`
                                        },
                                        body: JSON.stringify({ message })
                                    });
                                    
                                    console.log('Response status:', response.status); // Debug
                                    console.log('Response headers:', response.headers); // Debug
                                    
                                    // Intentar leer el texto de la respuesta primero
                                    const responseText = await response.text();
                                    console.log('Response text:', responseText); // Debug
                                    
                                    hideTypingIndicator();
                                    
                                    // Intentar parsear como JSON
                                    let result;
                                    try {
                                        result = JSON.parse(responseText);
                                    } catch (jsonError) {
                                        console.error('Error parseando JSON:', jsonError);
                                        console.error('Respuesta recibida:', responseText);
                                        addChatMessage('Error del servidor. Revisa la consola para más detalles.', false);
                                        return;
                                    }
                                    
                                    if (result.success) {
                                        addChatMessage(result.reply, false);
                                    } else {
                                        addChatMessage(result.message || 'Lo siento, no pude procesar tu mensaje.', false);
                                    }
                                } catch (error) {
                                    hideTypingIndicator();
                                    console.error('Error en chat:', error);
                                    addChatMessage('Error de conexión. Por favor, intenta más tarde.', false);
                                }
                            }











        // Event Listeners
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        

        // Navigation
        dashboardTab.addEventListener('click', () => switchTab('dashboard'));
        respuestaTab.addEventListener('click', () => switchTab('respuesta'));
      //  reportesTab.addEventListener('click', () => switchTab('reportes')); // NUEVO

        
        // Admin navigation
        document.querySelectorAll('[data-tab]').forEach(tab => {
            tab.addEventListener('click', (e) => {
                const tabName = e.currentTarget.getAttribute('data-tab');
                switchTab(tabName);
            });
        });

        // Chat events
        chatToggle.addEventListener('click', toggleChat);
        chatClose.addEventListener('click', closeChat);
        chatSend.addEventListener('click', sendChatMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendChatMessage();
            }
        });

        // Report generation
        document.getElementById('generate-report').addEventListener('click', generateReport);
             


          

        // Navigation buttons
        document.getElementById('index-btn').addEventListener('click', () => {
            window.location.href = 'index.php';
        });

        document.getElementById('logout-btn').addEventListener('click', () => {
            if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                localStorage.removeItem('user_session');
                sessionStorage.removeItem('user_session');
                localStorage.removeItem('remember_user');
                showToast('Sesión cerrada correctamente', 'success');
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 1000);
            }
        });

        // Make functions global for onclick handlers
        window.viewIncident = viewIncident;
        window.switchTab = switchTab;

        // Inicialización con debug mejorado
        document.addEventListener('DOMContentLoaded', () => {
            console.log('=== DASHBOARD DEBUG DETALLADO ===');
            
            // Verificar qué hay en localStorage y sessionStorage
            const localStorage_session = localStorage.getItem('user_session');
            const sessionStorage_session = sessionStorage.getItem('user_session');
            
            console.log('localStorage raw:', localStorage_session);
            console.log('sessionStorage raw:', sessionStorage_session);
            
            // Intentar parsear cada uno
            if (localStorage_session) {
                try {
                    const parsed = JSON.parse(localStorage_session);
                    console.log('localStorage parsed:', parsed);
                    console.log('localStorage - nombre_completo:', parsed.nombre_completo);
                    console.log('localStorage - nombre:', parsed.nombre);
                    console.log('localStorage - username:', parsed.username);
                    console.log('localStorage - rol:', parsed.rol);
                } catch (e) {
                    console.error('Error parseando localStorage:', e);
                }
            }
            
            if (sessionStorage_session) {
                try {
                    const parsed = JSON.parse(sessionStorage_session);
                    console.log('sessionStorage parsed:', parsed);
                    console.log('sessionStorage - nombre_completo:', parsed.nombre_completo);
                    console.log('sessionStorage - nombre:', parsed.nombre);
                    console.log('sessionStorage - username:', parsed.username);
                    console.log('sessionStorage - rol:', parsed.rol);
                } catch (e) {
                    console.error('Error parseando sessionStorage:', e);
                }
            }
            
            console.log('================================');
            
            if (checkAuthentication()) {
                console.log('Autenticación exitosa, cargando dashboard...');
                switchTab('dashboard');
            } else {
                console.log('Autenticación falló');
            }
        });




      
     


    </script>
</body>
</html>