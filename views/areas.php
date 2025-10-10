<?php
include '../includes/header.php';
?> 



<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Areas</h1>
        
        <!-- Filtros y botón agregar -->
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <!-- Filtro por sede -->
            <select id="sede-filter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Todas las sedes</option>
                <!-- Las sedes se llenarán dinámicamente -->
            </select>
            
            <!-- Barra de búsqueda -->
            <div class="relative flex-1 md:w-80">
                <input 
                    type="text" 
                    id="search-input" 
                    placeholder="Buscar por nombre de área..." 
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
            
            <button id="add-area-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 whitespace-nowrap">
                + Agregar Area
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
        <p class="mt-2 text-gray-600">Cargando areas...</p>
    </div>

    <!-- Tabla de areas -->
    <div id="areas-table-container" class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Area
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Sede
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody id="areas-table-body" class="text-gray-700">
                <!-- Los datos se llenarán aquí con JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Mensaje cuando no hay datos -->
    <div id="no-data-message" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay areas registradas</h3>
        <p class="text-gray-500 mb-4">Comienza agregando tu primera area haciendo clic en el botón "Agregar Area".</p>
    </div>

    <!-- Mensaje cuando no hay resultados de búsqueda -->
    <div id="no-search-results" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron resultados</h3>
        <p class="text-gray-500 mb-4">No hay areas que coincidan con tu búsqueda. Intenta con otros términos.</p>
        <button id="clear-search-from-message" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Limpiar filtros
        </button>
    </div>
</div>

