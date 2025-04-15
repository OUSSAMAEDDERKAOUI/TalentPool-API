<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentPool - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-active {
            background-color: rgba(79, 70, 229, 0.1);
            border-left: 3px solid #4f46e5;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow hidden md:block">
        <div class="p-6">
            <h1 class="text-xl font-bold text-indigo-600">TalentPool Admin</h1>
        </div>
        <nav class="mt-6 px-4 space-y-2">
            <a href="/admin/dashboard" class="block py-2 px-4 rounded hover:bg-indigo-50 text-gray-700 font-medium">
                <i class="fas fa-chart-line mr-2 text-indigo-500"></i> Dashboard
            </a>
            <a href="/admin/users" class="block py-2 px-4 rounded hover:bg-indigo-50 text-gray-700 font-medium">
                <i class="fas fa-users mr-2 text-indigo-500"></i> Utilisateurs
            </a>
            <a href="/admin/annonces" class="block py-2 px-4 rounded hover:bg-indigo-50 text-gray-700 font-medium">
                <i class="fas fa-briefcase mr-2 text-indigo-500"></i> Annonces
            </a>
            <a href="/admin/candidatures" class="block py-2 px-4 rounded hover:bg-indigo-50 text-gray-700 font-medium">
                <i class="fas fa-envelope mr-2 text-indigo-500"></i> Candidatures
            </a>
            <button onclick="logout()" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i> Déconnexion
            </button>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>

<script>
  function logout() {
        Cookies.remove('Access-Token');
        window.location.href = '/auth/login';
    }

   
</script>

</body>
</html>
