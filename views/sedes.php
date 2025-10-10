<?php
include '../includes/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Sedes</h1>
        
        <!-- Barra de búsqueda y botón agregar -->
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:w-80">
                <input 
                    type="text" 
                    id="search-input" 
                    placeholder="Buscar por nombre o descripción..." 
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
            <button id="add-sede-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 whitespace-nowrap">
                + Agregar Sede
            </button>
        </div>
    </div>

    <!-- Indicadores de búsqueda -->
    <div id="search-info" class="hidden mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
        <div class="flex items-center justify-between">
            <span id="search-results-text" class="text-sm text-blue-800"></span>
            <button id="reset-search" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Ver todas las sedes
            </button>
        </div>
    </div>

    <!-- Indicador de carga -->
    <div id="loading" class="hidden text-center py-8">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Cargando sedes...</p>
    </div>

    <!-- Tabla de sedes -->
    <div id="sedes-table-container" class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nombre
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Descripción
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody id="sedes-table-body" class="text-gray-700">
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
        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay sedes registradas</h3>
        <p class="text-gray-500 mb-4">Comienza agregando tu primera sede haciendo clic en el botón "Agregar Sede".</p>
    </div>

    <!-- Mensaje cuando no hay resultados de búsqueda -->
    <div id="no-search-results" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron resultados</h3>
        <p class="text-gray-500 mb-4">No hay sedes que coincidan con tu búsqueda. Intenta con otros términos.</p>
        <button id="clear-search-from-message" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Limpiar búsqueda
        </button>
    </div>
</div>

