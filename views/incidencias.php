<?php
include '../includes/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <!-- Header con título y controles principales -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Incidencias</h1>
        
        <!-- Controles principales -->
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-80">
                <input 
                    type="text" 
                    id="search-input" 
                    placeholder="Buscar incidencias..." 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button 
                    id="clear-search" 
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 hidden"
                    title="Limpiar búsqueda"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <button id="add-incidencia-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 whitespace-nowrap">
                + Nueva Incidencia
            </button>
        </div>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
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
                <label for="filter-tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                <select id="filter-tipo" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todos los tipos</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button id="clear-filters" class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Limpiar Filtros
                </button>
            </div>
        </div>
    </div>

    <!-- Indicador de carga -->
    <div id="loading" class="hidden text-center py-8">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Cargando incidencias...</p>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div id="stats-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 hidden">
        <!-- Las estadísticas se llenarán aquí -->
    </div>

    <!-- Tabla de incidencias -->
    <div id="incidencias-table-container" class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Título
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tipo
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Reportado por
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Estado
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Prioridad
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Fecha Reporte
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Técnico
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody id="incidencias-table-body" class="text-gray-700">
                <!-- Los datos se llenarán aquí con JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Mensaje cuando no hay datos -->
    <div id="no-data-message" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay incidencias registradas</h3>
        <p class="text-gray-500 mb-4">Comienza agregando tu primera incidencia haciendo clic en el botón "Nueva Incidencia".</p>
    </div>

    <!-- Mensaje cuando no hay resultados de búsqueda -->
    <div id="no-search-results" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron resultados</h3>
        <p class="text-gray-500 mb-4">No hay incidencias que coincidan con tu búsqueda. Intenta con otros términos.</p>
        <button id="clear-search-from-message" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Limpiar búsqueda
        </button>
    </div>
</div>

<!-- Modal para agregar/editar incidencias -->
<div id="incidencia-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-2xl mx-4 max-h-screen overflow-y-auto">
        <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-6"></h2>
        <form id="incidencia-form">
            <input type="hidden" id="incidencia-id">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="incidencia-titulo" class="block text-gray-700 font-semibold mb-2">
                        Título <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="incidencia-titulo" 
                        maxlength="100"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        required
                        placeholder="Título de la incidencia">
                </div>
                
                <div>
                    <label for="incidencia-tipo" class="block text-gray-700 font-semibold mb-2">Tipo de Incidencia</label>
                    <select id="incidencia-tipo" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccionar tipo...</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="incidencia-descripcion" class="block text-gray-700 font-semibold mb-2">
                    Descripción <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="incidencia-descripcion" 
                    rows="4"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                    placeholder="Describa detalladamente la incidencia..."></textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="incidencia-nombre-reporta" class="block text-gray-700 font-semibold mb-2">Nombre del Reportante</label>
                    <input 
                        type="text" 
                        id="incidencia-nombre-reporta" 
                        maxlength="100"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Nombre completo">
                </div>
                
                <div>
                    <label for="incidencia-email-reporta" class="block text-gray-700 font-semibold mb-2">Email del Reportante</label>
                    <input 
                        type="email" 
                        id="incidencia-email-reporta" 
                        maxlength="100"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="correo@ejemplo.com">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="incidencia-estado" class="block text-gray-700 font-semibold mb-2">Estado</label>
                    <select id="incidencia-estado" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="abierta">Abierta</option>
                        <option value="en_proceso">En Proceso</option>
                        <option value="cerrada">Cerrada</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>
                
                <div>
                    <label for="incidencia-prioridad" class="block text-gray-700 font-semibold mb-2">Prioridad</label>
                    <select id="incidencia-prioridad" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="baja">Baja</option>
                        <option value="media" selected>Media</option>
                        <option value="alta">Alta</option>
                        <option value="critica">Crítica</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="incidencia-tecnico" class="block text-gray-700 font-semibold mb-2">Técnico Asignado</label>
                <select id="incidencia-tecnico" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Sin asignar</option>
                </select>
            </div>
            
            <div class="mb-6">
                <label for="incidencia-solucion" class="block text-gray-700 font-semibold mb-2">Respuesta/Solución</label>
                <textarea 
                    id="incidencia-solucion" 
                    rows="4"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Describa la solución aplicada o respuesta proporcionada..."></textarea>
            </div>
            
            <div class="flex justify-end space-x-4">
                <button type="button" id="close-modal-btn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                    Cancelar
                </button>
                <button type="submit" id="save-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    <span id="save-btn-text">Guardar</span>
                    <div id="save-btn-loading" class="hidden inline-block animate-spin rounded-full h-4 w-4 border-b-2 border-white ml-2"></div>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div id="delete-confirm-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-sm mx-4">
        <div class="text-center">
            <div class="text-red-500 mb-4">
                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-4">Confirmar eliminación</h2>
            <p class="mb-6 text-gray-600">¿Estás seguro de que deseas eliminar esta incidencia? Esta acción no se puede deshacer.</p>
            <div class="flex justify-center space-x-4">
                <button type="button" id="cancel-delete-btn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                    Cancelar
                </button>
                <button type="button" id="confirm-delete-btn" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    <span id="delete-btn-text">Eliminar</span>
                    <div id="delete-btn-loading" class="hidden inline-block animate-spin rounded-full h-4 w-4 border-b-2 border-white ml-2"></div>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast para notificaciones -->
