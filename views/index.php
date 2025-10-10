<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Carita Feliz - Sistema de Gestión TI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../assets/css/main.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/logo.ico" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b border-blue-200">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <!-- Logo y título -->
                <div class="flex items-center space-x-4">
                    <div>
                        <img src="../assets/images/logo.png" alt="Logo de la Clínica" class="h-8">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Clínica Carita Feliz</h1>
                        <p class="text- sm text-gray-600">Sistema de Gestión de Tecnología</p>
                    </div>
                </div>
                
                <!-- Área de autenticación -->
                <div id="auth-section" class="flex items-center space-x-3">
                    <!-- Mostrar cuando NO hay usuario logueado -->
                    <div id="guest-buttons" class="flex space-x-3">
                        <button id="login-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Iniciar Sesión</span>
                        </button>
                    </div>
                    
                    <!-- Mostrar cuando hay usuario logueado -->
                    <div id="user-section" class="hidden flex items-center space-x-3">
                        <div class="flex items-center space-x-2 bg-green-100 text-green-800 px-3 py-2 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span id="user-name" class="font-medium">Usuario</span>
                            <span id="user-role" class="text-xs bg-green-200 px-2 py-1 rounded-full">Rol</span>
                        </div>
                        <button id="dashboard-btn" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Dashboard</span>
                        </button>

                        <button id="chat-toggle" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200">
                                    <i class="fas fa-robot mr-2"></i>
                                    <span class="hidden sm:inline">Asistente</span>
                                </button>


                        <button id="logout-btn" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-3 rounded-lg transition duration-200" title="Cerrar Sesión">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                        </button>

                                   
                    </div>
                </div>
            </div>
        </div>
    </header>




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






    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Reporta una Incidencia Técnica</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                ¿Tienes un problema técnico? Reporta tu incidencia y nuestro equipo de soporte te ayudará a resolverlo de manera rápida y eficiente.
            </p>
        </div>

        <!-- Sección de estadísticas rápidas -->
        <div id="stats-section" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Las estadísticas se cargarán aquí -->
        </div>

        <!-- Toggle para mostrar/ocultar formulario -->
        <div class="text-center mb-8">
            <button id="toggle-form-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                <span id="toggle-text">📝 Reportar Nueva Incidencia</span>
            </button>
        </div>

        <!-- Formulario de reporte (inicialmente oculto) -->
        <div id="report-form-container" class="hidden">
            <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulario de Reporte de Incidencia</h3>
                
                <!-- Mensajes -->
                <div id="message-container" class="hidden mb-6"></div>
                
                <form id="incident-form" class="space-y-6">
                    <!-- Título -->
                    <div>
                        <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">
                            Título del Problema <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="titulo" 
                            name="titulo" 
                            required
                            maxlength="100"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Ej: No puedo acceder al sistema de facturación">
                        <small class="text-gray-500">Máximo 100 caracteres</small>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                            Descripción Detallada <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="descripcion" 
                            name="descripcion" 
                            required
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Describe detalladamente el problema que estás experimentando..."></textarea>
                    </div>

                    <!-- Información del reportante -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nombre_reporta" class="block text-sm font-medium text-gray-700 mb-2">
                                Tu Nombre Completo <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="nombre_reporta" 
                                name="nombre_reporta" 
                                required
                                maxlength="100"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                placeholder="Nombre completo">
                        </div>
                        
                        <div>
                            <label for="email_reporta" class="block text-sm font-medium text-gray-700 mb-2">
                                Tu Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email_reporta" 
                                name="email_reporta" 
                                required
                                maxlength="100"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                placeholder="tu.email@clinica.com">
                        </div>
                    </div>

                    <!-- Tipo de incidencia y prioridad -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tipo_incidencia" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipo de Problema
                            </label>
                            <select 
                                id="tipo_incidencia" 
                                name="tipo_incidencia"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <option value="">Selecciona el tipo...</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="prioridad" class="block text-sm font-medium text-gray-700 mb-2">
                                Prioridad
                            </label>
                            <select 
                                id="prioridad" 
                                name="prioridad"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <option value="baja">🟢 Baja - No es urgente</option>
                                <option value="media" selected>🟡 Media - Moderadamente urgente</option>
                                <option value="alta">🟠 Alta - Urgente</option>
                                <option value="critica">🔴 Crítica - Muy urgente</option>
                            </select>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button 
                            type="button" 
                            id="cancel-btn"
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                            Cancelar
                        </button>
                        <button 
                            type="submit" 
                            id="submit-btn"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                            <span id="submit-text">Enviar Reporte</span>
                            <div id="submit-loading" class="hidden inline-block ml-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="mt-16 max-w-4xl mx-auto">
            <h3 class="text-2xl font-bold text-gray-800 text-center mb-8">¿Qué tipos de problemas podemos ayudarte a resolver?</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Tarjeta Hardware -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Hardware</h4>
                    <p class="text-sm text-gray-600">Computadoras, impresoras, equipos médicos</p>
                </div>

                <!-- Tarjeta Software -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Software</h4>
                    <p class="text-sm text-gray-600">Sistemas, aplicaciones, actualizaciones</p>
                </div>

                <!-- Tarjeta Red -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Conectividad</h4>
                    <p class="text-sm text-gray-600">Internet, red interna, WiFi</p>
                </div>

                <!-- Tarjeta Mantenimiento -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Mantenimiento</h4>
                    <p class="text-sm text-gray-600">Preventivo, correctivo, optimización</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="container mx-auto px-4 text-center">
            <p class="mb-2">&copy; 2025 Clínica Carita Feliz. Todos los derechos reservados.</p>
            <p class="text-gray-400">Sistema de Gestión de Tecnología - Departamento de TI</p>
        </div>
    </footer>

    <!-- Toast para notificaciones -->
    <div id="toast-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        // URLs de la API
        const INCIDENCIAS_API = '../api/controllers/incidencias.php';
        const TIPOS_API = '../api/controllers/tipos_incidencias.php';

        // Variables globales
        let currentUser = null;
        
        // Elementos del DOM
        const toggleFormBtn = document.getElementById('toggle-form-btn');
        const toggleText = document.getElementById('toggle-text');
        const reportFormContainer = document.getElementById('report-form-container');
        const incidentForm = document.getElementById('incident-form');
        const messageContainer = document.getElementById('message-container');
        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const submitLoading = document.getElementById('submit-loading');
        const cancelBtn = document.getElementById('cancel-btn');
        const statsSection = document.getElementById('stats-section');

        // Elementos de autenticación
        const guestButtons = document.getElementById('guest-buttons');
        const userSection = document.getElementById('user-section');
        const userNameSpan = document.getElementById('user-name');
        const userRoleSpan = document.getElementById('user-role');
        const loginBtn = document.getElementById('login-btn');
        const dashboardBtn = document.getElementById('dashboard-btn');
        const logoutBtn = document.getElementById('logout-btn');

        // Función para mostrar toast notifications
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

        // Función para mostrar mensaje en el formulario
        function showMessage(message, type = 'error') {
            const bgColor = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
            const icon = type === 'success' ? 
                '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>' :
                '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>';
            
            messageContainer.className = `flex items-center p-4 mb-4 text-sm border rounded-lg ${bgColor}`;
            messageContainer.innerHTML = `
                ${icon}
                <span class="ml-2">${message}</span>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-current rounded-lg focus:ring-2 p-1.5 hover:bg-current hover:bg-opacity-10" onclick="hideMessage()">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            messageContainer.classList.remove('hidden');
            messageContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function hideMessage() {
            messageContainer.classList.add('hidden');
        }

        // Función para verificar sesión del usuario
        function checkUserSession() {
            const userSession = localStorage.getItem('user_session') || sessionStorage.getItem('user_session');
            
            if (userSession) {
                try {
                    const session = JSON.parse(userSession);
                    const currentTime = new Date().getTime();
                    const loginTime = session.loginTime;
                    const timeDiff = currentTime - loginTime;
                    
                    // Si la sesión tiene menos de 24 horas, es válida
                    if (timeDiff < 24 * 60 * 60 * 1000) {
                        currentUser = session;
                        updateAuthUI(true);
                        
                        // Pre-llenar nombre si está logueado
                        if (session.nombre && document.getElementById('nombre_reporta')) {
                            document.getElementById('nombre_reporta').value = session.nombre;
                        }
                        
                        return true;
                    } else {
                        // Sesión expirada, limpiar
                        clearUserSession();
                        return false;
                    }
                } catch (e) {
                    // Error al parsear sesión, limpiar
                    clearUserSession();
                    return false;
                }
            }
            
            updateAuthUI(false);
            return false;
        }

        // Función para actualizar la UI de autenticación
        function updateAuthUI(isLoggedIn) {
    if (isLoggedIn && currentUser) {
        guestButtons.classList.add('hidden');
        userSection.classList.remove('hidden');
        userNameSpan.textContent = currentUser.nombre || currentUser.username;
        userRoleSpan.textContent = currentUser.rol.toUpperCase();
        
        const roleColors = {
            'admin': 'bg-red-200 text-red-800',
            'tecnico': 'bg-blue-200 text-blue-800',
            'usuario': 'bg-green-200 text-green-800'
        };
        userRoleSpan.className = `text-xs px-2 py-1 rounded-full ${roleColors[currentUser.rol] || 'bg-gray-200 text-gray-800'}`;
        
        const canAccessDashboard = currentUser.rol === 'admin' || currentUser.rol === 'tecnico';
        if (canAccessDashboard) {
            dashboardBtn.classList.remove('hidden');
        } else {
            dashboardBtn.classList.add('hidden');
        }
        
        // NUEVO: Mostrar botón de chat para todos los usuarios logueados
        if (chatToggle) {
            chatToggle.classList.remove('hidden');
        }
    } else {
        guestButtons.classList.remove('hidden');
        userSection.classList.add('hidden');
        currentUser = null;
        
        // NUEVO: Ocultar botón de chat si no hay usuario
        if (chatToggle) {
            chatToggle.classList.add('hidden');
        }
    }
}
















        // Función para limpiar sesión
        function clearUserSession() {
            localStorage.removeItem('user_session');
            sessionStorage.removeItem('user_session');
            localStorage.removeItem('remember_user');
            currentUser = null;
            updateAuthUI(false);
        }

        // Cargar tipos de incidencia
        async function loadTiposIncidencia() {
            try {
                const response = await fetch(TIPOS_API);
                if (!response.ok) throw new Error('Error al cargar tipos');
                
                const result = await response.json();
                const tipoSelect = document.getElementById('tipo_incidencia');
                
                tipoSelect.innerHTML = '<option value="">Selecciona el tipo...</option>';
                
                if (result.records && result.records.length > 0) {
                    result.records.forEach(tipo => {
                        const option = document.createElement('option');
                        option.value = tipo.id_tipo_incidencia;
                        option.textContent = tipo.nombre;
                        tipoSelect.appendChild(option);
                    });
                }
            } catch (error) {
                console.error('Error al cargar tipos:', error);
            }
        }

        // Cargar estadísticas básicas
        async function loadStats() {
            try {
                const response = await fetch(`${INCIDENCIAS_API}?action=stats`);
                if (!response.ok) throw new Error('Error al cargar estadísticas');
                
                const result = await response.json();
                if (result.stats) {
                    renderStats(result.stats);
                }
            } catch (error) {
                console.error('Error al cargar estadísticas:', error);
            }
        }

        function renderStats(stats) {
            let abiertas = 0, proceso = 0, cerradas = 0;
            
            if (stats.por_estado) {
                stats.por_estado.forEach(estado => {
                    switch(estado.estado) {
                        case 'abierta':
                            abiertas = estado.count;
                            break;
                        case 'en_proceso':
                            proceso = estado.count;
                            break;
                        case 'cerrada':
                            cerradas = estado.count;
                            break;
                    }
                });
            }

            statsSection.innerHTML = `
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-red-600 mb-2">${abiertas}</div>
                    <div class="text-sm font-medium text-gray-600">Incidencias Abiertas</div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-yellow-600 mb-2">${proceso}</div>
                    <div class="text-sm font-medium text-gray-600">En Proceso</div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-green-600 mb-2">${cerradas}</div>
                    <div class="text-sm font-medium text-gray-600">Resueltas</div>
                </div>
            `;
        }

        // Toggle del formulario
        toggleFormBtn.addEventListener('click', () => {
            const isHidden = reportFormContainer.classList.contains('hidden');
            
            if (isHidden) {
                reportFormContainer.classList.remove('hidden');
                toggleText.textContent = '❌ Cancelar Reporte';
                reportFormContainer.scrollIntoView({ behavior: 'smooth' });
            } else {
                reportFormContainer.classList.add('hidden');
                toggleText.textContent = '📝 Reportar Nueva Incidencia';
                hideMessage();
                incidentForm.reset();
            }
        });

        // Botón cancelar
        cancelBtn.addEventListener('click', () => {
            reportFormContainer.classList.add('hidden');
            toggleText.textContent = '📝 Reportar Nueva Incidencia';
            hideMessage();
            incidentForm.reset();
        });

        // Event listeners de navegación
        loginBtn.addEventListener('click', () => {
            window.location.href = 'login.php';
        });

        dashboardBtn.addEventListener('click', () => {
            window.location.href = 'dashboard.php';
        });

        logoutBtn.addEventListener('click', () => {
            if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                clearUserSession();
                showToast('Sesión cerrada correctamente', 'success');
            }
        });

        // Manejo del formulario
        incidentForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(incidentForm);
            const data = {
                titulo: formData.get('titulo').trim(),
                descripcion: formData.get('descripcion').trim(),
                nombre_reporta: formData.get('nombre_reporta').trim(),
                email_reporta: formData.get('email_reporta').trim(),
                id_tipo_incidencia: formData.get('tipo_incidencia') || null,
                prioridad: formData.get('prioridad') || 'media',
                estado: 'abierta',
                id_usuario_reporta: currentUser ? currentUser.id : null
            };

            // Validaciones
            if (!data.titulo) {
                showMessage('El título es requerido');
                return;
            }
            if (!data.descripcion) {
                showMessage('La descripción es requerida');
                return;
            }
            if (!data.nombre_reporta) {
                showMessage('Tu nombre es requerido');
                return;
            }
            if (!data.email_reporta) {
                showMessage('Tu email es requerido');
                return;
            }

            // Mostrar loading
            submitText.textContent = '';
            submitLoading.classList.remove('hidden');
            submitBtn.disabled = true;
            hideMessage();

            try {
                const response = await fetch(INCIDENCIAS_API, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showMessage('¡Incidencia reportada exitosamente! Te contactaremos pronto.', 'success');
                    incidentForm.reset();
                    showToast('Reporte enviado exitosamente', 'success');
                    
                    // Actualizar estadísticas
                    loadStats();
                    
                    // Ocultar formulario después de 3 segundos
                    setTimeout(() => {
                        reportFormContainer.classList.add('hidden');
                        toggleText.textContent = '📝 Reportar Nueva Incidencia';
                        hideMessage();
                    }, 3000);
                } else {
                    showMessage(result.message || 'Error al enviar el reporte. Inténtalo nuevamente.');
                }
            } catch (error) {
                console.error('Error al enviar reporte:', error);
                showMessage('Error de conexión. Por favor, inténtalo nuevamente.');
            } finally {
                // Ocultar loading
                submitText.textContent = 'Enviar Reporte';
                submitLoading.classList.remove('hidden');
                submitBtn.disabled = false;
            }
        });

        // Inicializar la aplicación
        async function init() {
            // Verificar sesión del usuario
            checkUserSession();
            
            // Cargar datos iniciales
            await Promise.all([
                loadTiposIncidencia(),
                loadStats()
            ]);
            
            // Si hay usuario logueado, pre-llenar algunos campos
            if (currentUser) {
                const nombreInput = document.getElementById('nombre_reporta');
                if (nombreInput && currentUser.nombre) {
                    nombreInput.value = currentUser.nombre;
                }
            }
        }

        // Inicializar cuando la página esté cargada
        window.addEventListener('load', init);

        // Verificar sesión periódicamente (cada 5 minutos)
        setInterval(checkUserSession, 5 * 60 * 1000);



        // Chat Assistant Logic
        

                        // ============================================
                // CHAT ASSISTANT FUNCTIONALITY
                // ============================================

                const CHAT_API = '../api/controllers/chat.php';

                // Elementos del chat
                const chatToggle = document.getElementById('chat-toggle');
                const chatContainer = document.getElementById('chat-container');
                const chatClose = document.getElementById('chat-close');
                const chatMessages = document.getElementById('chat-messages');
                const chatInput = document.getElementById('chat-input');
                const chatSend = document.getElementById('chat-send');

                let isTyping = false;

                // Función para mostrar/ocultar el chat
                function toggleChat() {
                    chatContainer.classList.toggle('hidden');
                    if (!chatContainer.classList.contains('hidden')) {
                        chatInput.focus();
                    }
                }

                // Función para cerrar el chat
                function closeChat() {
                    chatContainer.classList.add('hidden');
                }

                // Función para agregar mensaje al chat
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

                // Función para mostrar indicador de escritura
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

                // Función para ocultar indicador de escritura
                function hideTypingIndicator() {
                    const typingIndicator = document.getElementById('typing-indicator');
                    if (typingIndicator) {
                        typingIndicator.remove();
                    }
                    isTyping = false;
                }

                // Función para enviar mensaje
                async function sendChatMessage() {
                    const message = chatInput.value.trim();
                    if (!message) return;
                    
                    // Verificar si el usuario está logueado
                    if (!currentUser) {
                        addChatMessage('Debes iniciar sesión para usar el asistente.', false);
                        return;
                    }
                    
                    addChatMessage(message, true);
                    chatInput.value = '';
                    showTypingIndicator();
                    
                    try {
                        const userSession = localStorage.getItem('user_session') || sessionStorage.getItem('user_session');
                        
                        if (!userSession) {
                            hideTypingIndicator();
                            addChatMessage('Error: No hay sesión activa. Por favor inicia sesión.', false);
                            return;
                        }
                        
                        const token = btoa(userSession);
                        
                        const response = await fetch(CHAT_API, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${token}`
                            },
                            body: JSON.stringify({ message })
                        });
                        
                        const responseText = await response.text();
                        hideTypingIndicator();
                        
                        let result;
                        try {
                            result = JSON.parse(responseText);
                        } catch (jsonError) {
                            console.error('Error parseando JSON:', jsonError);
                            console.error('Respuesta recibida:', responseText);
                            addChatMessage('Error del servidor. Por favor, intenta más tarde.', false);
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

                // Event listeners del chat
                if (chatToggle) {
                    chatToggle.addEventListener('click', toggleChat);
                }

                if (chatClose) {
                    chatClose.addEventListener('click', closeChat);
                }

                if (chatSend) {
                    chatSend.addEventListener('click', sendChatMessage);
                }

                if (chatInput) {
                    chatInput.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            sendChatMessage();
                        }
                    });
                }


       


    </script>
</body>
</html>