<!-- Modal para agregar/editar sedes -->
<div id="sede-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md mx-4">
        <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-6"></h2>
        <form id="sede-form">
            <input type="hidden" id="sede-id">
            <div class="mb-4">
                <label for="sede-nombre" class="block text-gray-700 font-semibold mb-2">
                    Nombre de la Sede <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="sede-nombre" 
                    maxlength="50"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                    placeholder="Ej: Sede Principal">
                <small class="text-gray-500">Máximo 50 caracteres</small>
            </div>
            <div class="mb-4">
                <label for="sede-descripcion" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                <textarea 
                    id="sede-descripcion" 
                    maxlength="255"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    rows="3"
                    placeholder="Descripción opcional de la sede"></textarea>
                <small class="text-gray-500">Máximo 255 caracteres</small>
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
            <p class="mb-6 text-gray-600">¿Estás seguro de que deseas eliminar esta sede? Esta acción no se puede deshacer.</p>
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
    const API_URL = '../api/controllers/sedes.php';
    
    // Variables globales
    let allSedes = []; // Almacena todas las sedes
    let filteredSedes = []; // Almacena las sedes filtradas
    let currentSearchTerm = ''; // Término de búsqueda actual
    
    // Elementos del DOM
    const sedesTableBody = document.getElementById('sedes-table-body');
    const sedesTableContainer = document.getElementById('sedes-table-container');
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
    const addSedeBtn = document.getElementById('add-sede-btn');
    const sedeModal = document.getElementById('sede-modal');
    const closeSedeModalBtn = document.getElementById('close-modal-btn');
    const modalTitle = document.getElementById('modal-title');
    const sedeForm = document.getElementById('sede-form');
    const sedeIdInput = document.getElementById('sede-id');
    const sedeNombreInput = document.getElementById('sede-nombre');
    const sedeDescripcionInput = document.getElementById('sede-descripcion');
    const saveBtn = document.getElementById('save-btn');
    const saveBtnText = document.getElementById('save-btn-text');
    const saveBtnLoading = document.getElementById('save-btn-loading');
    const deleteConfirmModal = document.getElementById('delete-confirm-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const deleteBtnText = document.getElementById('delete-btn-text');
    const deleteBtnLoading = document.getElementById('delete-btn-loading');
    let sedeIdToDelete = null;

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
        sedesTableContainer.classList.toggle('hidden', show);
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

    // Función para filtrar sedes
    function filterSedes(searchTerm) {
        if (!searchTerm.trim()) {
            return allSedes;
        }
        
        const term = searchTerm.toLowerCase().trim();
        return allSedes.filter(sede => {
            return sede.nombre.toLowerCase().includes(term) ||
                   (sede.descripcion && sede.descripcion.toLowerCase().includes(term));
        });
    }

    // Función para actualizar la información de búsqueda
    function updateSearchInfo() {
        if (currentSearchTerm) {
            const count = filteredSedes.length;
            searchResultsText.textContent = `Mostrando ${count} resultado${count !== 1 ? 's' : ''} para "${currentSearchTerm}"`;
            searchInfo.classList.remove('hidden');
        } else {
            searchInfo.classList.add('hidden');
        }
    }

    // Función para renderizar las sedes en la tabla
    function renderSedes(sedes) {
        sedesTableBody.innerHTML = '';
        
        if (sedes.length > 0) {
            sedesTableContainer.classList.remove('hidden');
            noDataMessage.classList.add('hidden');
            noSearchResults.classList.add('hidden');
            
            sedes.forEach(sede => {
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-100', 'transition', 'duration-150', 'ease-in-out', 'border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="px-5 py-5 text-sm">${sede.id_sede}</td>
                    <td class="px-5 py-5 text-sm font-medium">${escapeHtml(sede.nombre)}</td>
                    <td class="px-5 py-5 text-sm">${escapeHtml(sede.descripcion || '')}</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="flex space-x-2">
                            <button class="edit-btn bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg transition duration-300" 
                                data-id="${sede.id_sede}" 
                                data-nombre="${escapeHtml(sede.nombre)}" 
                                data-descripcion="${escapeHtml(sede.descripcion || '')}"
                                title="Editar sede">
                                Editar
                            </button>
                            <button class="delete-btn bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg transition duration-300" 
                                data-id="${sede.id_sede}"
                                title="Eliminar sede">
                                Eliminar
                            </button>
                        </div>
                    </td>
                `;
                sedesTableBody.appendChild(row);
            });
        } else {
            sedesTableContainer.classList.add('hidden');
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
        filteredSedes = filterSedes(currentSearchTerm);
        renderSedes(filteredSedes);
        
        // Mostrar/ocultar botón de limpiar búsqueda
        clearSearchBtn.classList.toggle('hidden', !currentSearchTerm);
    }

    // Función para limpiar búsqueda
    function clearSearch() {
        searchInput.value = '';
        currentSearchTerm = '';
        filteredSedes = allSedes;
        renderSedes(filteredSedes);
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

    // Carga las sedes desde la API
    async function fetchSedes() {
        setLoading(true);
        
        try {
            const response = await fetch(API_URL, { method: 'GET' });
            
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            
            const result = await response.json();
            
            if (result.records && Array.isArray(result.records)) {
                allSedes = result.records;
                filteredSedes = filterSedes(currentSearchTerm);
                renderSedes(filteredSedes);
            } else {
                allSedes = [];
                filteredSedes = [];
                renderSedes(filteredSedes);
            }
        } catch (error) {
            console.error('Error al cargar las sedes:', error);
            showToast('Error al cargar las sedes. Revise su conexión.', 'error');
            allSedes = [];
            filteredSedes = [];
            renderSedes(filteredSedes);
        } finally {
            setLoading(false);
        }
    }

    // Funciones de modal
    function toggleModal(show, title = '') {
        sedeModal.classList.toggle('hidden', !show);
        sedeModal.classList.toggle('flex', show);
        if (show) {
            modalTitle.textContent = title;
            sedeNombreInput.focus();
        }
    }

    function toggleDeleteModal(show) {
        deleteConfirmModal.classList.toggle('hidden', !show);
        deleteConfirmModal.classList.toggle('flex', show);
    }

    // Event listeners para modales
    closeSedeModalBtn.addEventListener('click', () => toggleModal(false));
    cancelDeleteBtn.addEventListener('click', () => toggleDeleteModal(false));
    sedeModal.addEventListener('click', (e) => {
        if (e.target === sedeModal) toggleModal(false);
    });
    deleteConfirmModal.addEventListener('click', (e) => {
        if (e.target === deleteConfirmModal) toggleDeleteModal(false);
    });

    // Maneja el envío del formulario
    sedeForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nombre = sedeNombreInput.value.trim();
        const descripcion = sedeDescripcionInput.value.trim();
        const sedeId = sedeIdInput.value;

        if (!nombre) {
            showToast('El nombre de la sede es requerido', 'error');
            sedeNombreInput.focus();
            return;
        }

        if (nombre.length > 50) {
            showToast('El nombre no puede exceder 50 caracteres', 'error');
            sedeNombreInput.focus();
            return;
        }

        setButtonLoading(saveBtnText, saveBtnLoading, true, sedeId ? 'Actualizar' : 'Guardar');
        saveBtn.disabled = true;

        const method = sedeId ? 'PUT' : 'POST';
        const data = { nombre, descripcion };
        if (sedeId) data.id_sede = parseInt(sedeId);

        try {
            const response = await fetch(API_URL, {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                toggleModal(false);
                await fetchSedes(); // Recargar datos
                showToast(result.message || 'Operación realizada con éxito', 'success');
            } else {
                showToast(result.message || 'Error en la operación', 'error');
            }
        } catch (error) {
            console.error('Error al guardar la sede:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(saveBtnText, saveBtnLoading, false, sedeId ? 'Actualizar' : 'Guardar');
            saveBtn.disabled = false;
        }
    });

    // Maneja los clics en los botones de la tabla
    sedesTableBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('edit-btn')) {
            const btn = e.target;
            sedeIdInput.value = btn.dataset.id;
            sedeNombreInput.value = btn.dataset.nombre;
            sedeDescripcionInput.value = btn.dataset.descripcion;
            toggleModal(true, 'Editar Sede');
        }

        if (e.target.classList.contains('delete-btn')) {
            sedeIdToDelete = e.target.dataset.id;
            toggleDeleteModal(true);
        }
    });

    // Botón agregar sede
    addSedeBtn.addEventListener('click', () => {
        sedeForm.reset();
        sedeIdInput.value = '';
        toggleModal(true, 'Agregar Nueva Sede');
    });

    // Función para eliminar sede
    async function deleteSede(sedeId) {
        setButtonLoading(deleteBtnText, deleteBtnLoading, true, 'Eliminar');
        confirmDeleteBtn.disabled = true;

        try {
            const response = await fetch(API_URL, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_sede: parseInt(sedeId) })
            });

            const result = await response.json();

            if (response.ok) {
                await fetchSedes(); // Recargar datos
                showToast(result.message || 'Sede eliminada con éxito', 'success');
                toggleDeleteModal(false);
            } else {
                showToast(result.message || 'Error al eliminar la sede', 'error');
            }
        } catch (error) {
            console.error('Error al eliminar la sede:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(deleteBtnText, deleteBtnLoading, false, 'Eliminar');
            confirmDeleteBtn.disabled = false;
        }
    }

    // Confirmar eliminación
    confirmDeleteBtn.addEventListener('click', () => {
        if (sedeIdToDelete) {
            deleteSede(sedeIdToDelete);
            sedeIdToDelete = null;
        }
    });

    // Cargar sedes al iniciar
    fetchSedes();
</script>

<?php
include '../includes/footer.php';
?>