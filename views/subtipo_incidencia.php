<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Subtipos de Incidencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Gestión de Subtipos de Incidencia</h1>
                <p class="text-gray-600 mt-2">Administra los subtipos para cada tipo de incidencia</p>
            </div>
            <button id="add-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>Nuevo Subtipo
            </button>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Tipo</label>
                    <select id="filter-tipo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos los tipos</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                    <select id="filter-estado" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                    <input type="text" id="search-input" placeholder="Buscar subtipo..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Incidencia</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                        <!-- Se llenará dinámicamente -->
                    </tbody>
                </table>
            </div>
            <div id="no-data" class="hidden text-center py-12">
                <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-500 text-lg">No se encontraron subtipos</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
                <h2 id="modal-title" class="text-xl font-bold">Nuevo Subtipo</h2>
            </div>
            
            <form id="subtipo-form" class="p-6 space-y-4">
                <input type="hidden" id="subtipo-id">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Incidencia <span class="text-red-500">*</span>
                    </label>
                    <select id="tipo-select" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccione un tipo...</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre del Subtipo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nombre-input" required maxlength="100"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                           placeholder="Ej: Computadora no enciende">
                    <small class="text-gray-500">Máximo 100 caracteres</small>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>
                    <textarea id="descripcion-input" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                              placeholder="Descripción detallada del subtipo..."></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Estado
                    </label>
                    <select id="estado-select"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" id="cancel-btn"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        const API_URL = '../api/controllers/subtipos_incidencias.php';
        const TIPOS_API = '../api/controllers/tipos_incidencias.php';
        
        let subtiposData = [];
        let tiposData = [];
        let currentSubtipo = null;

        // Elementos del DOM
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        const subtipoForm = document.getElementById('subtipo-form');
        const tableBody = document.getElementById('table-body');
        const noData = document.getElementById('no-data');
        const addBtn = document.getElementById('add-btn');
        const cancelBtn = document.getElementById('cancel-btn');
        
        // Inputs
        const subtipoIdInput = document.getElementById('subtipo-id');
        const tipoSelect = document.getElementById('tipo-select');
        const nombreInput = document.getElementById('nombre-input');
        const descripcionInput = document.getElementById('descripcion-input');
        const estadoSelect = document.getElementById('estado-select');
        
        // Filtros
        const filterTipo = document.getElementById('filter-tipo');
        const filterEstado = document.getElementById('filter-estado');
        const searchInput = document.getElementById('search-input');

        // Función para mostrar toast
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            toast.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg mb-4`;
            toast.textContent = message;
            document.getElementById('toast-container').appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        // Cargar tipos de incidencia
        async function loadTipos() {
            try {
                const response = await fetch(TIPOS_API);
                const result = await response.json();
                
                if (result.records) {
                    tiposData = result.records;
                    renderTipoSelects();
                }
            } catch (error) {
                console.error('Error cargando tipos:', error);
                showToast('Error al cargar tipos de incidencia', 'error');
            }
        }

        // Renderizar selects de tipos
        function renderTipoSelects() {
            const tipoOptions = tiposData.map(tipo => 
                `<option value="${tipo.id_tipo_incidencia}">${tipo.nombre}</option>`
            ).join('');
            
            tipoSelect.innerHTML = '<option value="">Seleccione un tipo...</option>' + tipoOptions;
            filterTipo.innerHTML = '<option value="">Todos los tipos</option>' + tipoOptions;
        }

        // Cargar subtipos
        async function loadSubtipos() {
            try {
                const response = await fetch(API_URL);
                const result = await response.json();
                
                if (result.records) {
                    subtiposData = result.records;
                    filterAndRenderSubtipos();
                }
            } catch (error) {
                console.error('Error cargando subtipos:', error);
                showToast('Error al cargar subtipos', 'error');
            }
        }

        // Filtrar y renderizar
        function filterAndRenderSubtipos() {
            let filtered = subtiposData;
            
            // Filtro por tipo
            const tipoFilter = filterTipo.value;
            if (tipoFilter) {
                filtered = filtered.filter(s => s.id_tipo_incidencia == tipoFilter);
            }
            
            // Filtro por estado
            const estadoFilter = filterEstado.value;
            if (estadoFilter) {
                filtered = filtered.filter(s => s.estado === estadoFilter);
            }
            
            // Búsqueda por texto
            const searchText = searchInput.value.toLowerCase();
            if (searchText) {
                filtered = filtered.filter(s => 
                    s.nombre.toLowerCase().includes(searchText) ||
                    (s.descripcion && s.descripcion.toLowerCase().includes(searchText))
                );
            }
            
            renderSubtipos(filtered);
        }

        // Renderizar tabla
        function renderSubtipos(data) {
            if (!data || data.length === 0) {
                tableBody.innerHTML = '';
                noData.classList.remove('hidden');
                return;
            }
            
            noData.classList.add('hidden');
            tableBody.innerHTML = data.map(subtipo => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${subtipo.id_subtipo_incidencia}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${subtipo.nombre}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            ${subtipo.tipo_nombre}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">${subtipo.descripcion || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${
                            subtipo.estado === 'activo' 
                                ? 'bg-green-100 text-green-800' 
                                : 'bg-gray-100 text-gray-800'
                        }">
                            ${subtipo.estado === 'activo' ? 'Activo' : 'Inactivo'}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        ${new Date(subtipo.fecha_creacion).toLocaleDateString('es-ES')}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button onclick="editSubtipo(${subtipo.id_subtipo_incidencia})" 
                                class="text-blue-600 hover:text-blue-800 mr-3" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteSubtipo(${subtipo.id_subtipo_incidencia})" 
                                class="text-red-600 hover:text-red-800" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        // Abrir modal para crear
        function openCreateModal() {
            currentSubtipo = null;
            modalTitle.textContent = 'Nuevo Subtipo';
            subtipoForm.reset();
            subtipoIdInput.value = '';
            estadoSelect.value = 'activo';
            modal.classList.remove('hidden');
        }

        // Editar subtipo
        async function editSubtipo(id) {
            try {
                const response = await fetch(`${API_URL}?action=single&id=${id}`);
                const result = await response.json();
                
                if (result.subtipo) {
                    currentSubtipo = result.subtipo;
                    modalTitle.textContent = 'Editar Subtipo';
                    subtipoIdInput.value = currentSubtipo.id_subtipo_incidencia;
                    tipoSelect.value = currentSubtipo.id_tipo_incidencia;
                    nombreInput.value = currentSubtipo.nombre;
                    descripcionInput.value = currentSubtipo.descripcion || '';
                    estadoSelect.value = currentSubtipo.estado;
                    modal.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error cargando subtipo:', error);
                showToast('Error al cargar subtipo', 'error');
            }
        }

        // Eliminar subtipo
        async function deleteSubtipo(id) {
            if (!confirm('¿Estás seguro de eliminar este subtipo?')) return;
            
            try {
                const response = await fetch(API_URL, {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id_subtipo_incidencia: id })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showToast('Subtipo eliminado correctamente');
                    loadSubtipos();
                } else {
                    showToast(result.message || 'Error al eliminar', 'error');
                }
            } catch (error) {
                console.error('Error eliminando subtipo:', error);
                showToast('Error al eliminar subtipo', 'error');
            }
        }

        // Guardar subtipo
        subtipoForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const id = subtipoIdInput.value;
            const data = {
                nombre: nombreInput.value.trim(),
                descripcion: descripcionInput.value.trim(),
                id_tipo_incidencia: parseInt(tipoSelect.value),
                estado: estadoSelect.value
            };
            
            if (id) {
                data.id_subtipo_incidencia = parseInt(id);
            }
            
            try {
                const response = await fetch(API_URL, {
                    method: id ? 'PUT' : 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showToast(id ? 'Subtipo actualizado correctamente' : 'Subtipo creado correctamente');
                    modal.classList.add('hidden');
                    loadSubtipos();
                } else {
                    showToast(result.message || 'Error al guardar', 'error');
                }
            } catch (error) {
                console.error('Error guardando subtipo:', error);
                showToast('Error al guardar subtipo', 'error');
            }
        });

        // Event listeners
        addBtn.addEventListener('click', openCreateModal);
        cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));
        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });
        
        filterTipo.addEventListener('change', filterAndRenderSubtipos);
        filterEstado.addEventListener('change', filterAndRenderSubtipos);
        searchInput.addEventListener('input', filterAndRenderSubtipos);

        // Hacer funciones globales
        window.editSubtipo = editSubtipo;
        window.deleteSubtipo = deleteSubtipo;

        // Inicializar
        async function init() {
            await loadTipos();
            await loadSubtipos();
        }

        init();
    </script>
</body>
</html>