<div id="toast-container" class="fixed top-4 right-4 z-50"></div>

<script>
    const API_URL = '../api/controllers/incidencias.php';
    
    // Variables globales
    let allIncidencias = []; 
    let filteredIncidencias = []; 
    let currentFilters = {
        search: '',
        estado: '',
        prioridad: '',
        tipo: ''
    };
    let tiposIncidencia = [];
    let tecnicos = [];
    
    // Elementos del DOM
    const incidenciasTableBody = document.getElementById('incidencias-table-body');
    const incidenciasTableContainer = document.getElementById('incidencias-table-container');
    const noDataMessage = document.getElementById('no-data-message');
    const noSearchResults = document.getElementById('no-search-results');
    const loadingIndicator = document.getElementById('loading');
    const searchInput = document.getElementById('search-input');
    const clearSearchBtn = document.getElementById('clear-search');
    const statsContainer = document.getElementById('stats-container');
    
    // Filtros
    const filterEstado = document.getElementById('filter-estado');
    const filterPrioridad = document.getElementById('filter-prioridad');
    const filterTipo = document.getElementById('filter-tipo');
    const clearFiltersBtn = document.getElementById('clear-filters');
    
    // Elementos de los modales
    const addIncidenciaBtn = document.getElementById('add-incidencia-btn');
    const incidenciaModal = document.getElementById('incidencia-modal');
    const closeIncidenciaModalBtn = document.getElementById('close-modal-btn');
    const modalTitle = document.getElementById('modal-title');
    const incidenciaForm = document.getElementById('incidencia-form');
    const incidenciaIdInput = document.getElementById('incidencia-id');
    const saveBtn = document.getElementById('save-btn');
    const saveBtnText = document.getElementById('save-btn-text');
    const saveBtnLoading = document.getElementById('save-btn-loading');
    const deleteConfirmModal = document.getElementById('delete-confirm-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const deleteBtnText = document.getElementById('delete-btn-text');
    const deleteBtnLoading = document.getElementById('delete-btn-loading');
    let incidenciaIdToDelete = null;

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

    // Función para mostrar/ocultar loading
    function setLoading(show) {
        loadingIndicator.classList.toggle('hidden', !show);
        incidenciasTableContainer.classList.toggle('hidden', show);
        noDataMessage.classList.add('hidden');
        noSearchResults.classList.add('hidden');
    }

    // Función para escapar HTML
    function escapeHtml(text) {
        if (!text) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    // Función para formatear fechas
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

    // Función para obtener clase CSS del estado
    function getEstadoClass(estado) {
        const classes = {
            'abierta': 'bg-red-100 text-red-800',
            'en_proceso': 'bg-yellow-100 text-yellow-800',
            'cerrada': 'bg-green-100 text-green-800',
            'cancelada': 'bg-gray-100 text-gray-800'
        };
        return classes[estado] || 'bg-gray-100 text-gray-800';
    }

    // Función para obtener clase CSS de la prioridad
    function getPrioridadClass(prioridad) {
        const classes = {
            'baja': 'bg-green-100 text-green-800',
            'media': 'bg-yellow-100 text-yellow-800',
            'alta': 'bg-orange-100 text-orange-800',
            'critica': 'bg-red-100 text-red-800'
        };
        return classes[prioridad] || 'bg-gray-100 text-gray-800';
    }

    // Función para filtrar incidencias
    function filterIncidencias() {
        let filtered = allIncidencias;
        
        // Filtro de búsqueda
        if (currentFilters.search) {
            const searchTerm = currentFilters.search.toLowerCase();
            filtered = filtered.filter(incidencia => {
                return incidencia.titulo.toLowerCase().includes(searchTerm) ||
                       incidencia.descripcion.toLowerCase().includes(searchTerm) ||
                       (incidencia.nombre_reporta && incidencia.nombre_reporta.toLowerCase().includes(searchTerm)) ||
                       (incidencia.reporta_usuario && incidencia.reporta_usuario.toLowerCase().includes(searchTerm));
            });
        }
        
        // Filtro de estado
        if (currentFilters.estado) {
            filtered = filtered.filter(incidencia => incidencia.estado === currentFilters.estado);
        }
        
        // Filtro de prioridad
        if (currentFilters.prioridad) {
            filtered = filtered.filter(incidencia => incidencia.prioridad === currentFilters.prioridad);
        }
        
        // Filtro de tipo
        if (currentFilters.tipo) {
            filtered = filtered.filter(incidencia => incidencia.id_tipo_incidencia == currentFilters.tipo);
        }
        
        filteredIncidencias = filtered;
        renderIncidencias(filteredIncidencias);
    }

    // Función para renderizar las incidencias en la tabla
    function renderIncidencias(incidencias) {
        incidenciasTableBody.innerHTML = '';
        
        if (incidencias.length > 0) {
            incidenciasTableContainer.classList.remove('hidden');
            noDataMessage.classList.add('hidden');
            noSearchResults.classList.add('hidden');
            
            incidencias.forEach(incidencia => {
                const reportadoPor = incidencia.reporta_usuario || incidencia.nombre_reporta || 'Sin especificar';
                const tecnicoAsignado = incidencia.tecnico_asignado || 'Sin asignar';
                
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-50', 'transition', 'duration-150', 'ease-in-out', 'border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="px-5 py-5 text-sm font-medium">#${incidencia.id_incidencia}</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="font-medium text-gray-900">${escapeHtml(incidencia.titulo)}</div>
                        <div class="text-gray-500 text-xs truncate" style="max-width: 200px;" title="${escapeHtml(incidencia.descripcion)}">
                            ${escapeHtml(incidencia.descripcion.substring(0, 80))}${incidencia.descripcion.length > 80 ? '...' : ''}
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                            ${escapeHtml(incidencia.tipo_nombre || 'Sin tipo')}
                        </span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <div class="font-medium">${escapeHtml(reportadoPor)}</div>
                        ${incidencia.email_reporta ? `<div class="text-gray-500 text-xs">${escapeHtml(incidencia.email_reporta)}</div>` : ''}
                        ${incidencia.nombre_area ? `<div class="text-gray-500 text-xs">${escapeHtml(incidencia.nombre_area)} - ${escapeHtml(incidencia.nombre_sede || '')}</div>` : ''}
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${getEstadoClass(incidencia.estado)}">
                            ${incidencia.estado.replace('_', ' ').toUpperCase()}
                        </span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${getPrioridadClass(incidencia.prioridad)}">
                            ${incidencia.prioridad.toUpperCase()}
                        </span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <div class="font-medium">${formatDate(incidencia.fecha_reporte)}</div>
                        ${incidencia.fecha_cierre ? `<div class="text-gray-500 text-xs">Cerrada: ${formatDate(incidencia.fecha_cierre)}</div>` : ''}
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <div class="font-medium">${escapeHtml(tecnicoAsignado)}</div>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <div class="flex space-x-2">
                            <button class="view-btn bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-lg transition duration-300 text-xs" 
                                data-id="${incidencia.id_incidencia}"
                                title="Ver detalles">
                                Ver
                            </button>
                            <button class="edit-btn bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg transition duration-300 text-xs" 
                                data-id="${incidencia.id_incidencia}"
                                title="Editar incidencia">
                                Editar
                            </button>
                            <button class="delete-btn bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg transition duration-300 text-xs" 
                                data-id="${incidencia.id_incidencia}"
                                data-titulo="${escapeHtml(incidencia.titulo)}"
                                title="Eliminar incidencia">
                                Eliminar
                            </button>
                        </div>
                    </td>
                `;
                incidenciasTableBody.appendChild(row);
            });
        } else {
            incidenciasTableContainer.classList.add('hidden');
            if (Object.values(currentFilters).some(filter => filter)) {
                noSearchResults.classList.remove('hidden');
                noDataMessage.classList.add('hidden');
            } else {
                noDataMessage.classList.remove('hidden');
                noSearchResults.classList.add('hidden');
            }
        }
    }

    // Función para renderizar estadísticas
    function renderStats(stats) {
        if (!stats) {
            statsContainer.classList.add('hidden');
            return;
        }

        statsContainer.innerHTML = '';
        
        // Tarjeta de total
        const totalCard = `
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Incidencias</p>
                        <p class="text-2xl font-bold text-gray-900">${stats.total}</p>
                    </div>
                </div>
            </div>
        `;

        // Tarjetas por estado
        const estadoCards = stats.por_estado ? stats.por_estado.map(estado => {
            const colors = {
                'abierta': { bg: 'bg-red-100', text: 'text-red-600' },
                'en_proceso': { bg: 'bg-yellow-100', text: 'text-yellow-600' },
                'cerrada': { bg: 'bg-green-100', text: 'text-green-600' },
                'cancelada': { bg: 'bg-gray-100', text: 'text-gray-600' }
            };
            const color = colors[estado.estado] || { bg: 'bg-gray-100', text: 'text-gray-600' };
            
            return `
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-2 ${color.bg} rounded-lg">
                            <svg class="w-6 h-6 ${color.text}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">${estado.estado.replace('_', ' ').toUpperCase()}</p>
                            <p class="text-2xl font-bold text-gray-900">${estado.count}</p>
                        </div>
                    </div>
                </div>
            `;
        }).join('') : '';

        statsContainer.innerHTML = totalCard + estadoCards;
        statsContainer.classList.remove('hidden');
    }

    // Función para cargar tipos de incidencia
    async function loadTiposIncidencia() {
        try {
            const response = await fetch(API_URL + '?action=tipos');
            if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
            
            const result = await response.json();
            tiposIncidencia = result.tipos || [];
            
            // Llenar select de filtros
            filterTipo.innerHTML = '<option value="">Todos los tipos</option>';
            tiposIncidencia.forEach(tipo => {
                filterTipo.innerHTML += `<option value="${tipo.id_tipo_incidencia}">${escapeHtml(tipo.nombre)}</option>`;
            });
            
            // Llenar select del modal
            const modalTipoSelect = document.getElementById('incidencia-tipo');
            modalTipoSelect.innerHTML = '<option value="">Seleccionar tipo...</option>';
            tiposIncidencia.forEach(tipo => {
                modalTipoSelect.innerHTML += `<option value="${tipo.id_tipo_incidencia}">${escapeHtml(tipo.nombre)}</option>`;
            });
            
        } catch (error) {
            console.error('Error al cargar tipos:', error);
        }
    }

    // Función para cargar técnicos
    async function loadTecnicos() {
        try {
            const response = await fetch(API_URL + '?action=tecnicos');
            if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
            
            const result = await response.json();
            tecnicos = result.tecnicos || [];
            
            // Llenar select del modal
            const modalTecnicoSelect = document.getElementById('incidencia-tecnico');
            modalTecnicoSelect.innerHTML = '<option value="">Sin asignar</option>';
            tecnicos.forEach(tecnico => {
                modalTecnicoSelect.innerHTML += `<option value="${tecnico.id_usuario}">${escapeHtml(tecnico.nombre_completo)}</option>`;
            });
            
        } catch (error) {
            console.error('Error al cargar técnicos:', error);
        }
    }

    // Función para cargar estadísticas
    async function loadStats() {
        try {
            const response = await fetch(API_URL + '?action=stats');
            if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
            
            const result = await response.json();
            renderStats(result.stats);
            
        } catch (error) {
            console.error('Error al cargar estadísticas:', error);
        }
    }

    // Función para cargar incidencias
    async function fetchIncidencias() {
        setLoading(true);
        
        try {
            const response = await fetch(API_URL);
            if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
            
            const result = await response.json();
            allIncidencias = result.records || [];
            filterIncidencias();
            
        } catch (error) {
            console.error('Error al cargar incidencias:', error);
            showToast('Error al cargar las incidencias. Revise su conexión.', 'error');
            allIncidencias = [];
            filteredIncidencias = [];
            renderIncidencias(filteredIncidencias);
        } finally {
            setLoading(false);
        }
    }

    // Event listeners para filtros y búsqueda
    searchInput.addEventListener('input', () => {
        currentFilters.search = searchInput.value;
        filterIncidencias();
        clearSearchBtn.classList.toggle('hidden', !currentFilters.search);
    });

    clearSearchBtn.addEventListener('click', () => {
        searchInput.value = '';
        currentFilters.search = '';
        filterIncidencias();
        clearSearchBtn.classList.add('hidden');
    });

    filterEstado.addEventListener('change', () => {
        currentFilters.estado = filterEstado.value;
        filterIncidencias();
    });

    filterPrioridad.addEventListener('change', () => {
        currentFilters.prioridad = filterPrioridad.value;
        filterIncidencias();
    });

    filterTipo.addEventListener('change', () => {
        currentFilters.tipo = filterTipo.value;
        filterIncidencias();
    });

    clearFiltersBtn.addEventListener('click', () => {
        searchInput.value = '';
        filterEstado.value = '';
        filterPrioridad.value = '';
        filterTipo.value = '';
        currentFilters = { search: '', estado: '', prioridad: '', tipo: '' };
        filterIncidencias();
        clearSearchBtn.classList.add('hidden');
    });

    // Event listeners para modales
    addIncidenciaBtn.addEventListener('click', () => {
        incidenciaForm.reset();
        incidenciaIdInput.value = '';
        modalTitle.textContent = 'Nueva Incidencia';
        incidenciaModal.classList.remove('hidden');
        incidenciaModal.classList.add('flex');
    });

    closeIncidenciaModalBtn.addEventListener('click', () => {
        incidenciaModal.classList.add('hidden');
        incidenciaModal.classList.remove('flex');
    });

    cancelDeleteBtn.addEventListener('click', () => {
        deleteConfirmModal.classList.add('hidden');
        deleteConfirmModal.classList.remove('flex');
    });

    // Event listeners para acciones de tabla
    incidenciasTableBody.addEventListener('click', async (e) => {
        if (e.target.classList.contains('edit-btn')) {
            const id = e.target.dataset.id;
            await loadIncidenciaForEdit(id);
        }

        if (e.target.classList.contains('delete-btn')) {
            incidenciaIdToDelete = e.target.dataset.id;
            deleteConfirmModal.classList.remove('hidden');
            deleteConfirmModal.classList.add('flex');
        }

        if (e.target.classList.contains('view-btn')) {
            const id = e.target.dataset.id;
            await viewIncidenciaDetails(id);
        }
    });

    // Función para cargar incidencia para editar
    async function loadIncidenciaForEdit(id) {
        try {
            const response = await fetch(`${API_URL}?action=single&id=${id}`);
            if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
            
            const result = await response.json();
            const incidencia = result.incidencia;
            
            if (incidencia) {
                incidenciaIdInput.value = incidencia.id_incidencia;
                document.getElementById('incidencia-titulo').value = incidencia.titulo || '';
                document.getElementById('incidencia-descripcion').value = incidencia.descripcion || '';
                document.getElementById('incidencia-tipo').value = incidencia.id_tipo_incidencia || '';
                document.getElementById('incidencia-nombre-reporta').value = incidencia.nombre_reporta || '';
                document.getElementById('incidencia-email-reporta').value = incidencia.email_reporta || '';
                document.getElementById('incidencia-estado').value = incidencia.estado || 'abierta';
                document.getElementById('incidencia-prioridad').value = incidencia.prioridad || 'media';
                document.getElementById('incidencia-tecnico').value = incidencia.id_usuario_tecnico || '';
                document.getElementById('incidencia-solucion').value = incidencia.respuesta_solucion || '';
                
                modalTitle.textContent = 'Editar Incidencia';
                incidenciaModal.classList.remove('hidden');
                incidenciaModal.classList.add('flex');
            }
        } catch (error) {
            console.error('Error al cargar incidencia:', error);
            showToast('Error al cargar la incidencia', 'error');
        }
    }

    // Función para ver detalles (simple alert por ahora)
    async function viewIncidenciaDetails(id) {
        try {
            const response = await fetch(`${API_URL}?action=single&id=${id}`);
            if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
            
            const result = await response.json();
            const incidencia = result.incidencia;
            
            if (incidencia) {
                const details = `
ID: #${incidencia.id_incidencia}
Título: ${incidencia.titulo}
Descripción: ${incidencia.descripcion}
Estado: ${incidencia.estado}
Prioridad: ${incidencia.prioridad}
Fecha: ${formatDate(incidencia.fecha_reporte)}
${incidencia.respuesta_solucion ? `\nSolución: ${incidencia.respuesta_solucion}` : ''}
                `;
                alert(details);
            }
        } catch (error) {
            console.error('Error al ver incidencia:', error);
            showToast('Error al cargar la incidencia', 'error');
        }
    }

    // Manejo del formulario
    incidenciaForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = {
            titulo: document.getElementById('incidencia-titulo').value.trim(),
            descripcion: document.getElementById('incidencia-descripcion').value.trim(),
            id_tipo_incidencia: document.getElementById('incidencia-tipo').value || null,
            nombre_reporta: document.getElementById('incidencia-nombre-reporta').value.trim(),
            email_reporta: document.getElementById('incidencia-email-reporta').value.trim(),
            estado: document.getElementById('incidencia-estado').value,
            prioridad: document.getElementById('incidencia-prioridad').value,
            id_usuario_tecnico: document.getElementById('incidencia-tecnico').value || null,
            respuesta_solucion: document.getElementById('incidencia-solucion').value.trim()
        };

        const isEdit = incidenciaIdInput.value;
        if (isEdit) {
            formData.id_incidencia = parseInt(incidenciaIdInput.value);
        }

        // Validaciones
        if (!formData.titulo) {
            showToast('El título es requerido', 'error');
            return;
        }
        if (!formData.descripcion) {
            showToast('La descripción es requerida', 'error');
            return;
        }

        saveBtnText.textContent = '';
        saveBtnLoading.classList.remove('hidden');
        saveBtn.disabled = true;

        try {
            const method = isEdit ? 'PUT' : 'POST';
            const response = await fetch(API_URL, {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (response.ok) {
                incidenciaModal.classList.add('hidden');
                incidenciaModal.classList.remove('flex');
                await fetchIncidencias();
                await loadStats();
                showToast(result.message || 'Operación realizada con éxito', 'success');
            } else {
                showToast(result.message || 'Error en la operación', 'error');
            }
        } catch (error) {
            console.error('Error al guardar:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            saveBtnText.textContent = isEdit ? 'Actualizar' : 'Guardar';
            saveBtnLoading.classList.add('hidden');
            saveBtn.disabled = false;
        }
    });

    // Función para eliminar
    confirmDeleteBtn.addEventListener('click', async () => {
        if (!incidenciaIdToDelete) return;

        deleteBtnText.textContent = '';
        deleteBtnLoading.classList.remove('hidden');
        confirmDeleteBtn.disabled = true;

        try {
            const response = await fetch(API_URL, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_incidencia: parseInt(incidenciaIdToDelete) })
            });

            const result = await response.json();

            if (response.ok) {
                deleteConfirmModal.classList.add('hidden');
                deleteConfirmModal.classList.remove('flex');
                await fetchIncidencias();
                await loadStats();
                showToast(result.message || 'Incidencia eliminada con éxito', 'success');
            } else {
                showToast(result.message || 'Error al eliminar', 'error');
            }
        } catch (error) {
            console.error('Error al eliminar:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            deleteBtnText.textContent = 'Eliminar';
            deleteBtnLoading.classList.add('hidden');
            confirmDeleteBtn.disabled = false;
            incidenciaIdToDelete = null;
        }
    });

    // Inicializar la aplicación
    async function init() {
        await Promise.all([
            loadTiposIncidencia(),
            loadTecnicos(),
            fetchIncidencias(),
            loadStats()
        ]);
    }

    // Cargar datos al iniciar
    init();
</script>

<?php
include '../includes/footer.php';
?>