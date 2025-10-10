<?php
include '../includes/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Usuarios</h1>
        
        <!-- Filtros y botón agregar -->
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <!-- Filtro por rol -->
            <select id="rol-filter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Todos los roles</option>
                <!-- Los roles se llenarán dinámicamente -->
            </select>

            <!-- Filtro por estado -->
            <select id="estado-filter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Todos los estados</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
            
            <!-- Barra de búsqueda -->
            <div class="relative flex-1 md:w-80">
                <input 
                    type="text" 
                    id="search-input" 
                    placeholder="Buscar por nombre o username..." 
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
            
            <button id="add-usuario-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 whitespace-nowrap">
                + Agregar Usuario
            </button>
        </div>
    </div>

    <!-- Indicadores de búsqueda -->
    <div id="search-info" class="hidden mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
        <div class="flex items-center justify-between">
            <span id="search-results-text" class="text-sm text-blue-800"></span>
            <button id="reset-filters" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Limpiar filtros
            </button>
        </div>
    </div>

    <!-- Indicador de carga -->
    <div id="loading" class="hidden text-center py-8">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Cargando usuarios...</p>
    </div>

    <!-- Tabla de usuarios -->
    <div id="usuarios-table-container" class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nombre Completo
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Username
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Rol
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Área
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Estado
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody id="usuarios-table-body" class="text-gray-700">
                    <!-- Los datos se llenarán aquí con JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mensaje cuando no hay datos -->
    <div id="no-data-message" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay usuarios registrados</h3>
        <p class="text-gray-500 mb-4">Comienza agregando tu primer usuario haciendo clic en el botón "Agregar Usuario".</p>
    </div>

    <!-- Mensaje cuando no hay resultados de búsqueda -->
    <div id="no-search-results" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron resultados</h3>
        <p class="text-gray-500 mb-4">No hay usuarios que coincidan con tu búsqueda. Intenta con otros términos.</p>
        <button id="clear-search-from-message" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Limpiar filtros
        </button>
    </div>
</div>

