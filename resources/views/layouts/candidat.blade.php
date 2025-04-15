<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentPool - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .sidebar-active { background-color: rgba(79, 70, 229, 0.1); border-left: 3px solid #4f46e5; }
        .notification {
            transform: translateX(100%);
            animation: slideIn 0.3s forwards, slideOut 0.3s 3s forwards;
        }
        @keyframes slideIn { to { transform: translateX(0); } }
        @keyframes slideOut { to { transform: translateX(100%); } }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
            <div class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                <div class="flex items-center px-4">
                    <div class="text-xl font-bold text-indigo-600">TalentPool</div>
                </div>
                <nav class="mt-8 flex-1 px-2 space-y-1">
                  
                    <a href="/candidat/annonces" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        <i class="fas fa-briefcase mr-3 text-gray-400"></i> Annonces
                    </a>
                    <a href="/candidat/candidatures" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        <i class="fas fa-user-tie mr-3 text-gray-400"></i> Candidatures
                    </a>
                    <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        <i class="fas fa-chart-line mr-3 text-gray-400"></i> Statistiques
                    </a>
                    <button onclick="logout()" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i> Déconnexion
                    </button>
                </nav>
            </div>

            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                <div class="flex items-center">
                    <div>
                        <img id="userPhoto" class="inline-block h-9 w-9 rounded-full" src="https://via.placeholder.com/36x36.png" alt="Photo">
                    </div>
                    <div class="ml-3">
                        <p id="userName" class="text-sm font-medium text-gray-700">Chargement...</p>
                        <a href="#" class="text-xs font-medium text-gray-500 hover:text-gray-700">Voir profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-auto focus:outline-none">
        <main class="flex-1 relative overflow-y-auto my-4 px-6">
            @yield('content')
        </main>
    </div>
</div>

<div id="notification" class="hidden fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 notification">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <span id="notificationMessage">Action réalisée avec succès</span>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
<script>
   function logout() {
        Cookies.remove('Access-Token');
        window.location.href = '/auth/login';
    }

    document.addEventListener('DOMContentLoaded', async () => {
        const token = localStorage.getItem('token');
        if (!token) return;

        try {
            const res = await fetch('/api/me', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            const user = await res.json();

            const photoUrl = `/storage/${user.photo}`;

        // Injecter les données dans le layout
        document.getElementById('userName').innerText = `${user.first_name ?? ''} ${user.last_name ?? ''}`;
        document.getElementById('userPhoto').src = photoUrl;
        } catch (e) {
            console.error('Erreur lors du chargement de l\'utilisateur :', e);
        }
    });
</script>
</body>
</html>