<!-- Modal para agregar/editar areas -->
<div id="area-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md mx-4">
        <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-6"></h2>
        <form id="area-form">
            <input type="hidden" id="area-id">
            <div class="mb-4">
                <label for="area-nombre" class="block text-gray-700 font-semibold mb-2">
                    Nombre del Area <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="area-nombre" 
                    maxlength="100"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                    placeholder="Ej: Gerencia, Facturación, Piso 1">
                <small class="text-gray-500">Máximo 100 caracteres</small>
            </div>
            <div class="mb-4">
                <label for="area-sede" class="block text-gray-700 font-semibold mb-2">
                    Sede <span class="text-red-500">*</span>
                </label>
                <select 
                    id="area-sede" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
                    <option value="">Seleccione una sede...</option>
                    <!-- Las sedes se llenarán dinámicamente -->
                </select>
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
            <p class="mb-6 text-gray-600">¿Estás seguro de que deseas eliminar esta area? Esta acción no se puede deshacer.</p>
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
    const API_URL = '../api/controllers/areas.php';
    
    // Variables globales
    let allAreas = []; 
    let allSedes = [];
    let filteredAreas = []; 
    let currentSearchTerm = ''; 
    let currentSedeFilter = '';
    
    // Elementos del DOM
    const areasTableBody = document.getElementById('areas-table-body');
    const areasTableContainer = document.getElementById('areas-table-container');
    const noDataMessage = document.getElementById('no-data-message');
    const noSearchResults = document.getElementById('no-search-results');
    const loadingIndicator = document.getElementById('loading');
    const searchInput = document.getElementById('search-input');
    const clearSearchBtn = document.getElementById('clear-search');
    const sedeFilter = document.getElementById('sede-filter');
    const searchInfo = document.getElementById('search-info');
    const searchResultsText = document.getElementById('search-results-text');
    const resetFiltersBtn = document.getElementById('reset-filters');
    const clearSearchFromMessageBtn = document.getElementById('clear-search-from-message');
    
    // Elementos de los modales
    const addAreaBtn = document.getElementById('add-area-btn');
    const areaModal = document.getElementById('area-modal');
    const closeAreaModalBtn = document.getElementById('close-modal-btn');
    const modalTitle = document.getElementById('modal-title');
    const areaForm = document.getElementById('area-form');
    const areaIdInput = document.getElementById('area-id');
    const areaNombreInput = document.getElementById('area-nombre');
    const areaSedeInput = document.getElementById('area-sede');
    const saveBtn = document.getElementById('save-btn');
    const saveBtnText = document.getElementById('save-btn-text');
    const saveBtnLoading = document.getElementById('save-btn-loading');
    const deleteConfirmModal = document.getElementById('delete-confirm-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const deleteBtnText = document.getElementById('delete-btn-text');
    const deleteBtnLoading = document.getElementById('delete-btn-loading');
    let areaIdToDelete = null;

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
        areasTableContainer.classList.toggle('hidden', show);
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

    // Función para filtrar areas
    function filterAreas(searchTerm, sedeId) {
        let filtered = allAreas;
        
        // Filtrar por sede si se seleccionó una
        if (sedeId) {
            filtered = filtered.filter(area => area.id_sede.toString() === sedeId);
        }
        
        // Filtrar por término de búsqueda si existe
        if (searchTerm && searchTerm.trim()) {
            const term = searchTerm.toLowerCase().trim();
            filtered = filtered.filter(area => {
                return area.nombre_area.toLowerCase().includes(term) ||
                       (area.nombre_sede && area.nombre_sede.toLowerCase().includes(term));
            });
        }
        
        return filtered;
    }

    // Función para actualizar la información de búsqueda
    function updateSearchInfo() {
        if (currentSearchTerm || currentSedeFilter) {
            const count = filteredAreas.length;
            let message = `Mostrando ${count} resultado${count !== 1 ? 's' : ''}`;
            
            if (currentSearchTerm && currentSedeFilter) {
                const sedeNombre = allSedes.find(s => s.id_sede.toString() === currentSedeFilter)?.nombre_sede || '';
                message += ` para "${currentSearchTerm}" en "${sedeNombre}"`;
            } else if (currentSearchTerm) {
                message += ` para "${currentSearchTerm}"`;
            } else if (currentSedeFilter) {
                const sedeNombre = allSedes.find(s => s.id_sede.toString() === currentSedeFilter)?.nombre_sede || '';
                message += ` de la sede "${sedeNombre}"`;
            }
            
            searchResultsText.textContent = message;
            searchInfo.classList.remove('hidden');
        } else {
            searchInfo.classList.add('hidden');
        }
    }

    // Función para renderizar las areas en la tabla
    function renderAreas(areas) {
        areasTableBody.innerHTML = '';
        
        if (areas.length > 0) {
            areasTableContainer.classList.remove('hidden');
            noDataMessage.classList.add('hidden');
            noSearchResults.classList.add('hidden');
            
            areas.forEach(area => {
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-100', 'transition', 'duration-150', 'ease-in-out', 'border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="px-5 py-5 text-sm">${area.id_area}</td>
                    <td class="px-5 py-5 text-sm font-medium">${escapeHtml(area.nombre_area)}</td>
                    <td class="px-5 py-5 text-sm">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                            ${escapeHtml(area.nombre_sede || 'N/A')}
                        </span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <div class="flex space-x-2">
                            <button class="edit-btn bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg transition duration-300" 
                                data-id="${area.id_area}" 
                                data-nombre="${escapeHtml(area.nombre_area)}" 
                                data-sede="${area.id_sede}"
                                title="Editar area">
                                Editar
                            </button>
                            <button class="delete-btn bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg transition duration-300" 
                                data-id="${area.id_area}"
                                title="Eliminar area">
                                Eliminar
                            </button>
                        </div>
                    </td>
                `;
                areasTableBody.appendChild(row);
            });
        } else {
            areasTableContainer.classList.add('hidden');
            if (currentSearchTerm || currentSedeFilter) {
                noSearchResults.classList.remove('hidden');
                noDataMessage.classList.add('hidden');
            } else {
                noDataMessage.classList.remove('hidden');
                noSearchResults.classList.add('hidden');
            }
        }
        
        updateSearchInfo();
    }

    // Función para realizar búsqueda y filtrado
    function performSearch() {
        currentSearchTerm = searchInput.value;
        currentSedeFilter = sedeFilter.value;
        filteredAreas = filterAreas(currentSearchTerm, currentSedeFilter);
        renderAreas(filteredAreas);
        
        // Mostrar/ocultar botón de limpiar búsqueda
        clearSearchBtn.classList.toggle('hidden', !currentSearchTerm);
    }

    // Función para limpiar filtros
    function clearFilters() {
        searchInput.value = '';
        sedeFilter.value = '';
        currentSearchTerm = '';
        currentSedeFilter = '';
        filteredAreas = allAreas;
        renderAreas(filteredAreas);
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
    sedeFilter.addEventListener('change', performSearch);
    clearSearchBtn.addEventListener('click', () => {
        searchInput.value = '';
        performSearch();
    });
    resetFiltersBtn.addEventListener('click', clearFilters);
    clearSearchFromMessageBtn.addEventListener('click', clearFilters);

    // Función para cargar sedes
    async function loadSedes() {
        try {
            const response = await fetch(API_URL + '?action=get_sedes');
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const result = await response.json();
            
            if (result.sedes && Array.isArray(result.sedes)) {
                allSedes = result.sedes;
                
                // Llenar select del filtro
                sedeFilter.innerHTML = '<option value="">Todas las sedes</option>';
                allSedes.forEach(sede => {
                    const option = document.createElement('option');
                    option.value = sede.id_sede;
                    option.textContent = sede.nombre_sede;
                    sedeFilter.appendChild(option);
                });
                
                // Llenar select del modal
                areaSedeInput.innerHTML = '<option value="">Seleccione una sede...</option>';
                allSedes.forEach(sede => {
                    const option = document.createElement('option');
                    option.value = sede.id_sede;
                    option.textContent = sede.nombre_sede;
                    areaSedeInput.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error al cargar sedes:', error);
            showToast('Error al cargar las sedes', 'error');
        }
    }

    // Carga las areas desde la API
    async function fetchAreas() {
        setLoading(true);
        
        try {
            const response = await fetch(API_URL, { method: 'GET' });
            
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            
            const result = await response.json();
            
            if (result.records && Array.isArray(result.records)) {
                allAreas = result.records;
                filteredAreas = filterAreas(currentSearchTerm, currentSedeFilter);
                renderAreas(filteredAreas);
            } else {
                allAreas = [];
                filteredAreas = [];
                renderAreas(filteredAreas);
            }
        } catch (error) {
            console.error('Error al cargar las areas:', error);
            showToast('Error al cargar las areas. Revise su conexión.', 'error');
            allAreas = [];
            filteredAreas = [];
            renderAreas(filteredAreas);
        } finally {
            setLoading(false);
        }
    }

    // Funciones de modal
    function toggleModal(show, title = '') {
        areaModal.classList.toggle('hidden', !show);
        areaModal.classList.toggle('flex', show);
        if (show) {
            modalTitle.textContent = title;
            areaNombreInput.focus();
        }
    }

    function toggleDeleteModal(show) {
        deleteConfirmModal.classList.toggle('hidden', !show);
        deleteConfirmModal.classList.toggle('flex', show);
    }

    // Event listeners para modales
    closeAreaModalBtn.addEventListener('click', () => toggleModal(false));
    cancelDeleteBtn.addEventListener('click', () => toggleDeleteModal(false));
    areaModal.addEventListener('click', (e) => {
        if (e.target === areaModal) toggleModal(false);
    });
    deleteConfirmModal.addEventListener('click', (e) => {
        if (e.target === deleteConfirmModal) toggleDeleteModal(false);
    });

    // Maneja el envío del formulario
    areaForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nombre = areaNombreInput.value.trim();
        const sedeId = areaSedeInput.value;
        const areaId = areaIdInput.value;

        if (!nombre) {
            showToast('El nombre del area es requerido', 'error');
            areaNombreInput.focus();
            return;
        }

        if (!sedeId) {
            showToast('La sede es requerida', 'error');
            areaSedeInput.focus();
            return;
        }

        if (nombre.length > 100) {
            showToast('El nombre no puede exceder 100 caracteres', 'error');
            areaNombreInput.focus();
            return;
        }

        setButtonLoading(saveBtnText, saveBtnLoading, true, areaId ? 'Actualizar' : 'Guardar');
        saveBtn.disabled = true;

        const method = areaId ? 'PUT' : 'POST';
        const data = { nombre_area: nombre, id_sede: parseInt(sedeId) };
        if (areaId) data.id_area = parseInt(areaId);

        try {
            const response = await fetch(API_URL, {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                toggleModal(false);
                await fetchAreas();
                showToast(result.message || 'Operación realizada con éxito', 'success');
            } else {
                showToast(result.message || 'Error en la operación', 'error');
            }
        } catch (error) {
            console.error('Error al guardar el area:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(saveBtnText, saveBtnLoading, false, areaId ? 'Actualizar' : 'Guardar');
            saveBtn.disabled = false;
        }
    });

    // Maneja los clics en los botones de la tabla
    areasTableBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('edit-btn')) {
            const btn = e.target;
            areaIdInput.value = btn.dataset.id;
            areaNombreInput.value = btn.dataset.nombre;
            areaSedeInput.value = btn.dataset.sede;
            toggleModal(true, 'Editar Area');
        }

        if (e.target.classList.contains('delete-btn')) {
            areaIdToDelete = e.target.dataset.id;
            toggleDeleteModal(true);
        }
    });

    // Botón agregar area
    addAreaBtn.addEventListener('click', () => {
        areaForm.reset();
        areaIdInput.value = '';
        toggleModal(true, 'Agregar Nueva Area');
    });

    // Función para eliminar area
    async function deleteArea(areaId) {
        setButtonLoading(deleteBtnText, deleteBtnLoading, true, 'Eliminar');
        confirmDeleteBtn.disabled = true;

        try {
            const response = await fetch(API_URL, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_area: parseInt(areaId) })
            });

            const result = await response.json();

            if (response.ok) {
                await fetchAreas();
                showToast(result.message || 'Area eliminada con éxito', 'success');
                toggleDeleteModal(false);
            } else {
                showToast(result.message || 'Error al eliminar el area', 'error');
            }
        } catch (error) {
            console.error('Error al eliminar el area:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(deleteBtnText, deleteBtnLoading, false, 'Eliminar');
            confirmDeleteBtn.disabled = false;
        }
    }

    // Confirmar eliminación
    confirmDeleteBtn.addEventListener('click', () => {
        if (areaIdToDelete) {
            deleteArea(areaIdToDelete);
            areaIdToDelete = null;
        }
    });

    // Inicializar la aplicación
    async function init() {
        await loadSedes();
        await fetchAreas();
    }

    // Cargar datos al iniciar
    init();
</script>

<?php
include '../includes/footer.php';
?>