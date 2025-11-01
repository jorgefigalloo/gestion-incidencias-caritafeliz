<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Carita Feliz - Responder Incidencias</title>
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
                        <p class="text-sm text-gray-600">Sistema de Gestión de Tecnología</p>
                    </div>
                </div>
                
                <!-- Navegación simplificada para iframe del dashboard -->
                <div class="text-sm text-gray-500">
                    Módulo: Responder Incidencias
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-8">
        <!-- Verificación de acceso -->
        <div id="access-denied" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <span>Solo técnicos y administradores pueden acceder a esta sección. <a href="login.php" class="underline">Iniciar sesión</a></span>
            </div>
        </div>

        <!-- Título de la sección -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Responder Incidencias</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Gestiona y responde las incidencias reportadas por los usuarios del sistema.
            </p>
        </div>

        <!-- Estadísticas rápidas -->
        <div id="stats-section" class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <!-- Las estadísticas se cargarán aquí -->
        </div>

        <!-- Filtros de incidencias -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="filter-estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select id="filter-estado" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos los estados</option>
                        <option value="abierta">Abierta</option>
                        <option value="en_proceso">En Proceso</option>
                        <option value="cerrada">Cerrada</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>
                
                <div>
                    <label for="filter-prioridad" class="block text-sm font-medium text-gray-700 mb-1">Prioridad</label>
                    <select id="filter-prioridad" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todas las prioridades</option>
                        <option value="baja">Baja</option>
                        <option value="media">Media</option>
                        <option value="alta">Alta</option>
                        <option value="critica">Crítica</option>
                    </select>
                </div>
                
                <div>
                    <label for="filter-tecnico" class="block text-sm font-medium text-gray-700 mb-1">Técnico</label>
                    <select id="filter-tecnico" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos los técnicos</option>
                        <option value="sin-asignar">Sin asignar</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button id="clear-filters" class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        Limpiar Filtros
                    </button>
                </div>
            </div>
            
            <!-- Barra de búsqueda -->
            <div class="mt-4">
                <div class="relative">
                    <input 
                        type="text" 
                        id="search-input" 
                        placeholder="Buscar por título, descripción o reportante..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Indicador de carga -->
        <div id="loading" class="text-center py-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <p class="mt-2 text-gray-600">Cargando incidencias...</p>
        </div>

        <!-- Lista de incidencias -->
        <div id="incidencias-container" class="hidden">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Incidencias para Responder
                        <span id="total-incidencias" class="ml-2 text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded-full">0</span>
                    </h3>
                </div>
                
                <div id="incidencias-list" class="divide-y divide-gray-200">
                    <!-- Las incidencias se cargarán aquí -->
                </div>
            </div>
        </div>

        <!-- Mensaje cuando no hay incidencias -->
        <div id="no-incidencias" class="hidden bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay incidencias que respondan a los filtros</h3>
            <p class="text-gray-500">Intenta cambiar los filtros o buscar con otros términos.</p>
        </div>
    </main>

    <!-- Modal para responder incidencia -->
    <div id="response-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-screen overflow-y-auto">
            <div class="px-6 py-4 border-b bg-gray-50">
                <div class="flex items-center justify-between">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Responder Incidencia</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <!-- Información de la incidencia -->
                <div id="modal-incidencia-info" class="mb-6">
                    <!-- Se llenará dinámicamente -->
                </div>
                
                <!-- Formulario de respuesta -->
                <form id="response-form" class="space-y-6">
                    <input type="hidden" id="incidencia-id-modal">
                    
                    <div>
                        <label for="respuesta-modal" class="block text-sm font-medium text-gray-700 mb-2">
                            Respuesta/Solución <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="respuesta-modal" 
                            name="respuesta" 
                            rows="6"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Describe la solución aplicada o respuesta proporcionada..."></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="estado-modal" class="block text-sm font-medium text-gray-700 mb-2">
                                Estado <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="estado-modal" 
                                name="estado" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Seleccionar estado...</option>
                                <option value="abierta">Abierta</option>
                                <option value="en_proceso">En Proceso</option>
                                <option value="cerrada">Cerrada</option>
                                <option value="cancelada">Cancelada</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="prioridad-modal" class="block text-sm font-medium text-gray-700 mb-2">
                                Prioridad
                            </label>
                            <select 
                                id="prioridad-modal" 
                                name="prioridad"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="baja">Baja</option>
                                <option value="media">Media</option>
                                <option value="alta">Alta</option>
                                <option value="critica">Crítica</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="tecnico-modal" class="block text-sm font-medium text-gray-700 mb-2">
                            Asignar Técnico
                        </label>
                        <select 
                            id="tecnico-modal" 
                            name="tecnico"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sin asignar</option>
                        </select>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button 
                            type="button" 
                            id="cancel-response"
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                            Cancelar
                        </button>
                        <button 
                            type="submit" 
                            id="submit-response"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                            <span id="submit-text">Enviar Respuesta</span>
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
    </div>

    <!-- Toast para notificaciones -->
    <div id="toast-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        // URLs de la API
        const INCIDENCIAS_API = '../api/controllers/incidencias.php';
        
        // Variables globales
        let currentUser = null;
        let incidenciasData = [];
        let filteredIncidencias = [];
        let tecnicos = [];
        
        // Elementos del DOM
        const accessDenied = document.getElementById('access-denied');
        const loading = document.getElementById('loading');
        const incidenciasContainer = document.getElementById('incidencias-container');
        const incidenciasList = document.getElementById('incidencias-list');
        const noIncidencias = document.getElementById('no-incidencias');
        const totalIncidencias = document.getElementById('total-incidencias');
        const statsSection = document.getElementById('stats-section');
        
        // Filtros
        const filterEstado = document.getElementById('filter-estado');
        const filterPrioridad = document.getElementById('filter-prioridad');
        const filterTecnico = document.getElementById('filter-tecnico');
        const clearFiltersBtn = document.getElementById('clear-filters');
        const searchInput = document.getElementById('search-input');
        
        // Modal
        const responseModal = document.getElementById('response-modal');
        const modalTitle = document.getElementById('modal-title');
        const closeModal = document.getElementById('close-modal');
        const responseForm = document.getElementById('response-form');
        const submitResponse = document.getElementById('submit-response');
        const submitText = document.getElementById('submit-text');
        const submitLoading = document.getElementById('submit-loading');
        const cancelResponse = document.getElementById('cancel-response');

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

        // Verificar autenticación y permisos
        function checkAuthenticationAndPermissions() {
            const userSession = localStorage.getItem('user_session') || sessionStorage.getItem('user_session');
            
            if (!userSession) {
                accessDenied.classList.remove('hidden');
                loading.classList.add('hidden');
                return false;
            }

            try {
                const session = JSON.parse(userSession);
                const currentTime = new Date().getTime();
                const loginTime = session.loginTime;
                const timeDiff = currentTime - loginTime;
                
                if (timeDiff >= 24 * 60 * 60 * 1000) {
                    accessDenied.classList.remove('hidden');
                    loading.classList.add('hidden');
                    return false;
                }
                
                if (session.rol !== 'admin' && session.rol !== 'tecnico') {
                    accessDenied.classList.remove('hidden');
                    loading.classList.add('hidden');
                    return false;
                }
                
                currentUser = session;
                return true;
            } catch (e) {
                accessDenied.classList.remove('hidden');
                loading.classList.add('hidden');
                return false;
            }
        }

        // Cargar técnicos
        async function loadTecnicos() {
            try {
                const response = await fetch(`${INCIDENCIAS_API}?action=tecnicos`);
                if (!response.ok) throw new Error('Error al cargar técnicos');
                
                const result = await response.json();
                tecnicos = result.tecnicos || [];
                
                // Llenar select de filtros
                filterTecnico.innerHTML = '<option value="">Todos los técnicos</option><option value="sin-asignar">Sin asignar</option>';
                tecnicos.forEach(tecnico => {
                    filterTecnico.innerHTML += `<option value="${tecnico.id_usuario}">${tecnico.nombre_completo}</option>`;
                });
                
                // Llenar select del modal
                const tecnicoModal = document.getElementById('tecnico-modal');
                if (tecnicoModal) {
                    tecnicoModal.innerHTML = '<option value="">Sin asignar</option>';
                    tecnicos.forEach(tecnico => {
                        tecnicoModal.innerHTML += `<option value="${tecnico.id_usuario}">${tecnico.nombre_completo}</option>`;
                    });
                }
                
            } catch (error) {
                console.error('Error al cargar técnicos:', error);
            }
        }

        // Cargar estadísticas
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

        // Renderizar estadísticas
        function renderStats(stats) {
            let abiertas = 0, proceso = 0, cerradas = 0, total = stats.total || 0;
            
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
                    <div class="text-3xl font-bold text-blue-600 mb-2">${total}</div>
                    <div class="text-sm font-medium text-gray-600">Total Incidencias</div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-red-600 mb-2">${abiertas}</div>
                    <div class="text-sm font-medium text-gray-600">Abiertas</div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-yellow-600 mb-2">${proceso}</div>
                    <div class="text-sm font-medium text-gray-600">En Proceso</div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-green-600 mb-2">${cerradas}</div>
                    <div class="text-sm font-medium text-gray-600">Cerradas</div>
                </div>
            `;
        }

        // Cargar incidencias
        async function loadIncidencias() {
            try {
                const response = await fetch(INCIDENCIAS_API);
                if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
                
                const result = await response.json();
                
                if (result.records && Array.isArray(result.records)) {
                    incidenciasData = result.records;
                    applyFilters();
                } else {
                    incidenciasData = [];
                    filteredIncidencias = [];
                    renderIncidencias();
                }
            } catch (error) {
                console.error('Error al cargar incidencias:', error);
                showToast('Error al cargar las incidencias. Revise su conexión.', 'error');
                incidenciasData = [];
                filteredIncidencias = [];
                renderIncidencias();
            } finally {
                loading.classList.add('hidden');
            }
        }

        // Aplicar filtros
        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const estadoFilter = filterEstado.value;
            const prioridadFilter = filterPrioridad.value;
            const tecnicoFilter = filterTecnico.value;

            filteredIncidencias = incidenciasData.filter(incidencia => {
                // Filtro de búsqueda
                if (searchTerm) {
                    const searchMatch = 
                        incidencia.titulo.toLowerCase().includes(searchTerm) ||
                        incidencia.descripcion.toLowerCase().includes(searchTerm) ||
                        (incidencia.nombre_reporta && incidencia.nombre_reporta.toLowerCase().includes(searchTerm)) ||
                        (incidencia.email_reporta && incidencia.email_reporta.toLowerCase().includes(searchTerm));
                    
                    if (!searchMatch) return false;
                }

                // Filtro de estado
                if (estadoFilter && incidencia.estado !== estadoFilter) {
                    return false;
                }

                // Filtro de prioridad
                if (prioridadFilter && incidencia.prioridad !== prioridadFilter) {
                    return false;
                }

                // Filtro de técnico
                if (tecnicoFilter) {
                    if (tecnicoFilter === 'sin-asignar') {
                        if (incidencia.id_usuario_tecnico) return false;
                    } else {
                        if (incidencia.id_usuario_tecnico != tecnicoFilter) return false;
                    }
                }

                return true;
            });

            renderIncidencias();
        }

        // Renderizar incidencias
        function renderIncidencias() {
            incidenciasList.innerHTML = '';
            totalIncidencias.textContent = filteredIncidencias.length;

            if (filteredIncidencias.length === 0) {
                incidenciasContainer.classList.add('hidden');
                noIncidencias.classList.remove('hidden');
                return;
            }

            incidenciasContainer.classList.remove('hidden');
            noIncidencias.classList.add('hidden');

            filteredIncidencias.forEach(incidencia => {
                const incidenciaElement = createIncidenciaElement(incidencia);
                incidenciasList.appendChild(incidenciaElement);
            });
        }

        // Crear elemento de incidencia - ACTUALIZADO CON SUBTIPOS
        function createIncidenciaElement(incidencia) {
            const div = document.createElement('div');
            div.className = 'p-6 hover:bg-gray-50 transition duration-200';

            const estadoClass = getEstadoClass(incidencia.estado);
            const prioridadClass = getPrioridadClass(incidencia.prioridad);
            
            const reportadoPor = incidencia.nombre_reporta || 'Usuario anónimo';
            const tecnicoAsignado = getTecnicoName(incidencia.id_usuario_tecnico);
            const tipoIncidencia = incidencia.tipo_nombre || 'Sin tipo';
            
            // NUEVO: Subtipo si existe
            const subtipoIncidencia = incidencia.subtipo_nombre ? 
                `<span class="ml-2 px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">${escapeHtml(incidencia.subtipo_nombre)}</span>` : '';

            div.innerHTML = `
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex-1 mb-4 lg:mb-0">
                        <div class="flex items-start justify-between mb-2">
                            <h4 class="text-lg font-semibold text-gray-900 mr-4">#${incidencia.id_incidencia} - ${escapeHtml(incidencia.titulo)}</h4>
                            <div class="flex space-x-2 flex-shrink-0">
                                <span class="px-2 py-1 rounded-full text-xs font-medium ${estadoClass}">
                                    ${incidencia.estado.replace('_', ' ').toUpperCase()}
                                </span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium ${prioridadClass}">
                                    ${incidencia.prioridad.toUpperCase()}
                                </span>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 mb-2 line-clamp-2">${escapeHtml(incidencia.descripcion)}</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 text-sm text-gray-500">
                            <div>
                                <strong>Tipo:</strong> 
                                <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">${escapeHtml(tipoIncidencia)}</span>
                                ${subtipoIncidencia}
                            </div>
                            <div><strong>Reportado por:</strong> ${escapeHtml(reportadoPor)}</div>
                            <div><strong>Técnico:</strong> ${escapeHtml(tecnicoAsignado)}</div>
                            <div><strong>Fecha:</strong> ${formatDate(incidencia.fecha_reporte)}</div>
                        </div>
                        
                        ${incidencia.respuesta_solucion ? `
                            <div class="mt-3 p-3 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                                <p class="text-sm text-blue-800"><strong>Respuesta actual:</strong> ${escapeHtml(incidencia.respuesta_solucion.substring(0, 150))}${incidencia.respuesta_solucion.length > 150 ? '...' : ''}</p>
                            </div>
                        ` : ''}
                    </div>
                    
                    <div class="flex flex-col sm:flex-row lg:flex-col gap-2 lg:ml-6">
                        <button onclick="openResponseModal(${incidencia.id_incidencia})" 
                                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Responder</span>
                        </button>
                        
                        ${incidencia.email_reporta ? `
                            <a href="mailto:${incidencia.email_reporta}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>Email</span>
                            </a>
                        ` : ''}
                    </div>
                </div>
            `;

            return div;
        }

        // Funciones auxiliares
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function getEstadoClass(estado) {
            const classes = {
                'abierta': 'bg-red-100 text-red-800',
                'en_proceso': 'bg-yellow-100 text-yellow-800',
                'cerrada': 'bg-green-100 text-green-800',
                'cancelada': 'bg-gray-100 text-gray-800'
            };
            return classes[estado] || classes['abierta'];
        }

        function getPrioridadClass(prioridad) {
            const classes = {
                'baja': 'bg-green-100 text-green-800',
                'media': 'bg-yellow-100 text-yellow-800',
                'alta': 'bg-orange-100 text-orange-800',
                'critica': 'bg-red-100 text-red-800'
            };
            return classes[prioridad] || classes['media'];
        }

        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('es-ES', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function getTecnicoName(idTecnico) {
            if (!idTecnico) return 'Sin asignar';
            const tecnico = tecnicos.find(t => t.id_usuario == idTecnico);
            return tecnico ? tecnico.nombre_completo : 'Sin asignar';
        }

        // Abrir modal de respuesta - ACTUALIZADO CON SUBTIPOS
        function openResponseModal(incidenciaId) {
            const incidencia = incidenciasData.find(i => i.id_incidencia == incidenciaId);
            if (!incidencia) return;

            // Llenar información de la incidencia en el modal
            const modalInfo = document.getElementById('modal-incidencia-info');
            const reportadoPor = incidencia.nombre_reporta || 'Usuario anónimo';
            const tipoIncidencia = incidencia.tipo_nombre || 'Sin tipo';
            const subtipoIncidencia = incidencia.subtipo_nombre || null;

            modalInfo.innerHTML = `
                <div class="bg-gray-50 p-4 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">#${incidencia.id_incidencia} - ${escapeHtml(incidencia.titulo)}</h4>
                            <p class="text-sm text-gray-600 mb-2">${escapeHtml(incidencia.descripcion)}</p>
                            <div class="flex items-center space-x-2 mb-1">
                                <p class="text-sm"><strong>Tipo:</strong></p>
                                <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">${escapeHtml(tipoIncidencia)}</span>
                                ${subtipoIncidencia ? `<span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">${escapeHtml(subtipoIncidencia)}</span>` : ''}
                            </div>
                        </div>
                        <div>
                            <p class="text-sm mb-1"><strong>Reportado por:</strong> ${escapeHtml(reportadoPor)}</p>
                            <p class="text-sm mb-1"><strong>Email:</strong> ${escapeHtml(incidencia.email_reporta || 'No especificado')}</p>
                            <p class="text-sm mb-1"><strong>Estado actual:</strong> ${incidencia.estado.replace('_', ' ')}</p>
                            <p class="text-sm"><strong>Fecha:</strong> ${formatDate(incidencia.fecha_reporte)}</p>
                        </div>
                    </div>
                </div>
            `;

            // Llenar formulario con datos actuales
            document.getElementById('incidencia-id-modal').value = incidenciaId;
            document.getElementById('respuesta-modal').value = incidencia.respuesta_solucion || '';
            document.getElementById('estado-modal').value = incidencia.estado;
            document.getElementById('prioridad-modal').value = incidencia.prioridad;
            document.getElementById('tecnico-modal').value = incidencia.id_usuario_tecnico || '';

            modalTitle.textContent = `Responder Incidencia #${incidenciaId}`;
            responseModal.classList.remove('hidden');
        }

        // Event listeners
        filterEstado.addEventListener('change', applyFilters);
        filterPrioridad.addEventListener('change', applyFilters);
        filterTecnico.addEventListener('change', applyFilters);
        searchInput.addEventListener('input', applyFilters);
        
        clearFiltersBtn.addEventListener('click', () => {
            filterEstado.value = '';
            filterPrioridad.value = '';
            filterTecnico.value = '';
            searchInput.value = '';
            applyFilters();
        });

        // Modal
        closeModal.addEventListener('click', () => responseModal.classList.add('hidden'));
        cancelResponse.addEventListener('click', () => responseModal.classList.add('hidden'));
        
        responseModal.addEventListener('click', (e) => {
            if (e.target === responseModal) {
                responseModal.classList.add('hidden');
            }
        });

        // Envío de respuesta
        responseForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(responseForm);
            const updateData = {
                id_incidencia: parseInt(document.getElementById('incidencia-id-modal').value),
                respuesta_solucion: document.getElementById('respuesta-modal').value.trim(),
                estado: document.getElementById('estado-modal').value,
                prioridad: document.getElementById('prioridad-modal').value,
                id_usuario_tecnico: document.getElementById('tecnico-modal').value || null
            };

            if (!updateData.respuesta_solucion) {
                showToast('La respuesta es requerida', 'error');
                return;
            }

            if (!updateData.estado) {
                showToast('Debes seleccionar un estado', 'error');
                return;
            }

            // Mostrar loading
            submitText.textContent = '';
            submitLoading.classList.remove('hidden');
            submitResponse.disabled = true;

            try {
                const response = await fetch(INCIDENCIAS_API, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(updateData)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showToast('Respuesta enviada exitosamente', 'success');
                    responseModal.classList.add('hidden');
                    
                    // Recargar datos
                    loading.classList.remove('hidden');
                    await Promise.all([loadIncidencias(), loadStats()]);
                } else {
                    showToast(result.message || 'Error al enviar respuesta', 'error');
                }
            } catch (error) {
                console.error('Error al enviar respuesta:', error);
                showToast('Error de conexión', 'error');
            } finally {
                submitText.textContent = 'Enviar Respuesta';
                submitLoading.classList.add('hidden');
                submitResponse.disabled = false;
            }
        });

        // Función global para el modal (llamada desde botones)
        window.openResponseModal = openResponseModal;

        // Inicializar
        async function init() {
            if (!checkAuthenticationAndPermissions()) {
                return;
            }

            await Promise.all([
                loadTecnicos(),
                loadStats(),
                loadIncidencias()
            ]);
        }

        // Iniciar cuando cargue la página
        window.addEventListener('load', init);
    </script>
</body>
</html>