<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentPool -  @yield('title')</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-active {
            background-color: rgba(79, 70, 229, 0.1);
            border-left: 3px solid #4f46e5;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notification {
            transform: translateX(100%);
            animation: slideIn 0.3s forwards, slideOut 0.3s 3s forwards;
        }

        @keyframes slideIn {
            to { transform: translateX(0); }
        }

        @keyframes slideOut {
            to { transform: translateX(100%); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
                <div class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <div class="text-xl font-bold text-indigo-600">TalentPool</div>
                    </div>
                    <nav class="mt-8 flex-1 px-2 space-y-1">
                        <a href="#" class="sidebar-active group flex items-center px-2 py-2 text-sm font-medium rounded-md text-indigo-600">
                            <i class="fas fa-chart-pie mr-3 text-indigo-500"></i>
                            Tableau de bord
                        </a>
                        <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-briefcase mr-3 text-gray-400"></i>
                            Annonces
                        </a>
                        <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-user-tie mr-3 text-gray-400"></i>
                            Candidatures
                        </a>
                        <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-users mr-3 text-gray-400"></i>
                            Candidats
                        </a>
                        <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-chart-line mr-3 text-gray-400"></i>
                            Statistiques
                        </a>
                        <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-cog mr-3 text-gray-400"></i>
                            Paramètres
                        </a>
                    </nav>
                </div>
                <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                    <div class="flex items-center">
                        <div>
                            <img class="inline-block h-9 w-9 rounded-full" src="/api/placeholder/36/36" alt="Photo de profil">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">Thomas Martin</p>
                            <a href="#" class="text-xs font-medium text-gray-500 hover:text-gray-700">Voir profil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-auto focus:outline-none">
            <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200">
                <button id="sidebarButton" class="md:hidden px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        <div class="w-full flex md:ml-0">
                            <label for="search-field" class="sr-only">Rechercher</label>
                            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                    <i class="fas fa-search h-5 w-5 ml-3"></i>
                                </div>
                                <input id="search-field" class="block w-full h-full pl-10 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm" placeholder="Rechercher" type="search">
                            </div>
                        </div>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Voir les notifications</span>
                            <div class="relative">
                                <i class="fas fa-bell h-6 w-6"></i>
                                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                            </div>
                        </button>

                        <!-- Dropdown profil -->
                        <div class="ml-3 relative">
                            <div>
                                <button id="profileDropdownBtn" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Ouvrir le menu utilisateur</span>
                                    <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="Photo de profil">
                                </button>
                            </div>
                            <div id="profileDropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Votre profil</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Déconnexion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <!-- Notification -->
          <div id="notification" class="hidden fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 notification">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span id="notificationMessage">Action réalisée avec succès</span>
            </div>
        </div>

        <main class="flex-1 relative overflow-y-auto focus:outline-none">

@yield('content');
</main>
        </body>
        </html>