<!-- Modal para agregar/editar usuarios -->
<div id="usuario-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-lg mx-4 max-h-screen overflow-y-auto">
        <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-6"></h2>
        <form id="usuario-form">
            <input type="hidden" id="usuario-id">
            
            <!-- Nombre completo -->
            <div class="mb-4">
                <label for="usuario-nombre" class="block text-gray-700 font-semibold mb-2">
                    Nombre Completo <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="usuario-nombre" 
                    maxlength="100"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                    placeholder="Ej: Juan Pérez García">
                <small class="text-gray-500">Máximo 100 caracteres</small>
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="usuario-username" class="block text-gray-700 font-semibold mb-2">
                    Username <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="usuario-username" 
                    maxlength="50"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                    placeholder="Ej: jperez">
                <small class="text-gray-500">Máximo 50 caracteres. Debe ser único.</small>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="usuario-password" class="block text-gray-700 font-semibold mb-2">
                    Contraseña <span id="password-required" class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="usuario-password" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Contraseña del usuario">
                <small id="password-help" class="text-gray-500">Requerida para usuarios nuevos. Déjala vacía para mantener la actual al editar.</small>
            </div>

            <!-- Rol -->
            <div class="mb-4">
                <label for="usuario-rol" class="block text-gray-700 font-semibold mb-2">
                    Rol <span class="text-red-500">*</span>
                </label>
                <select 
                    id="usuario-rol" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
                    <option value="">Seleccione un rol...</option>
                    <!-- Los roles se llenarán dinámicamente -->
                </select>
            </div>

            <!-- Área -->
            <div class="mb-4">
                <label for="usuario-area" class="block text-gray-700 font-semibold mb-2">
                    Área
                </label>
                <select 
                    id="usuario-area" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Sin área asignada</option>
                    <!-- Las áreas se llenarán dinámicamente -->
                </select>
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label for="usuario-estado" class="block text-gray-700 font-semibold mb-2">
                    Estado <span class="text-red-500">*</span>
                </label>
                <select 
                    id="usuario-estado" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>

            <!-- Botones -->
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
            <p class="mb-6 text-gray-600">¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>
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
    const API_URL = '../api/controllers/usuario.php';
    
    // Variables globales
    let allUsuarios = []; 
    let allRoles = [];
    let allAreas = [];
    let filteredUsuarios = []; 
    let currentSearchTerm = ''; 
    let currentRolFilter = '';
    let currentEstadoFilter = '';
    
    // Elementos del DOM
    const usuariosTableBody = document.getElementById('usuarios-table-body');
    const usuariosTableContainer = document.getElementById('usuarios-table-container');
    const noDataMessage = document.getElementById('no-data-message');
    const noSearchResults = document.getElementById('no-search-results');
    const loadingIndicator = document.getElementById('loading');
    const searchInput = document.getElementById('search-input');
    const clearSearchBtn = document.getElementById('clear-search');
    const rolFilter = document.getElementById('rol-filter');
    const estadoFilter = document.getElementById('estado-filter');
    const searchInfo = document.getElementById('search-info');
    const searchResultsText = document.getElementById('search-results-text');
    const resetFiltersBtn = document.getElementById('reset-filters');
    const clearSearchFromMessageBtn = document.getElementById('clear-search-from-message');
    
    // Elementos de los modales
    const addUsuarioBtn = document.getElementById('add-usuario-btn');
    const usuarioModal = document.getElementById('usuario-modal');
    const closeUsuarioModalBtn = document.getElementById('close-modal-btn');
    const modalTitle = document.getElementById('modal-title');
    const usuarioForm = document.getElementById('usuario-form');
    const usuarioIdInput = document.getElementById('usuario-id');
    const usuarioNombreInput = document.getElementById('usuario-nombre');
    const usuarioUsernameInput = document.getElementById('usuario-username');
    const usuarioPasswordInput = document.getElementById('usuario-password');
    const usuarioRolInput = document.getElementById('usuario-rol');
    const usuarioAreaInput = document.getElementById('usuario-area');
    const usuarioEstadoInput = document.getElementById('usuario-estado');
    const saveBtn = document.getElementById('save-btn');
    const saveBtnText = document.getElementById('save-btn-text');
    const saveBtnLoading = document.getElementById('save-btn-loading');
    const passwordRequired = document.getElementById('password-required');
    const passwordHelp = document.getElementById('password-help');
    
    const deleteConfirmModal = document.getElementById('delete-confirm-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const deleteBtnText = document.getElementById('delete-btn-text');
    const deleteBtnLoading = document.getElementById('delete-btn-loading');
    let usuarioIdToDelete = null;

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
        usuariosTableContainer.classList.toggle('hidden', show);
        noDataMessage.classList.add('hidden');
        noSearchResults.classList.add('hidden');
    }

    // Función para mostrar/ocultar loading en botones
    function setButtonLoading(btnText, btnLoading, show, originalText = 'Guardar') {
        btnText.textContent = show ? '' : originalText;
        btnLoading.classList.toggle('hidden', !show);
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

    // Función para filtrar usuarios
    function filterUsuarios(searchTerm, rolId, estado) {
        let filtered = allUsuarios;
        
        // Filtrar por rol si se seleccionó uno
        if (rolId) {
            filtered = filtered.filter(usuario => usuario.ID_ROL_USUARIO.toString() === rolId);
        }
        
        // Filtrar por estado si se seleccionó uno
        if (estado) {
            filtered = filtered.filter(usuario => usuario.estado === estado);
        }
        
        // Filtrar por término de búsqueda si existe
        if (searchTerm && searchTerm.trim()) {
            const term = searchTerm.toLowerCase().trim();
            filtered = filtered.filter(usuario => {
                return usuario.nombre_completo.toLowerCase().includes(term) ||
                       usuario.username.toLowerCase().includes(term);
            });
        }
        
        return filtered;
    }

    // Función para actualizar la información de búsqueda
    function updateSearchInfo() {
        if (currentSearchTerm || currentRolFilter || currentEstadoFilter) {
            const count = filteredUsuarios.length;
            let message = `Mostrando ${count} resultado${count !== 1 ? 's' : ''}`;
            
            const filters = [];
            if (currentSearchTerm) filters.push(`"${currentSearchTerm}"`);
            if (currentRolFilter) {
                const rolNombre = allRoles.find(r => r.id_rol.toString() === currentRolFilter)?.nombre_rol || '';
                filters.push(`rol: ${rolNombre}`);
            }
            if (currentEstadoFilter) filters.push(`estado: ${currentEstadoFilter}`);
            
            if (filters.length > 0) {
                message += ` para ${filters.join(', ')}`;
            }
            
            searchResultsText.textContent = message;
            searchInfo.classList.remove('hidden');
        } else {
            searchInfo.classList.add('hidden');
        }
    }

    // Función para renderizar los usuarios en la tabla
    function renderUsuarios(usuarios) {
        usuariosTableBody.innerHTML = '';
        
        if (usuarios.length > 0) {
            usuariosTableContainer.classList.remove('hidden');
            noDataMessage.classList.add('hidden');
            noSearchResults.classList.add('hidden');
            
            usuarios.forEach(usuario => {
                const estadoBadge = usuario.estado === 'activo' 
                    ? 'bg-green-100 text-green-800' 
                    : 'bg-red-100 text-red-800';
                
                const rolBadge = getRolBadgeColor(usuario.nombre_rol);
                
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-50', 'transition', 'duration-150', 'ease-in-out', 'border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="px-5 py-5 text-sm">${usuario.id_usuario}</td>
                    <td class="px-5 py-5 text-sm font-medium">${escapeHtml(usuario.nombre_completo)}</td>
                    <td class="px-5 py-5 text-sm font-mono">${escapeHtml(usuario.username)}</td>
                    <td class="px-5 py-5 text-sm">
                        <span class="${rolBadge} px-2 py-1 rounded-full text-xs font-medium capitalize">
                            ${escapeHtml(usuario.nombre_rol || 'Sin rol')}
                        </span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        ${usuario.nombre_area ? 
                            `<span class="text-gray-600">${escapeHtml(usuario.nombre_area)}</span><br>
                             <small class="text-gray-400">${escapeHtml(usuario.nombre_sede || '')}</small>` 
                            : '<span class="text-gray-400">Sin área</span>'}
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <span class="${estadoBadge} px-2 py-1 rounded-full text-xs font-medium capitalize">
                            ${usuario.estado}
                        </span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <div class="flex space-x-2">
                            <button class="edit-btn bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg transition duration-300 text-xs" 
                                data-id="${usuario.id_usuario}" 
                                data-nombre="${escapeHtml(usuario.nombre_completo)}" 
                                data-username="${escapeHtml(usuario.username)}"
                                data-rol="${usuario.ID_ROL_USUARIO}"
                                data-area="${usuario.id_area || ''}"
                                data-estado="${usuario.estado}"
                                title="Editar usuario">
                                Editar
                            </button>
                            <button class="delete-btn bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg transition duration-300 text-xs" 
                                data-id="${usuario.id_usuario}"
                                data-nombre="${escapeHtml(usuario.nombre_completo)}"
                                title="Eliminar usuario">
                                Eliminar
                            </button>
                        </div>
                    </td>
                `;
                usuariosTableBody.appendChild(row);
            });
        } else {
            usuariosTableContainer.classList.add('hidden');
            if (currentSearchTerm || currentRolFilter || currentEstadoFilter) {
                noSearchResults.classList.remove('hidden');
                noDataMessage.classList.add('hidden');
            } else {
                noDataMessage.classList.remove('hidden');
                noSearchResults.classList.add('hidden');
            }
        }
        
        updateSearchInfo();
    }

    // Función para obtener color de badge del rol
    function getRolBadgeColor(rol) {
        switch(rol) {
            case 'admin': return 'bg-purple-100 text-purple-800';
            case 'tecnico': return 'bg-blue-100 text-blue-800';
            case 'usuario': return 'bg-gray-100 text-gray-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    }

    // Función para realizar búsqueda y filtrado
    function performSearch() {
        currentSearchTerm = searchInput.value;
        currentRolFilter = rolFilter.value;
        currentEstadoFilter = estadoFilter.value;
        filteredUsuarios = filterUsuarios(currentSearchTerm, currentRolFilter, currentEstadoFilter);
        renderUsuarios(filteredUsuarios);
        
        // Mostrar/ocultar botón de limpiar búsqueda
        clearSearchBtn.classList.toggle('hidden', !currentSearchTerm);
    }

    // Función para limpiar filtros
    function clearFilters() {
        searchInput.value = '';
        rolFilter.value = '';
        estadoFilter.value = '';
        currentSearchTerm = '';
        currentRolFilter = '';
        currentEstadoFilter = '';
        filteredUsuarios = allUsuarios;
        renderUsuarios(filteredUsuarios);
        clearSearchBtn.classList.add('hidden');
        searchInput.focus();
    }

    // Event listeners para filtros
    searchInput.addEventListener('input', performSearch);
    searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            clearFilters();
        }
    });
    rolFilter.addEventListener('change', performSearch);
    estadoFilter.addEventListener('change', performSearch);
    clearSearchBtn.addEventListener('click', () => {
        searchInput.value = '';
        performSearch();
    });
    resetFiltersBtn.addEventListener('click', clearFilters);
    clearSearchFromMessageBtn.addEventListener('click', clearFilters);

    // Función para cargar roles
    async function loadRoles() {
        try {
            const response = await fetch(API_URL + '?action=get_roles');
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const result = await response.json();
            
            if (result.roles && Array.isArray(result.roles)) {
                allRoles = result.roles;
                
                // Llenar select del filtro
                rolFilter.innerHTML = '<option value="">Todos los roles</option>';
                allRoles.forEach(rol => {
                    const option = document.createElement('option');
                    option.value = rol.id_rol;
                    option.textContent = rol.nombre_rol;
                    rolFilter.appendChild(option);
                });
                
                // Llenar select del modal
                usuarioRolInput.innerHTML = '<option value="">Seleccione un rol...</option>';
                allRoles.forEach(rol => {
                    const option = document.createElement('option');
                    option.value = rol.id_rol;
                    option.textContent = rol.nombre_rol;
                    usuarioRolInput.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error al cargar roles:', error);
            showToast('Error al cargar los roles', 'error');
        }
    }

    // Función para cargar áreas
            async function loadAreas() {
            try {
                const response = await fetch(API_URL + '?action=get_areas');
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                const result = await response.json();
                
                if (result.areas && Array.isArray(result.areas)) {
                    allAreas = result.areas;
                    
                    // Solo llenar select del modal (no hay filtro de área en la interfaz)
                    usuarioAreaInput.innerHTML = '<option value="">Sin área asignada</option>';
                    allAreas.forEach(area => {
                        const option = document.createElement('option');
                        option.value = area.id_area;
                        option.textContent = area.area_completa;
                        usuarioAreaInput.appendChild(option);
                    });
                    
                    console.log(`✓ ${allAreas.length} áreas cargadas correctamente`);
                } else {
                    console.warn('No se recibieron áreas en la respuesta');
                    showToast('No hay áreas disponibles', 'info');
                }
            } catch (error) {
                console.error('Error al cargar áreas:', error);
                showToast('Error al cargar las áreas', 'error');
            }
        }

    // Carga los usuarios desde la API
    async function fetchUsuarios() {
        setLoading(true);
        
        try {
            const response = await fetch(API_URL, { method: 'GET' });
            
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            
            const result = await response.json();
            
            if (result.records && Array.isArray(result.records)) {
                allUsuarios = result.records;
                filteredUsuarios = filterUsuarios(currentSearchTerm, currentRolFilter, currentEstadoFilter);
                renderUsuarios(filteredUsuarios);
            } else {
                allUsuarios = [];
                filteredUsuarios = [];
                renderUsuarios(filteredUsuarios);
            }
        } catch (error) {
            console.error('Error al cargar los usuarios:', error);
            showToast('Error al cargar los usuarios. Revise su conexión.', 'error');
            allUsuarios = [];
            filteredUsuarios = [];
            renderUsuarios(filteredUsuarios);
        } finally {
            setLoading(false);
        }
    }

    // Funciones de modal
    function toggleModal(show, title = '') {
        usuarioModal.classList.toggle('hidden', !show);
        usuarioModal.classList.toggle('flex', show);
        if (show) {
            modalTitle.textContent = title;
            usuarioNombreInput.focus();
            
            // Configurar contraseña según si es crear o editar
            const isEdit = usuarioIdInput.value !== '';
            usuarioPasswordInput.required = !isEdit;
            passwordRequired.style.display = isEdit ? 'none' : 'inline';
            passwordHelp.textContent = isEdit 
                ? 'Déjala vacía para mantener la contraseña actual.'
                : 'Requerida para usuarios nuevos.';
        }
    }

    function toggleDeleteModal(show) {
        deleteConfirmModal.classList.toggle('hidden', !show);
        deleteConfirmModal.classList.toggle('flex', show);
    }

    // Event listeners para modales
    closeUsuarioModalBtn.addEventListener('click', () => toggleModal(false));
    cancelDeleteBtn.addEventListener('click', () => toggleDeleteModal(false));
    usuarioModal.addEventListener('click', (e) => {
        if (e.target === usuarioModal) toggleModal(false);
    });
    deleteConfirmModal.addEventListener('click', (e) => {
        if (e.target === deleteConfirmModal) toggleDeleteModal(false);
    });

    // Maneja el envío del formulario
    usuarioForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nombre = usuarioNombreInput.value.trim();
        const username = usuarioUsernameInput.value.trim();
        const password = usuarioPasswordInput.value.trim();
        const rol = usuarioRolInput.value;
        const area = usuarioAreaInput.value;
        const estado = usuarioEstadoInput.value;
        const usuarioId = usuarioIdInput.value;

        // Validaciones del lado cliente
        if (!nombre) {
            showToast('El nombre completo es requerido', 'error');
            usuarioNombreInput.focus();
            return;
        }

        if (!username) {
            showToast('El username es requerido', 'error');
            usuarioUsernameInput.focus();
            return;
        }

        if (!usuarioId && !password) {
            showToast('La contraseña es requerida para usuarios nuevos', 'error');
            usuarioPasswordInput.focus();
            return;
        }

        if (!rol) {
            showToast('El rol es requerido', 'error');
            usuarioRolInput.focus();
            return;
        }

        if (nombre.length > 100) {
            showToast('El nombre no puede exceder 100 caracteres', 'error');
            usuarioNombreInput.focus();
            return;
        }

        if (username.length > 50) {
            showToast('El username no puede exceder 50 caracteres', 'error');
            usuarioUsernameInput.focus();
            return;
        }

        setButtonLoading(saveBtnText, saveBtnLoading, true, usuarioId ? 'Actualizar' : 'Guardar');
        saveBtn.disabled = true;

        const method = usuarioId ? 'PUT' : 'POST';
        const data = { 
            nombre_completo: nombre, 
            username: username,
            ID_ROL_USUARIO: parseInt(rol),
            estado: estado
        };
        
        if (password) data.password = password;
        if (area) data.id_area = parseInt(area);
        if (usuarioId) data.id_usuario = parseInt(usuarioId);

        try {
            const response = await fetch(API_URL, {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                toggleModal(false);
                await fetchUsuarios();
                showToast(result.message || 'Operación realizada con éxito', 'success');
            } else {
                showToast(result.message || 'Error en la operación', 'error');
            }
        } catch (error) {
            console.error('Error al guardar el usuario:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(saveBtnText, saveBtnLoading, false, usuarioId ? 'Actualizar' : 'Guardar');
            saveBtn.disabled = false;
        }
    });

    // Maneja los clics en los botones de la tabla
    usuariosTableBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('edit-btn')) {
            const btn = e.target;
            usuarioIdInput.value = btn.dataset.id;
            usuarioNombreInput.value = btn.dataset.nombre;
            usuarioUsernameInput.value = btn.dataset.username;
            usuarioPasswordInput.value = '';
            usuarioRolInput.value = btn.dataset.rol;
            usuarioAreaInput.value = btn.dataset.area;
            usuarioEstadoInput.value = btn.dataset.estado;
            toggleModal(true, 'Editar Usuario');
        }

        if (e.target.classList.contains('delete-btn')) {
            usuarioIdToDelete = e.target.dataset.id;
            toggleDeleteModal(true);
        }
    });

    // Botón agregar usuario
    addUsuarioBtn.addEventListener('click', () => {
        usuarioForm.reset();
        usuarioIdInput.value = '';
        usuarioEstadoInput.value = 'activo';
        toggleModal(true, 'Agregar Nuevo Usuario');
    });

    // Función para eliminar usuario
    async function deleteUsuario(usuarioId) {
        setButtonLoading(deleteBtnText, deleteBtnLoading, true, 'Eliminar');
        confirmDeleteBtn.disabled = true;

        try {
            const response = await fetch(API_URL, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_usuario: parseInt(usuarioId) })
            });

            const result = await response.json();

            if (response.ok) {
                await fetchUsuarios();
                showToast(result.message || 'Usuario eliminado con éxito', 'success');
                toggleDeleteModal(false);
            } else {
                showToast(result.message || 'Error al eliminar el usuario', 'error');
            }
        } catch (error) {
            console.error('Error al eliminar el usuario:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(deleteBtnText, deleteBtnLoading, false, 'Eliminar');
            confirmDeleteBtn.disabled = false;
        }
    }

    // Confirmar eliminación
    confirmDeleteBtn.addEventListener('click', () => {
        if (usuarioIdToDelete) {
            deleteUsuario(usuarioIdToDelete);
            usuarioIdToDelete = null;
        }
    });

    // Inicializar la aplicación
    async function init() {
        await loadRoles();
        await loadAreas();
        await fetchUsuarios();
    }

    // Cargar datos al iniciar
    init();
</script>

<?php
include '../includes/footer.php';
?>