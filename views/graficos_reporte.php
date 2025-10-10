<?php
session_start();
// Verificación básica - la real se hace en el frontend con localStorage
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Avanzados</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { margin: 0; padding: 0; }
        .chart-container { position: relative; height: 300px; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header compacto -->
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
        <div class="px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img src="../assets/images/logo.png" alt="Logo" class="h-8">
                    <div>
                        <h1 class="text-lg font-bold text-gray-800">Reportes Avanzados</h1>
                        <p class="text-xs text-gray-600">Análisis y estadísticas</p>
                    </div>
                </div>
                <div class="text-xs text-gray-500">
                    <i class="fas fa-user-circle mr-1"></i>
                    <span id="current-user-name">...</span>
                </div>
            </div>
        </div>
    </header>

    <main class="px-4 py-4">
        <!-- Filtros compactos -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Fecha Inicio</label>
                    <input type="date" id="fecha_inicio" class="w-full px-2 py-1 text-sm border rounded focus:ring-1 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Fecha Fin</label>
                    <input type="date" id="fecha_fin" class="w-full px-2 py-1 text-sm border rounded focus:ring-1 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Estado</label>
                    <select id="filtro_estado" class="w-full px-2 py-1 text-sm border rounded focus:ring-1 focus:ring-blue-500">
                        <option value="">Todos</option>
                        <option value="abierta">Abierta</option>
                        <option value="en_proceso">En Proceso</option>
                        <option value="cerrada">Cerrada</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Prioridad</label>
                    <select id="filtro_prioridad" class="w-full px-2 py-1 text-sm border rounded focus:ring-1 focus:ring-blue-500">
                        <option value="">Todas</option>
                        <option value="baja">Baja</option>
                        <option value="media">Media</option>
                        <option value="alta">Alta</option>
                        <option value="critica">Crítica</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Tipo</label>
                    <select id="filtro_tipo" class="w-full px-2 py-1 text-sm border rounded focus:ring-1 focus:ring-blue-500">
                        <option value="">Todos</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Técnico</label>
                    <select id="filtro_tecnico" class="w-full px-2 py-1 text-sm border rounded focus:ring-1 focus:ring-blue-500">
                        <option value="">Todos</option>
                        <option value="sin-asignar">Sin asignar</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end space-x-2 mt-3">
                <button onclick="limpiarFiltros()" class="bg-gray-500 hover:bg-gray-600 text-white text-sm px-3 py-1 rounded">
                    <i class="fas fa-eraser mr-1"></i>Limpiar
                </button>
                <button onclick="aplicarFiltros()" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded">
                    <i class="fas fa-search mr-1"></i>Aplicar
                </button>
                <button onclick="generarPDF()" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded">
                    <i class="fas fa-file-pdf mr-1"></i>PDF
                </button>
            </div>
        </div>

        <!-- Stats compactos -->
        <div id="stats-summary" class="grid grid-cols-5 gap-2 mb-4"></div>

        <!-- Selector de gráficos -->
        <div class="bg-white rounded-lg shadow-md p-3 mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Seleccionar Gráficos a Mostrar:</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                <label class="flex items-center space-x-2 text-sm">
                    <input type="checkbox" id="show_trend" checked class="rounded">
                    <span>Tendencia</span>
                </label>
                <label class="flex items-center space-x-2 text-sm">
                    <input type="checkbox" id="show_status" checked class="rounded">
                    <span>Estados</span>
                </label>
                <label class="flex items-center space-x-2 text-sm">
                    <input type="checkbox" id="show_priority" checked class="rounded">
                    <span>Prioridades</span>
                </label>
                <label class="flex items-center space-x-2 text-sm">
                    <input type="checkbox" id="show_type" checked class="rounded">
                    <span>Tipos</span>
                </label>
            </div>
            <button onclick="actualizarVistaGraficos()" class="mt-2 bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1 rounded">
                <i class="fas fa-sync mr-1"></i>Actualizar Vista
            </button>
        </div>

        <!-- Gráficos con altura fija -->
        <div id="charts-container" class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4"></div>

        <!-- Tabla compacta -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-sm font-semibold text-gray-800">
                    Datos Detallados <span id="total-registros" class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full ml-2">0</span>
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-2 py-2 text-left">ID</th>
                            <th class="px-2 py-2 text-left">Título</th>
                            <th class="px-2 py-2 text-left">Estado</th>
                            <th class="px-2 py-2 text-left">Prioridad</th>
                            <th class="px-2 py-2 text-left">Tipo</th>
                            <th class="px-2 py-2 text-left">Fecha</th>
                        </tr>
                    </thead>
                    <tbody id="detailTableBody">
                        <tr><td colspan="6" class="text-center py-4 text-gray-500">Cargando...</td></tr>
                    </tbody>
                </table>
            </div>
            <div id="pagination" class="flex justify-center mt-3 space-x-1"></div>
        </div>
    </main>

    <div id="toast-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        const API_BASE = '../api/controllers/incidencias.php';
        const TIPOS_API = '../api/controllers/tipos_incidencias.php';
        const USUARIOS_API = '../api/controllers/usuario.php';
        
        let chartInstances = {};
        let currentData = [];
        let currentPage = 1;
        const itemsPerPage = 15;

        function displayCurrentUser() {
            const userSession = localStorage.getItem('user_session') || sessionStorage.getItem('user_session');
            if (userSession) {
                try {
                    const session = JSON.parse(userSession);
                    document.getElementById('current-user-name').textContent = (session.nombre_completo || session.username).substring(0, 20);
                } catch(e) {}
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            displayCurrentUser();
            const hoy = new Date();
            const hace30dias = new Date(hoy.getTime() - (30 * 24 * 60 * 60 * 1000));
            document.getElementById('fecha_fin').valueAsDate = hoy;
            document.getElementById('fecha_inicio').valueAsDate = hace30dias;
            cargarFiltros();
            aplicarFiltros();
        });

        async function cargarFiltros() {
            try {
                const [tiposResp, usuariosResp] = await Promise.all([fetch(TIPOS_API), fetch(USUARIOS_API)]);
                const tipos = await tiposResp.json();
                const usuarios = await usuariosResp.json();
                const tipoSelect = document.getElementById('filtro_tipo');
                tipos.records?.forEach(tipo => {
                    tipoSelect.innerHTML += `<option value="${tipo.id_tipo_incidencia}">${tipo.nombre}</option>`;
                });
                const tecnicoSelect = document.getElementById('filtro_tecnico');
                usuarios.records?.filter(u => u.rol === 'tecnico' || u.rol === 'admin').forEach(user => {
                    tecnicoSelect.innerHTML += `<option value="${user.id_usuario}">${user.nombre_completo}</option>`;
                });
            } catch (error) {
                console.error('Error:', error);
            }
        }

        async function aplicarFiltros() {
            try {
                const response = await fetch(API_BASE);
                const data = await response.json();
                currentData = (data.records || []).filter(inc => {
                    const fechaInicio = document.getElementById('fecha_inicio').value;
                    const fechaFin = document.getElementById('fecha_fin').value;
                    const fechaInc = inc.fecha_reporte.split(' ')[0];
                    
                    if (fechaInicio && fechaInc < fechaInicio) return false;
                    if (fechaFin && fechaInc > fechaFin) return false;
                    if (document.getElementById('filtro_estado').value && inc.estado !== document.getElementById('filtro_estado').value) return false;
                    if (document.getElementById('filtro_prioridad').value && inc.prioridad !== document.getElementById('filtro_prioridad').value) return false;
                    
                    return true;
                });
                
                actualizarEstadisticas(currentData);
                actualizarVistaGraficos();
                actualizarTabla(currentData);
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function limpiarFiltros() {
            document.querySelectorAll('select').forEach(el => el.value = '');
            const hoy = new Date();
            const hace30dias = new Date(hoy.getTime() - (30 * 24 * 60 * 60 * 1000));
            document.getElementById('fecha_fin').valueAsDate = hoy;
            document.getElementById('fecha_inicio').valueAsDate = hace30dias;
            aplicarFiltros();
        }

        function actualizarEstadisticas(data) {
            const stats = {
                total: data.length,
                abiertas: data.filter(d => d.estado === 'abierta').length,
                proceso: data.filter(d => d.estado === 'en_proceso').length,
                cerradas: data.filter(d => d.estado === 'cerrada').length,
                canceladas: data.filter(d => d.estado === 'cancelada').length
            };

            document.getElementById('stats-summary').innerHTML = `
                <div class="bg-blue-50 rounded p-2 border-l-4 border-blue-500"><div class="text-lg font-bold text-blue-700">${stats.total}</div><div class="text-xs text-gray-600">Total</div></div>
                <div class="bg-red-50 rounded p-2 border-l-4 border-red-500"><div class="text-lg font-bold text-red-700">${stats.abiertas}</div><div class="text-xs text-gray-600">Abiertas</div></div>
                <div class="bg-yellow-50 rounded p-2 border-l-4 border-yellow-500"><div class="text-lg font-bold text-yellow-700">${stats.proceso}</div><div class="text-xs text-gray-600">Proceso</div></div>
                <div class="bg-green-50 rounded p-2 border-l-4 border-green-500"><div class="text-lg font-bold text-green-700">${stats.cerradas}</div><div class="text-xs text-gray-600">Cerradas</div></div>
                <div class="bg-gray-50 rounded p-2 border-l-4 border-gray-500"><div class="text-lg font-bold text-gray-700">${stats.canceladas}</div><div class="text-xs text-gray-600">Canceladas</div></div>
            `;
        }

        function actualizarVistaGraficos() {
            Object.values(chartInstances).forEach(chart => chart?.destroy());
            chartInstances = {};
            
            const container = document.getElementById('charts-container');
            container.innerHTML = '';
            
            const graficos = [
                { id: 'show_trend', canvasId: 'trendChart', title: 'Tendencia Temporal', icon: 'fa-chart-line', color: 'blue', func: crearGraficoTendencia },
                { id: 'show_status', canvasId: 'statusChart', title: 'Por Estado', icon: 'fa-chart-pie', color: 'green', func: crearGraficoEstado },
                { id: 'show_priority', canvasId: 'priorityChart', title: 'Por Prioridad', icon: 'fa-chart-bar', color: 'orange', func: crearGraficoPrioridad },
                { id: 'show_type', canvasId: 'typeChart', title: 'Por Tipo', icon: 'fa-chart-bar', color: 'purple', func: crearGraficoTipo }
            ];
            
            graficos.forEach(g => {
                if (document.getElementById(g.id).checked) {
                    const div = document.createElement('div');
                    div.className = 'bg-white rounded-lg shadow-md p-3';
                    div.innerHTML = `
                        <h3 class="text-sm font-semibold text-gray-800 mb-2">
                            <i class="fas ${g.icon} mr-1 text-${g.color}-600"></i>${g.title}
                        </h3>
                        <div class="chart-container"><canvas id="${g.canvasId}"></canvas></div>
                    `;
                    container.appendChild(div);
                    setTimeout(() => g.func(g.canvasId), 100);
                }
            });
        }

        function crearGraficoTendencia(canvasId) {
            const trendData = {};
            currentData.forEach(inc => {
                const fecha = inc.fecha_reporte.split(' ')[0];
                trendData[fecha] = (trendData[fecha] || 0) + 1;
            });
            chartInstances.trend = new Chart(document.getElementById(canvasId), {
                type: 'line',
                data: {
                    labels: Object.keys(trendData).sort(),
                    datasets: [{
                        label: 'Incidencias',
                        data: Object.values(trendData),
                        borderColor: 'rgb(59, 130, 246)',
                        tension: 0.4,
                        fill: true,
                        backgroundColor: 'rgba(59, 130, 246, 0.1)'
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function crearGraficoEstado(canvasId) {
            const estadoData = {};
            currentData.forEach(inc => estadoData[inc.estado] = (estadoData[inc.estado] || 0) + 1);
            chartInstances.status = new Chart(document.getElementById(canvasId), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(estadoData).map(e => e.replace('_', ' ').toUpperCase()),
                    datasets: [{ data: Object.values(estadoData), backgroundColor: ['#ef4444', '#f59e0b', '#10b981', '#6b7280'] }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function crearGraficoPrioridad(canvasId) {
            const prioridadData = {};
            currentData.forEach(inc => prioridadData[inc.prioridad] = (prioridadData[inc.prioridad] || 0) + 1);
            chartInstances.priority = new Chart(document.getElementById(canvasId), {
                type: 'bar',
                data: {
                    labels: Object.keys(prioridadData).map(p => p.toUpperCase()),
                    datasets: [{ label: 'Cantidad', data: Object.values(prioridadData), backgroundColor: ['#10b981', '#f59e0b', '#f97316', '#ef4444'] }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function crearGraficoTipo(canvasId) {
            const tipoData = {};
            currentData.forEach(inc => {
                const tipo = inc.tipo_nombre || 'Sin tipo';
                tipoData[tipo] = (tipoData[tipo] || 0) + 1;
            });
            chartInstances.type = new Chart(document.getElementById(canvasId), {
                type: 'bar',
                data: {
                    labels: Object.keys(tipoData),
                    datasets: [{ label: 'Cantidad', data: Object.values(tipoData), backgroundColor: '#8b5cf6' }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function actualizarTabla(data) {
            const tbody = document.getElementById('detailTableBody');
            const start = (currentPage - 1) * itemsPerPage;
            const pageData = data.slice(start, start + itemsPerPage);
            document.getElementById('total-registros').textContent = data.length;
            
            if (pageData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4">No hay datos</td></tr>';
                return;
            }
            
            tbody.innerHTML = pageData.map(inc => `
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-2 py-2">#${inc.id_incidencia}</td>
                    <td class="px-2 py-2">${inc.titulo.substring(0, 30)}...</td>
                    <td class="px-2 py-2"><span class="px-2 py-1 rounded text-xs ${getEstadoClass(inc.estado)}">${inc.estado.replace('_',' ')}</span></td>
                    <td class="px-2 py-2"><span class="px-2 py-1 rounded text-xs ${getPrioridadClass(inc.prioridad)}">${inc.prioridad}</span></td>
                    <td class="px-2 py-2">${inc.tipo_nombre || 'N/A'}</td>
                    <td class="px-2 py-2">${new Date(inc.fecha_reporte).toLocaleDateString('es-ES')}</td>
                </tr>
            `).join('');
            
            const totalPages = Math.ceil(data.length / itemsPerPage);
            document.getElementById('pagination').innerHTML = totalPages > 1 ?
                Array.from({length: totalPages}, (_, i) => i + 1).map(i => 
                    `<button onclick="cambiarPagina(${i})" class="px-2 py-1 text-xs rounded ${i === currentPage ? 'bg-blue-600 text-white' : 'bg-gray-200'}">${i}</button>`
                ).join('') : '';
        }

        function cambiarPagina(page) {
            currentPage = page;
            actualizarTabla(currentData);
        }

        async function generarPDF() {
            const userSession = localStorage.getItem('user_session') || sessionStorage.getItem('user_session');
            if (!userSession) return;
            try {
                const session = JSON.parse(userSession);
                const response = await fetch('../generate_report.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ type: 'filtered', user_id: session.username })
                });
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `reporte_${Date.now()}.pdf`;
                a.click();
                window.URL.revokeObjectURL(url);
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function getEstadoClass(estado) {
            return {'abierta': 'bg-red-100 text-red-800', 'en_proceso': 'bg-yellow-100 text-yellow-800', 'cerrada': 'bg-green-100 text-green-800'}[estado] || '';
        }

        function getPrioridadClass(prioridad) {
            return {'baja': 'bg-green-100 text-green-800', 'media': 'bg-yellow-100 text-yellow-800', 'alta': 'bg-orange-100 text-orange-800', 'critica': 'bg-red-100 text-red-800'}[prioridad] || '';
        }

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `${{success: 'bg-green-500', error: 'bg-red-500', info: 'bg-blue-500'}[type]} text-white px-4 py-2 rounded shadow-lg text-sm`;
            toast.textContent = message;
            document.getElementById('toast-container').appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>
</body>
</html>