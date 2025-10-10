<?php
include '../includes/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Roles de Usuario</h1>
        
        <!-- Barra de búsqueda y botón agregar -->
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:w-80">
                <input 
                    type="text" 
                    id="search-input" 
                    placeholder="Buscar roles..." 
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
            
            <button id="add-rol-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 whitespace-nowrap">
                + Agregar Rol
            </button>
        </div>
    </div>

    <!-- Indicadores de búsqueda -->
    <div id="search-info" class="hidden mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
        <div class="flex items-center justify-between">
            <span id="search-results-text" class="text-sm text-blue-800"></span>
            <button id="reset-search" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Ver todos los roles
            </button>
        </div>
    </div>

    <!-- Indicador de carga -->
    <div id="loading" class="hidden text-center py-8">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Cargando roles...</p>
    </div>

    <!-- Tabla de roles -->
    <div id="roles-table-container" class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nombre del Rol
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Estado
                    </th> 
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody id="roles-table-body" class="text-gray-700">
                <!-- Los datos se llenarán aquí con JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Mensaje cuando no hay datos -->
    <div id="no-data-message" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay roles registrados</h3>
        <p class="text-gray-500 mb-4">Comienza agregando tu primer rol haciendo clic en el botón "Agregar Rol".</p>
    </div>

    <!-- Mensaje cuando no hay resultados de búsqueda -->
    <div id="no-search-results" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron resultados</h3>
        <p class="text-gray-500 mb-4">No hay roles que coincidan con tu búsqueda. Intenta con otros términos.</p>
        <button id="clear-search-from-message" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Limpiar búsqueda
        </button>
    </div>
</div>

