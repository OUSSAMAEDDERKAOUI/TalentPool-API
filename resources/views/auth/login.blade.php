{{-- 
<html lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentPool - Dashboard Recruteur</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
<body>
    <div class="min-h-screen bg-[url('./image/recrutement.jpg')] bg-cover bg-center flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40"></div>
        
        <div class="relative z-10 w-full max-w-md">
          <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/20">
            <div class="text-center mb-8">
              <h1 class="text-4xl font-bold text-white mb-3">Bienvenue</h1>
              <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
            </div>
    
            <form id="loginForm" class="space-y-6">
              <div class="space-y-2">
                <div class="relative">
                  <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-xl text-white placeholder-white/50 focus:outline-none focus:border-blue-500 transition-all duration-300"
                    placeholder="Email"
                  >
                  <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                  </svg>
                </div>
              </div>
    
              <div class="space-y-2">
                <div class="relative">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-xl text-white placeholder-white/50 focus:outline-none focus:border-blue-500 transition-all duration-300"
                    placeholder="Mot de passe"
                  >
                  <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                </div>
              </div>
    
              <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-white/80 hover:text-white cursor-pointer">
                  <input type="checkbox" class="w-4 h-4 rounded border-white/20 bg-white/5 text-blue-500 focus:ring-blue-500 focus:ring-offset-0">
                  <span class="ml-2">Se souvenir de moi</span>
                </label>
                <a href="#" class="text-white/80 hover:text-white transition-colors duration-200">
                  Mot de passe oublié ?
                </a>
              </div>
    
              <button
                type="submit"
                class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-medium hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5"
              >
                Se connecter
              </button>
    
              <div class="text-center mt-6">
                <p class="text-white/80">
                  Pas encore de compte ?
                  <a href="#" class="text-blue-400 hover:text-blue-300 font-medium ml-1">
                    S'inscrire
                  </a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    
</body>
<script>
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
    
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
    
        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            });
    
            const data = await response.json();
    
            if (response.ok) {
                alert('Connexion réussie !');
                console.log('Token:', data.token); 
    
                window.location.href = "/auth/register"; 
            } else {
                alert(data.message || "Échec de connexion");
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert("Une erreur s'est produite");
        }
    });
    </script>
    

</html> --}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentPool - Dashboard Recruteur</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="min-h-screen bg-[url('./image/recrutement.jpg')] bg-cover bg-center flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40"></div>
        
        <div class="relative z-10 w-full max-w-md">
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/20">
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-white mb-3">Bienvenue</h1>
                    <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
                </div>

                <form id="loginForm" class="space-y-6">
                    <div class="space-y-2">
                        <div class="relative">
                            <input type="email" id="email" name="email" required
                                class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-xl text-white placeholder-white/50 focus:outline-none focus:border-blue-500 transition-all duration-300"
                                placeholder="Email">
                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-xl text-white placeholder-white/50 focus:outline-none focus:border-blue-500 transition-all duration-300"
                                placeholder="Mot de passe">
                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center text-white/80 hover:text-white cursor-pointer">
                            <input type="checkbox"
                                class="w-4 h-4 rounded border-white/20 bg-white/5 text-blue-500 focus:ring-blue-500 focus:ring-offset-0">
                            <span class="ml-2">Se souvenir de moi</span>
                        </label>
                        <a href="#" class="text-white/80 hover:text-white transition-colors duration-200">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-medium hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                        Se connecter
                    </button>

                    <div class="text-center mt-6">
                        <p class="text-white/80">
                            Pas encore de compte ?
                            <a href="#" class="text-blue-400 hover:text-blue-300 font-medium ml-1">
                                S'inscrire
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Rediriger automatiquement si déjà connecté
        if (localStorage.getItem('token')) {
            window.location.href = "/recruteur/annonces"; 
        }

        document.getElementById('loginForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok) {

                  localStorage.setItem('token', data.authorisation.token);

                    alert('Connexion réussie !');
                    window.location.href = "/recruteur/annonces"; 
                } else {
                    alert(data.message || "Échec de connexion");
                }
            } catch (error) {
                console.error('Erreur:', error);
                alert("Une erreur s'est produite");
            }
        });
    </script>
</body>
</html>
