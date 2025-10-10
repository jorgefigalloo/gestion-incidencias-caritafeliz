<?php
include '../includes/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Tipos de Incidencia</h1>
        
        <!-- Barra de búsqueda y botón agregar -->
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:w-80">
                <input 
                    type="text" 
                    id="search-input" 
                    placeholder="Buscar tipos de incidencia..." 
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
            
            <button id="add-tipo-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 whitespace-nowrap">
                + Agregar Tipo
            </button>
        </div>
    </div>

    <!-- Indicadores de búsqueda -->
    <div id="search-info" class="hidden mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
        <div class="flex items-center justify-between">
            <span id="search-results-text" class="text-sm text-blue-800"></span>
            <button id="reset-search" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Ver todos los tipos
            </button>
        </div>
    </div>

    <!-- Indicador de carga -->
    <div id="loading" class="hidden text-center py-8">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Cargando tipos de incidencia...</p>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div id="stats-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 hidden">
        <!-- Las estadísticas se llenarán aquí -->
    </div>

    <!-- Tabla de tipos de incidencia -->
    <div id="tipos-table-container" class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nombre del Tipo
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Incidencias Registradas
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody id="tipos-table-body" class="text-gray-700">
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
        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay tipos de incidencia registrados</h3>
        <p class="text-gray-500 mb-4">Comienza agregando tu primer tipo de incidencia haciendo clic en el botón "Agregar Tipo".</p>
    </div>

    <!-- Mensaje cuando no hay resultados de búsqueda -->
    <div id="no-search-results" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron resultados</h3>
        <p class="text-gray-500 mb-4">No hay tipos de incidencia que coincidan con tu búsqueda. Intenta con otros términos.</p>
        <button id="clear-search-from-message" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Limpiar búsqueda
        </button>
    </div>
</div>