<!-- Modal para agregar/editar roles -->
<div id="rol-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md mx-4">
        <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-6"></h2>
        <form id="rol-form">
            <input type="hidden" id="rol-id">
            <div class="mb-4">
                <label for="rol-nombre" class="block text-gray-700 font-semibold mb-2">
                    Nombre del Rol <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="rol-nombre" 
                    maxlength="20"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                    placeholder="Ej: admin, tecnico, usuario"
                    pattern="[a-zA-Z0-9_]+"
                    title="Solo letras, números y guiones bajos">
                <small class="text-gray-500">Máximo 20 caracteres. Solo letras, números y guiones bajos.</small>
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
            <p class="mb-6 text-gray-600">¿Estás seguro de que deseas eliminar este rol? Esta acción no se puede deshacer.</p>
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
    const API_URL = '../api/controllers/rol_usuario.php';
    
    // Variables globales
    let allRoles = []; 
    let filteredRoles = []; 
    let currentSearchTerm = ''; 
    
    // Elementos del DOM
    const rolesTableBody = document.getElementById('roles-table-body');
    const rolesTableContainer = document.getElementById('roles-table-container');
    const noDataMessage = document.getElementById('no-data-message');
    const noSearchResults = document.getElementById('no-search-results');
    const loadingIndicator = document.getElementById('loading');
    const searchInput = document.getElementById('search-input');
    const clearSearchBtn = document.getElementById('clear-search');
    const searchInfo = document.getElementById('search-info');
    const searchResultsText = document.getElementById('search-results-text');
    const resetSearchBtn = document.getElementById('reset-search');
    const clearSearchFromMessageBtn = document.getElementById('clear-search-from-message');
    
    // Elementos de los modales
    const addRolBtn = document.getElementById('add-rol-btn');
    const rolModal = document.getElementById('rol-modal');
    const closeRolModalBtn = document.getElementById('close-modal-btn');
    const modalTitle = document.getElementById('modal-title');
    const rolForm = document.getElementById('rol-form');
    const rolIdInput = document.getElementById('rol-id');
    const rolNombreInput = document.getElementById('rol-nombre');
    const saveBtn = document.getElementById('save-btn');
    const saveBtnText = document.getElementById('save-btn-text');
    const saveBtnLoading = document.getElementById('save-btn-loading');
    const deleteConfirmModal = document.getElementById('delete-confirm-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const deleteBtnText = document.getElementById('delete-btn-text');
    const deleteBtnLoading = document.getElementById('delete-btn-loading');
    let rolIdToDelete = null;

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
        rolesTableContainer.classList.toggle('hidden', show);
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
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    // Función para filtrar roles
    function filterRoles(searchTerm) {
        if (!searchTerm.trim()) {
            return allRoles;
        }
        
        const term = searchTerm.toLowerCase().trim();
        return allRoles.filter(rol => {
            return rol.nombre_rol.toLowerCase().includes(term);
        });
    }

    // Función para actualizar la información de búsqueda
    function updateSearchInfo() {
        if (currentSearchTerm) {
            const count = filteredRoles.length;
            searchResultsText.textContent = `Mostrando ${count} resultado${count !== 1 ? 's' : ''} para "${currentSearchTerm}"`;
            searchInfo.classList.remove('hidden');
        } else {
            searchInfo.classList.add('hidden');
        }
    }

    // Función para renderizar los roles en la tabla
    function renderRoles(roles) {
        rolesTableBody.innerHTML = '';
        
        if (roles.length > 0) {
            rolesTableContainer.classList.remove('hidden');
            noDataMessage.classList.add('hidden');
            noSearchResults.classList.add('hidden');
            
            roles.forEach(rol => {
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-100', 'transition', 'duration-150', 'ease-in-out', 'border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="px-5 py-5 text-sm">${rol.id_rol}</td>
                    <td class="px-5 py-5 text-sm font-medium">
                        <span class="capitalize">${escapeHtml(rol.nombre_rol)}</span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                            Activo
                        </span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <div class="flex space-x-2">
                            <button class="edit-btn bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg transition duration-300" 
                                data-id="${rol.id_rol}" 
                                data-nombre="${escapeHtml(rol.nombre_rol)}"
                                title="Editar rol">
                                Editar
                            </button>
                            <button class="delete-btn bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg transition duration-300" 
                                data-id="${rol.id_rol}"
                                data-nombre="${escapeHtml(rol.nombre_rol)}"
                                title="Eliminar rol">
                                Eliminar
                            </button>
                        </div>
                    </td>
                `;
                rolesTableBody.appendChild(row);
            });
        } else {
            rolesTableContainer.classList.add('hidden');
            if (currentSearchTerm) {
                noSearchResults.classList.remove('hidden');
                noDataMessage.classList.add('hidden');
            } else {
                noDataMessage.classList.remove('hidden');
                noSearchResults.classList.add('hidden');
            }
        }
        
        updateSearchInfo();
    }

    // Función para realizar búsqueda
    function performSearch() {
        currentSearchTerm = searchInput.value;
        filteredRoles = filterRoles(currentSearchTerm);
        renderRoles(filteredRoles);
        
        // Mostrar/ocultar botón de limpiar búsqueda
        clearSearchBtn.classList.toggle('hidden', !currentSearchTerm);
    }

    // Función para limpiar búsqueda
    function clearSearch() {
        searchInput.value = '';
        currentSearchTerm = '';
        filteredRoles = allRoles;
        renderRoles(filteredRoles);
        clearSearchBtn.classList.add('hidden');
        searchInput.focus();
    }

    // Event listeners para búsqueda
    searchInput.addEventListener('input', performSearch);
    searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            clearSearch();
        }
    });
    clearSearchBtn.addEventListener('click', clearSearch);
    resetSearchBtn.addEventListener('click', clearSearch);
    clearSearchFromMessageBtn.addEventListener('click', clearSearch);

    // Carga los roles desde la API
    async function fetchRoles() {
        setLoading(true);
        
        try {
            const response = await fetch(API_URL, { method: 'GET' });
            
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            
            const result = await response.json();
            
            if (result.records && Array.isArray(result.records)) {
                allRoles = result.records;
                filteredRoles = filterRoles(currentSearchTerm);
                renderRoles(filteredRoles);
            } else {
                allRoles = [];
                filteredRoles = [];
                renderRoles(filteredRoles);
            }
        } catch (error) {
            console.error('Error al cargar los roles:', error);
            showToast('Error al cargar los roles. Revise su conexión.', 'error');
            allRoles = [];
            filteredRoles = [];
            renderRoles(filteredRoles);
        } finally {
            setLoading(false);
        }
    }

    // Funciones de modal
    function toggleModal(show, title = '') {
        rolModal.classList.toggle('hidden', !show);
        rolModal.classList.toggle('flex', show);
        if (show) {
            modalTitle.textContent = title;
            rolNombreInput.focus();
        }
    }

    function toggleDeleteModal(show) {
        deleteConfirmModal.classList.toggle('hidden', !show);
        deleteConfirmModal.classList.toggle('flex', show);
    }

    // Event listeners para modales
    closeRolModalBtn.addEventListener('click', () => toggleModal(false));
    cancelDeleteBtn.addEventListener('click', () => toggleDeleteModal(false));
    rolModal.addEventListener('click', (e) => {
        if (e.target === rolModal) toggleModal(false);
    });
    deleteConfirmModal.addEventListener('click', (e) => {
        if (e.target === deleteConfirmModal) toggleDeleteModal(false);
    });

    // Maneja el envío del formulario
    rolForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nombre = rolNombreInput.value.trim();
        const rolId = rolIdInput.value;

        if (!nombre) {
            showToast('El nombre del rol es requerido', 'error');
            rolNombreInput.focus();
            return;
        }

        if (nombre.length > 20) {
            showToast('El nombre no puede exceder 20 caracteres', 'error');
            rolNombreInput.focus();
            return;
        }

        // Validar formato
        if (!/^[a-zA-Z0-9_]+$/.test(nombre)) {
            showToast('El nombre solo puede contener letras, números y guiones bajos', 'error');
            rolNombreInput.focus();
            return;
        }

        setButtonLoading(saveBtnText, saveBtnLoading, true, rolId ? 'Actualizar' : 'Guardar');
        saveBtn.disabled = true;

        const method = rolId ? 'PUT' : 'POST';
        const data = { nombre_rol: nombre };
        if (rolId) data.id_rol = parseInt(rolId);

        try {
            const response = await fetch(API_URL, {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                toggleModal(false);
                await fetchRoles();
                showToast(result.message || 'Operación realizada con éxito', 'success');
            } else {
                showToast(result.message || 'Error en la operación', 'error');
            }
        } catch (error) {
            console.error('Error al guardar el rol:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(saveBtnText, saveBtnLoading, false, rolId ? 'Actualizar' : 'Guardar');
            saveBtn.disabled = false;
        }
    });

    // Maneja los clics en los botones de la tabla
    rolesTableBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('edit-btn')) {
            const btn = e.target;
            rolIdInput.value = btn.dataset.id;
            rolNombreInput.value = btn.dataset.nombre;
            toggleModal(true, 'Editar Rol');
        }

        if (e.target.classList.contains('delete-btn')) {
            rolIdToDelete = e.target.dataset.id;
            toggleDeleteModal(true);
        }
    });

    // Botón agregar rol
    addRolBtn.addEventListener('click', () => {
        rolForm.reset();
        rolIdInput.value = '';
        toggleModal(true, 'Agregar Nuevo Rol');
    });

    // Función para eliminar rol
    async function deleteRol(rolId) {
        setButtonLoading(deleteBtnText, deleteBtnLoading, true, 'Eliminar');
        confirmDeleteBtn.disabled = true;

        try {
            const response = await fetch(API_URL, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_rol: parseInt(rolId) })
            });

            const result = await response.json();

            if (response.ok) {
                await fetchRoles();
                showToast(result.message || 'Rol eliminado con éxito', 'success');
                toggleDeleteModal(false);
            } else {
                if (result.code === 'ROL_IN_USE') {
                    showToast('No se puede eliminar: El rol está siendo usado por usuarios activos', 'error');
                } else {
                    showToast(result.message || 'Error al eliminar el rol', 'error');
                }
            }
        } catch (error) {
            console.error('Error al eliminar el rol:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(deleteBtnText, deleteBtnLoading, false, 'Eliminar');
            confirmDeleteBtn.disabled = false;
        }
    }

    // Confirmar eliminación
    confirmDeleteBtn.addEventListener('click', () => {
        if (rolIdToDelete) {
            deleteRol(rolIdToDelete);
            rolIdToDelete = null;
        }
    });

    // Cargar roles al iniciar
    fetchRoles();
</script>

<?php
include '../includes/footer.php';
?>