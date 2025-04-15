<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Recruteur</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- En-tête du profil -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="relative h-48 bg-indigo-600">
                <div class="absolute bottom-0 left-0 transform translate-y-1/2 ml-6">
                    <div class="h-32 w-32 bg-white p-1 rounded-full">
                        <img id="userPhoto" src="/api/placeholder/128/128" alt="Photo de profil" class="rounded-full w-full h-full object-cover">
                    </div>
                </div>
                <div class="absolute top-4 right-4">
                    <button class="bg-white text-indigo-600 px-4 py-2 rounded-md shadow text-sm font-medium">
                        <i class="fas fa-edit mr-2"></i>Modifier le profil
                    </button>
                </div>
            </div>
            
            <div class="pt-20 px-6 pb-6">
                <div class="flex flex-wrap justify-between items-center">
                    <div>
                        <h1 id="userName" class="text-2xl font-bold text-gray-900">Prénom Nom</h1>
                        <p id="userPoste" class="text-gray-600">Poste</p>
                    </div>
                    <div class="flex space-x-2 mt-4 md:mt-0">
                        <span id="userStatus" class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-semibold">
                            Statut
                        </span>
                        <span id="userCompany" class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-semibold">
                            Entreprise
                        </span>
                    </div>
                </div>
                
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Informations de contact</h2>
                        <div class="mt-4 space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-gray-500 w-6"></i>
                                <span id="userEmail" class="ml-2 text-gray-700">email@exemple.com</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-gray-500 w-6"></i>
                                <span id="userPhone" class="ml-2 text-gray-700">Téléphone</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-gray-500 w-6"></i>
                                <span id="userCity" class="ml-2 text-gray-700">Ville</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Secteur d'activité</h2>
                        <div class="mt-4">
                            <div class="flex items-center">
                                <i class="fas fa-briefcase text-gray-500 w-6"></i>
                                <span id="userSector" class="ml-2 text-gray-700">Secteur</span>
                            </div>
                            <div class="mt-4 flex flex-wrap gap-2" id="sectorTags">
                                <!-- Les tags seront remplis dynamiquement -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistiques -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <div class="text-4xl font-bold text-indigo-600" id="statsAnnonces">0</div>
                <div class="mt-2 text-gray-700">Annonces publiées</div>
            </div>
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <div class="text-4xl font-bold text-indigo-600" id="statsCandidatures">0</div>
                <div class="mt-2 text-gray-700">Candidatures reçues</div>
            </div>
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <div class="text-4xl font-bold text-indigo-600" id="statsEntretiens">0</div>
                <div class="mt-2 text-gray-700">Entretiens planifiés</div>
            </div>
        </div>
        
        <!-- Annonces actives -->
        <div class="mt-6 bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center border-b pb-2">
                <h2 class="text-lg font-semibold text-gray-800">Annonces actives</h2>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Voir toutes</a>
            </div>
            <div class="mt-4" id="annoncesList">
                <div id="loadingAnnonces" class="text-center py-8">
                    <i class="fas fa-spinner fa-spin text-indigo-600 text-2xl"></i>
                    <p class="mt-2 text-gray-600">Chargement des annonces...</p>
                </div>
                <div id="emptyAnnonces" class="hidden text-center py-8">
                    <i class="fas fa-clipboard-list text-gray-400 text-4xl"></i>
                    <p class="mt-2 text-gray-600">Aucune annonce active pour le moment</p>
                    <button class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm font-medium">
                        Créer une annonce
                    </button>
                </div>
                <!-- Les annonces seront remplies dynamiquement -->
            </div>
        </div>
        
        <!-- Candidatures récentes -->
        <div class="mt-6 bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center border-b pb-2">
                <h2 class="text-lg font-semibold text-gray-800">Candidatures récentes</h2>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Voir toutes</a>
            </div>
            <div class="mt-4" id="candidaturesList">
                <div id="loadingCandidatures" class="text-center py-8">
                    <i class="fas fa-spinner fa-spin text-indigo-600 text-2xl"></i>
                    <p class="mt-2 text-gray-600">Chargement des candidatures...</p>
                </div>
                <div id="emptyCandidatures" class="hidden text-center py-8">
                    <i class="fas fa-user-clock text-gray-400 text-4xl"></i>
                    <p class="mt-2 text-gray-600">Aucune candidature récente</p>
                </div>
                <!-- Les candidatures seront remplies dynamiquement -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const token = localStorage.getItem('token');
            
            if (!token) {
                window.location.href = '/auth/login'; 
                return;
            }
            
            // Fonction pour charger les données du recruteur
            async function loadRecruteurData() {
                try {
                    const response = await fetch('/api/recruteur/profile', {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`,
                        }
                    });
                    
                    if (!response.ok) {
                        throw new Error(`Erreur HTTP: ${response.status}`);
                    }
                    
                    const data = await response.json();
                    console.log('Données du recruteur:', data);
                    
                    // Remplir les informations du recruteur
                    if (data.user) {
                        document.getElementById('userName').textContent = `${data.user.first_name} ${data.user.last_name}`;
                        document.getElementById('userEmail').textContent = data.user.email;
                        document.getElementById('userPhone').textContent = data.user.phone;
                        document.getElementById('userStatus').textContent = data.user.status === 'actif' ? 'Actif' : 'Inactif';
                        document.getElementById('userStatus').className = data.user.status === 'actif' 
                            ? 'bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-semibold'
                            : 'bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full font-semibold';
                        
                        if (data.user.photo) {
                            document.getElementById('userPhoto').src = `/storage/${data.user.photo}`;
                        }
                    }
                    
                    if (data.recruteur) {
                        document.getElementById('userPoste').textContent = data.recruteur.poste;
                        document.getElementById('userCompany').textContent = data.recruteur.company;
                        document.getElementById('userCity').textContent = data.recruteur.city;
                        document.getElementById('userSector').textContent = data.recruteur.sector;
                        
                        // Générer des tags basés sur le secteur (simulation)
                        const sectorsArray = data.recruteur.sector.split(',').map(s => s.trim());
                        const sectorTagsContainer = document.getElementById('sectorTags');
                        sectorTagsContainer.innerHTML = '';
                        
                        sectorsArray.forEach(sector => {
                            const tag = document.createElement('span');
                            tag.className = 'bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm';
                            tag.textContent = sector;
                            sectorTagsContainer.appendChild(tag);
                        });
                    }
                    
                    // Charger les statistiques (simulation)
                    document.getElementById('statsAnnonces').textContent = data.stats?.annonces || '0';
                    document.getElementById('statsCandidatures').textContent = data.stats?.candidatures || '0';
                    document.getElementById('statsEntretiens').textContent = data.stats?.entretiens || '0';
                    
                } catch (error) {
                    console.error('Erreur lors du chargement des données du recruteur:', error);
                }
            }
            
            // Fonction pour charger les annonces actives
            async function loadAnnonces() {
                try {
                    document.getElementById('loadingAnnonces').classList.remove('hidden');
                    document.getElementById('emptyAnnonces').classList.add('hidden');
                    
                    const response = await fetch('/api/annonce', {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`,
                        }
                    });
                    
                    if (!response.ok) {
                        throw new Error(`Erreur HTTP: ${response.status}`);
                    }
                    
                    const data = await response.json();
                    console.log('Annonces:', data);
                    
                    document.getElementById('loadingAnnonces').classList.add('hidden');
                    
                    if (!data.annonces || data.annonces.length === 0) {
                        document.getElementById('emptyAnnonces').classList.remove('hidden');
                        return;
                    }
                    
                    const annoncesList = document.getElementById('annoncesList');
                    
                    // Afficher seulement les 3 premières annonces
                    const annoncesToShow = data.annonces.slice(0, 3);
                    
                    annoncesToShow.forEach(annonce => {
                        const annonceElement = document.createElement('div');
                        annonceElement.className = 'border-l-4 border-green-500 pl-4 py-2 mt-4';
                        annonceElement.innerHTML = `
                            <h3 class="font-medium text-gray-900">${annonce.title}</h3>
                            <p class="text-sm text-gray-500">${annonce.location} - ${annonce.contract_type} - Publié le ${new Date(annonce.created_at).toLocaleDateString('fr-FR')}</p>
                            <div class="mt-1 flex">
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded mr-2">${annonce.candidatures_count || 0} candidature(s)</span>
                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">${annonce.pending_count || 0} en attente</span>
                            </div>
                        `;
                        annoncesList.appendChild(annonceElement);
                    });
                    
                } catch (error) {
                    document.getElementById('loadingAnnonces').classList.add('hidden');
                    document.getElementById('emptyAnnonces').classList.remove('hidden');
                    console.error('Erreur lors du chargement des annonces:', error);
                }
            }
            
            // Fonction pour charger les candidatures récentes
            async function loadCandidatures() {
                try {
                    document.getElementById('loadingCandidatures').classList.remove('hidden');
                    document.getElementById('emptyCandidatures').classList.add('hidden');
                    
                    const response = await fetch('/api/candidature', {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`,
                        }
                    });
                    
                    if (!response.ok) {
                        throw new Error(`Erreur HTTP: ${response.status}`);
                    }
                    
                    const data = await response.json();
                    console.log('Candidatures:', data);
                    
                    document.getElementById('loadingCandidatures').classList.add('hidden');
                    
                    if (!data.Candidature || data.Candidature.length === 0) {
                        document.getElementById('emptyCandidatures').classList.remove('hidden');
                        return;
                    }
                    
                    const candidaturesList = document.getElementById('candidaturesList');
                    
                    // Afficher seulement les 3 candidatures les plus récentes
                    const candidaturesToShow = data.Candidature.slice(0, 3);
                    
                    candidaturesToShow.forEach(candidature => {
                        const candidatName = candidature.candidat ? 
                            `${candidature.candidat.first_name} ${candidature.candidat.last_name}` : 
                            'Candidat inconnu';
                        
                        const annonceTitle = candidature.annonce ? 
                            candidature.annonce.title : 
                            `Annonce #${candidature.annonce_id}`;
                        
                        let statusClass = 'bg-yellow-100 text-yellow-800';
                        if (candidature.status === 'accepté') {
                            statusClass = 'bg-green-100 text-green-800';
                        } else if (candidature.status === 'refusé') {
                            statusClass = 'bg-red-100 text-red-800';
                        }
                        
                        const candidatureElement = document.createElement('div');
                        candidatureElement.className = 'flex items-center justify-between p-3 border-b';
                        candidatureElement.innerHTML = `
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                    <img src="${candidature.candidat?.photo ? `/storage/${candidature.candidat.photo}` : '/api/placeholder/40/40'}" 
                                         alt="Photo candidat" class="w-full h-full object-cover">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">${candidatName}</p>
                                    <p class="text-xs text-gray-500">${annonceTitle}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                                    ${candidature.status || 'en_attente'}
                                </span>
                                <button class="ml-2 text-indigo-600 hover:text-indigo-900" data-id="${candidature.id}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        `;
                        candidaturesList.appendChild(candidatureElement);
                    });
                    
                    // Ajouter les événements pour voir les détails des candidatures
                    candidaturesList.querySelectorAll('button').forEach(button => {
                        button.addEventListener('click', function() {
                            const candidatureId = this.dataset.id;
                            alert(`Voir les détails de la candidature ${candidatureId}`);
                            // Ici vous pourriez rediriger vers la page de détails ou ouvrir un modal
                        });
                    });
                    
                } catch (error) {
                    document.getElementById('loadingCandidatures').classList.add('hidden');
                    document.getElementById('emptyCandidatures').classList.remove('hidden');
                    console.error('Erreur lors du chargement des candidatures:', error);
                }
            }
            
            // Initialiser la page
            loadRecruteurData();
            loadAnnonces();
            loadCandidatures();
            
            // Gestionnaire pour le bouton de modification du profil
            document.querySelector('button').addEventListener('click', () => {
                window.location.href = '/recruteur/edit-profile';
            });
        });
    </script>
</body>
</html>