<!-- Modal para agregar/editar tipos -->
<div id="tipo-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md mx-4">
        <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-6"></h2>
        <form id="tipo-form">
            <input type="hidden" id="tipo-id">
            <div class="mb-4">
                <label for="tipo-nombre" class="block text-gray-700 font-semibold mb-2">
                    Nombre del Tipo <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="tipo-nombre" 
                    maxlength="50"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                    placeholder="Ej: Fallo de Hardware, Problema de Software">
                <small class="text-gray-500">Máximo 50 caracteres</small>
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
            <p class="mb-6 text-gray-600">¿Estás seguro de que deseas eliminar este tipo de incidencia? Esta acción no se puede deshacer.</p>
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
  const API_URL = '../api/controllers/tipos_incidencias.php';

 //    const API_URL = 'http://localhost:3000/clinicacaritafeliz-gestion/api/controllers/tipos_incidencias.php';
    
    // Variables globales
    let allTipos = []; 
    let allStats = [];
    let filteredTipos = []; 
    let currentSearchTerm = ''; 
    
    // Elementos del DOM
    const tiposTableBody = document.getElementById('tipos-table-body');
    const tiposTableContainer = document.getElementById('tipos-table-container');
    const noDataMessage = document.getElementById('no-data-message');
    const noSearchResults = document.getElementById('no-search-results');
    const loadingIndicator = document.getElementById('loading');
    const searchInput = document.getElementById('search-input');
    const clearSearchBtn = document.getElementById('clear-search');
    const searchInfo = document.getElementById('search-info');
    const searchResultsText = document.getElementById('search-results-text');
    const resetSearchBtn = document.getElementById('reset-search');
    const clearSearchFromMessageBtn = document.getElementById('clear-search-from-message');
    const statsContainer = document.getElementById('stats-container');
    
    // Elementos de los modales
    const addTipoBtn = document.getElementById('add-tipo-btn');
    const tipoModal = document.getElementById('tipo-modal');
    const closeTipoModalBtn = document.getElementById('close-modal-btn');
    const modalTitle = document.getElementById('modal-title');
    const tipoForm = document.getElementById('tipo-form');
    const tipoIdInput = document.getElementById('tipo-id');
    const tipoNombreInput = document.getElementById('tipo-nombre');
    const saveBtn = document.getElementById('save-btn');
    const saveBtnText = document.getElementById('save-btn-text');
    const saveBtnLoading = document.getElementById('save-btn-loading');
    const deleteConfirmModal = document.getElementById('delete-confirm-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const deleteBtnText = document.getElementById('delete-btn-text');
    const deleteBtnLoading = document.getElementById('delete-btn-loading');
    let tipoIdToDelete = null;

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
        tiposTableContainer.classList.toggle('hidden', show);
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

    // Función para filtrar tipos
    function filterTipos(searchTerm) {
        if (!searchTerm.trim()) {
            return allTipos;
        }
        
        const term = searchTerm.toLowerCase().trim();
        return allTipos.filter(tipo => {
            return tipo.nombre.toLowerCase().includes(term);
        });
    }

    // Función para actualizar la información de búsqueda
    function updateSearchInfo() {
        if (currentSearchTerm) {
            const count = filteredTipos.length;
            searchResultsText.textContent = `Mostrando ${count} resultado${count !== 1 ? 's' : ''} para "${currentSearchTerm}"`;
            searchInfo.classList.remove('hidden');
        } else {
            searchInfo.classList.add('hidden');
        }
    }

    // Función para renderizar estadísticas
    function renderStats(stats) {
        if (!stats || stats.length === 0) {
            statsContainer.classList.add('hidden');
            return;
        }

        statsContainer.innerHTML = '';
        
        // Calcular totales
        const totalIncidencias = stats.reduce((sum, stat) => sum + parseInt(stat.incidencias_count), 0);
        const totalAbiertas = stats.reduce((sum, stat) => sum + parseInt(stat.abiertas), 0);
        const totalEnProceso = stats.reduce((sum, stat) => sum + parseInt(stat.en_proceso), 0);
        const totalCerradas = stats.reduce((sum, stat) => sum + parseInt(stat.cerradas), 0);

        // Tarjetas de estadísticas
        const cards = [
            {
                title: 'Total Incidencias',
                value: totalIncidencias,
                icon: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                bgColor: 'bg-blue-100',
                textColor: 'text-blue-600'
            },
            {
                title: 'Abiertas',
                value: totalAbiertas,
                icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                bgColor: 'bg-yellow-100',
                textColor: 'text-yellow-600'
            },
            {
                title: 'En Proceso',
                value: totalEnProceso,
                icon: 'M13 10V3L4 14h7v7l9-11h-7z',
                bgColor: 'bg-orange-100',
                textColor: 'text-orange-600'
            },
            {
                title: 'Cerradas',
                value: totalCerradas,
                icon: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                bgColor: 'bg-green-100',
                textColor: 'text-green-600'
            }
        ];

        cards.forEach(card => {
            const cardElement = `
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-2 ${card.bgColor} rounded-lg">
                            <svg class="w-6 h-6 ${card.textColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${card.icon}"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">${card.title}</p>
                            <p class="text-2xl font-bold text-gray-900">${card.value}</p>
                        </div>
                    </div>
                </div>
            `;
            statsContainer.innerHTML += cardElement;
        });

        statsContainer.classList.remove('hidden');
    }

    // Función para obtener el conteo de incidencias por tipo
    function getIncidenciasCount(tipoId) {
        const stat = allStats.find(s => s.id_tipo_incidencia == tipoId);
        return stat ? parseInt(stat.incidencias_count) : 0;
    }

    // Función para renderizar los tipos en la tabla
    function renderTipos(tipos) {
        tiposTableBody.innerHTML = '';
        
        if (tipos.length > 0) {
            tiposTableContainer.classList.remove('hidden');
            noDataMessage.classList.add('hidden');
            noSearchResults.classList.add('hidden');
            
            tipos.forEach(tipo => {
                const incidenciasCount = getIncidenciasCount(tipo.id_tipo_incidencia);
                
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-50', 'transition', 'duration-150', 'ease-in-out', 'border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="px-5 py-5 text-sm">${tipo.id_tipo_incidencia}</td>
                    <td class="px-5 py-5 text-sm font-medium">${escapeHtml(tipo.nombre)}</td>
                    <td class="px-5 py-5 text-sm">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                            ${incidenciasCount} incidencia${incidenciasCount !== 1 ? 's' : ''}
                        </span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <div class="flex space-x-2">
                            <button class="edit-btn bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg transition duration-300 text-xs" 
                                data-id="${tipo.id_tipo_incidencia}" 
                                data-nombre="${escapeHtml(tipo.nombre)}"
                                title="Editar tipo">
                                Editar
                            </button>
                            <button class="delete-btn bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg transition duration-300 text-xs ${incidenciasCount > 0 ? 'opacity-50 cursor-not-allowed' : ''}" 
                                data-id="${tipo.id_tipo_incidencia}"
                                data-nombre="${escapeHtml(tipo.nombre)}"
                                ${incidenciasCount > 0 ? 'disabled' : ''}
                                title="${incidenciasCount > 0 ? 'No se puede eliminar: tiene incidencias asociadas' : 'Eliminar tipo'}">
                                Eliminar
                            </button>
                        </div>
                    </td>
                `;
                tiposTableBody.appendChild(row);
            });
        } else {
            tiposTableContainer.classList.add('hidden');
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
        filteredTipos = filterTipos(currentSearchTerm);
        renderTipos(filteredTipos);
        
        // Mostrar/ocultar botón de limpiar búsqueda
        clearSearchBtn.classList.toggle('hidden', !currentSearchTerm);
    }

    // Función para limpiar búsqueda
    function clearSearch() {
        searchInput.value = '';
        currentSearchTerm = '';
        filteredTipos = allTipos;
        renderTipos(filteredTipos);
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

    // Función para cargar estadísticas
    async function loadStats() {
        try {
            const response = await fetch(API_URL + '?action=stats');
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const result = await response.json();
            
            if (result.stats && Array.isArray(result.stats)) {
                allStats = result.stats;
                renderStats(allStats);
            }
        } catch (error) {
            console.error('Error al cargar estadísticas:', error);
            // No mostrar error al usuario, las estadísticas son opcionales
        }
    }

    // Carga los tipos desde la API
    async function fetchTipos() {
        setLoading(true);
        
        try {
            const response = await fetch(API_URL, { method: 'GET' });
            
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            
            const result = await response.json();
            
            if (result.records && Array.isArray(result.records)) {
                allTipos = result.records;
                filteredTipos = filterTipos(currentSearchTerm);
                renderTipos(filteredTipos);
            } else {
                allTipos = [];
                filteredTipos = [];
                renderTipos(filteredTipos);
            }
        } catch (error) {
            console.error('Error al cargar los tipos:', error);
            showToast('Error al cargar los tipos de incidencia. Revise su conexión.', 'error');
            allTipos = [];
            filteredTipos = [];
            renderTipos(filteredTipos);
        } finally {
            setLoading(false);
        }
    }

    // Funciones de modal
    function toggleModal(show, title = '') {
        tipoModal.classList.toggle('hidden', !show);
        tipoModal.classList.toggle('flex', show);
        if (show) {
            modalTitle.textContent = title;
            tipoNombreInput.focus();
        }
    }

    function toggleDeleteModal(show) {
        deleteConfirmModal.classList.toggle('hidden', !show);
        deleteConfirmModal.classList.toggle('flex', show);
    }

    // Event listeners para modales
    closeTipoModalBtn.addEventListener('click', () => toggleModal(false));
    cancelDeleteBtn.addEventListener('click', () => toggleDeleteModal(false));
    tipoModal.addEventListener('click', (e) => {
        if (e.target === tipoModal) toggleModal(false);
    });
    deleteConfirmModal.addEventListener('click', (e) => {
        if (e.target === deleteConfirmModal) toggleDeleteModal(false);
    });

    // Maneja el envío del formulario
    tipoForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nombre = tipoNombreInput.value.trim();
        const tipoId = tipoIdInput.value;

        if (!nombre) {
            showToast('El nombre del tipo es requerido', 'error');
            tipoNombreInput.focus();
            return;
        }

        if (nombre.length > 50) {
            showToast('El nombre no puede exceder 50 caracteres', 'error');
            tipoNombreInput.focus();
            return;
        }

        setButtonLoading(saveBtnText, saveBtnLoading, true, tipoId ? 'Actualizar' : 'Guardar');
        saveBtn.disabled = true;

        const method = tipoId ? 'PUT' : 'POST';
        const data = { nombre };
        if (tipoId) data.id_tipo_incidencia = parseInt(tipoId);

        try {
            const response = await fetch(API_URL, {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                toggleModal(false);
                await fetchTipos();
                await loadStats();
                showToast(result.message || 'Operación realizada con éxito', 'success');
            } else {
                showToast(result.message || 'Error en la operación', 'error');
            }
        } catch (error) {
            console.error('Error al guardar el tipo:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(saveBtnText, saveBtnLoading, false, tipoId ? 'Actualizar' : 'Guardar');
            saveBtn.disabled = false;
        }
    });

    // Maneja los clics en los botones de la tabla
    tiposTableBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('edit-btn')) {
            const btn = e.target;
            tipoIdInput.value = btn.dataset.id;
            tipoNombreInput.value = btn.dataset.nombre;
            toggleModal(true, 'Editar Tipo de Incidencia');
        }

        if (e.target.classList.contains('delete-btn') && !e.target.disabled) {
            tipoIdToDelete = e.target.dataset.id;
            toggleDeleteModal(true);
        }
    });

    // Botón agregar tipo
    addTipoBtn.addEventListener('click', () => {
        tipoForm.reset();
        tipoIdInput.value = '';
        toggleModal(true, 'Agregar Nuevo Tipo de Incidencia');
    });

    // Función para eliminar tipo
    async function deleteTipo(tipoId) {
        setButtonLoading(deleteBtnText, deleteBtnLoading, true, 'Eliminar');
        confirmDeleteBtn.disabled = true;

        try {
            const response = await fetch(API_URL, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_tipo_incidencia: parseInt(tipoId) })
            });

            const result = await response.json();

            if (response.ok) {
                await fetchTipos();
                await loadStats();
                showToast(result.message || 'Tipo eliminado con éxito', 'success');
                toggleDeleteModal(false);
            } else {
                if (result.code === 'TIPO_IN_USE') {
                    showToast('No se puede eliminar: El tipo está siendo usado por incidencias activas', 'error');
                } else {
                    showToast(result.message || 'Error al eliminar el tipo', 'error');
                }
            }
        } catch (error) {
            console.error('Error al eliminar el tipo:', error);
            showToast('Error de conexión con el servidor', 'error');
        } finally {
            setButtonLoading(deleteBtnText, deleteBtnLoading, false, 'Eliminar');
            confirmDeleteBtn.disabled = false;
        }
    }

    // Confirmar eliminación
    confirmDeleteBtn.addEventListener('click', () => {
        if (tipoIdToDelete) {
            deleteTipo(tipoIdToDelete);
            tipoIdToDelete = null;
        }
    });

    // Inicializar la aplicación
    async function init() {
        await fetchTipos();
        await loadStats();
    }

    // Cargar datos al iniciar
    init();
</script>

<?php
include '../includes/footer.php';
?>