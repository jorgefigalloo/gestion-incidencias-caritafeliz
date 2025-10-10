<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema de Gestión TI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../assets/css/login.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 min-h-screen flex items-center justify-center">
    <!-- Fondo con patrón -->
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
    
    <!-- Contenedor principal -->
    <div class="relative z-10 w-full max-w-md mx-4">
        <!-- Tarjeta de login -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 backdrop-blur-sm bg-opacity-95">
            <!-- Logo y título -->
            <div class="text-center mb-8">
                <div class="mx-auto w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Clínica Carita Feliz</h1>
                <p class="text-gray-600">Sistema de Gestión de TI</p>
            </div>

            <!-- Mensajes de estado -->
            <div id="message-container" class="hidden mb-4"></div>

            <!-- Formulario de login -->
            <form id="login-form" class="space-y-6">
                <!-- Campo Usuario -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Usuario
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            required
                            autocomplete="username"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Ingrese su usuario">
                    </div>
                </div>

                <!-- Campo Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            autocomplete="current-password"
                            class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Ingrese su contraseña">
                        <button 
                            type="button" 
                            id="toggle-password" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            tabindex="-1">
                            <svg id="eye-open" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eye-closed" class="hidden h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Recordarme -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember-me" 
                            name="remember-me" 
                            type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                            Recordarme
                        </label>
                    </div>
                </div>

                <!-- Botón de login -->
                <div>
                    <button 
                        type="submit" 
                        id="login-btn"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:scale-105">
                        <span id="login-text">Iniciar Sesión</span>
                        <div id="login-loading" class="hidden ml-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </button>
                </div>
            </form>

            <!-- Enlaces adicionales -->
            <div class="mt-6 text-center">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">o</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="index.php" class="text-blue-600 hover:text-blue-500 text-sm font-medium transition duration-200">
                        ← Volver al inicio
                    </a>
                </div>
            </div>

            <!-- Footer de la tarjeta -->
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">
                    © 2025 Clínica Carita Feliz. Todos los derechos reservados.
                </p>
            </div>
        </div>

        <!-- Información de usuarios demo 
        <div class="mt-6 bg-white bg-opacity-90 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-600 mb-2 font-medium">Usuarios de prueba:</p>
            <div class="text-xs text-gray-500 space-y-1">
                <p><strong>Admin:</strong> usuario: admin, contraseña: admin</p>
                <p><strong>Técnico:</strong> usuario: tecnico, contraseña: tecnico</p>
                <p><strong>Usuario:</strong> usuario: usuario, contraseña: usuario</p>
            </div>
        </div> -->
    </div>

    <!-- Toast para notificaciones -->
    <div id="toast-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        const API_URL = '../api/controllers/usuario.php';
        
        // Elementos del DOM
        const loginForm = document.getElementById('login-form');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const loginBtn = document.getElementById('login-btn');
        const loginText = document.getElementById('login-text');
        const loginLoading = document.getElementById('login-loading');
        const togglePassword = document.getElementById('toggle-password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');
        const messageContainer = document.getElementById('message-container');

        // Función para limpiar sesiones
        function clearUserSession() {
            localStorage.removeItem('user_session');
            sessionStorage.removeItem('user_session');
            localStorage.removeItem('remember_user');
        }

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

        // Función para mostrar mensaje en la tarjeta
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
        }

        // Función para ocultar mensaje
        function hideMessage() {
            messageContainer.classList.add('hidden');
        }

        // Toggle mostrar/ocultar contraseña
        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            eyeOpen.classList.toggle('hidden', type === 'text');
            eyeClosed.classList.toggle('hidden', type === 'password');
        });

        // Manejo del formulario de login
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const username = usernameInput.value.trim();
            const password = passwordInput.value;
            
            // Validaciones
            if (!username) {
                showMessage('Por favor, ingrese su usuario');
                usernameInput.focus();
                return;
            }
            
            if (!password) {
                showMessage('Por favor, ingrese su contraseña');
                passwordInput.focus();
                return;
            }

            // Mostrar loading
            loginText.textContent = '';
            loginLoading.classList.remove('hidden');
            loginBtn.disabled = true;
            hideMessage();

            try {
                const response = await fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'login',
                        username: username,
                        password: password
                    })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Login exitoso
                    showMessage('¡Inicio de sesión exitoso! Redirigiendo...', 'success');
                    
                    // Guardar información de sesión si se marcó "Recordarme"
                    const rememberMe = document.getElementById('remember-me').checked;
                    if (rememberMe) {
                        localStorage.setItem('remember_user', username);
                        localStorage.setItem('user_session', JSON.stringify({
                            username: result.user.username,
                            nombre: result.user.nombre,
                            rol: result.user.rol,
                            loginTime: new Date().getTime()
                        }));
                    } else {
                        // Si no marca recordar, solo guardar sesión temporal
                        sessionStorage.setItem('user_session', JSON.stringify({
                            username: result.user.username,
                            nombre: result.user.nombre,
                            rol: result.user.rol,
                            loginTime: new Date().getTime()
                        }));
                    }

                    // Redirigir según el rol del usuario
                    setTimeout(() => {
                        switch(result.user.rol) {
                            case 'admin':
                                window.location.href = 'index.php';
                                break;
                            case 'tecnico':
                                window.location.href = 'index.php';
                                break;
                            case 'usuario':
                                window.location.href = 'index.php';
                                break;
                            default:
                                window.location.href = 'index.php';
                        }
                    }, 1500);
                } else {
                    // Error en el login
                    showMessage(result.message || 'Credenciales incorrectas. Por favor, verifique sus datos.');
                    passwordInput.value = '';
                    passwordInput.focus();
                }
            } catch (error) {
                console.error('Error de login:', error);
                
                // Distinguir entre diferentes tipos de error
                if (error.name === 'TypeError' && error.message.includes('fetch')) {
                    showMessage('No se pudo conectar al servidor. Verifique su conexión a internet.');
                } else if (error.name === 'SyntaxError') {
                    showMessage('Error en la respuesta del servidor. Por favor, contacte al administrador.');
                } else {
                    showMessage('Error inesperado. Por favor, inténtelo nuevamente.');
                }
            } finally {
                // Ocultar loading
                loginText.textContent = 'Iniciar Sesión';
                loginLoading.classList.add('hidden');
                loginBtn.disabled = false;
            }
        });

        // Cargar usuario recordado si existe
        window.addEventListener('load', () => {
            // Verificar si ya hay una sesión activa
            const userSession = localStorage.getItem('user_session') || sessionStorage.getItem('user_session');
            if (userSession) {
                try {
                    const session = JSON.parse(userSession);
                    const currentTime = new Date().getTime();
                    const loginTime = session.loginTime;
                    const timeDiff = currentTime - loginTime;
                    
                    // Si la sesión tiene menos de 24 horas, redirigir automáticamente
                    if (timeDiff < 24 * 60 * 60 * 1000) {
                        showMessage('Sesión activa detectada. Redirigiendo...', 'success');
                        setTimeout(() => {
                            if (session.rol === 'usuario') {
                                window.location.href = 'index.php';
                            } else {
                                window.location.href = 'index.php';
                            }
                        }, 1000);
                        return;
                    } else {
                        // Sesión expirada, limpiar
                        localStorage.removeItem('user_session');
                        sessionStorage.removeItem('user_session');
                    }
                } catch (e) {
                    // Error al parsear sesión, limpiar
                    localStorage.removeItem('user_session');
                    sessionStorage.removeItem('user_session');
                }
            }

            const rememberedUser = localStorage.getItem('remember_user');
            if (rememberedUser) {
                usernameInput.value = rememberedUser;
                document.getElementById('remember-me').checked = true;
                passwordInput.focus();
            } else {
                usernameInput.focus();
            }
        });

        // Manejar tecla Enter en los campos
        usernameInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                passwordInput.focus();
            }
        });

        passwordInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                loginForm.dispatchEvent(new Event('submit'));
            }
        });

        // Limpiar mensajes cuando el usuario empiece a escribir
        usernameInput.addEventListener('input', hideMessage);
        passwordInput.addEventListener('input', hideMessage);
    </script>
</body>
</html>