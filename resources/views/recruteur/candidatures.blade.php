@extends('layouts/recruteur')
@section("title","Candidature")
@section('content')

<div class="mt-8">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Candidatures reçues</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Liste des candidats qui ont postulé à vos offres</p>
            </div>
            <div class="flex space-x-3">
                <div class="relative">
                    <input type="text" id="searchCandidate" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Rechercher un candidat">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <div class="relative inline-block text-left">
                    <button id="filterCandidateButton" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-filter mr-2"></i>
                        Filtrer
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full  divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Candidat
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Annonce
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date de candidature
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="candidatesTable">
                    <!-- Le tableau sera rempli via JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Loading indicator -->
        <div id="loadingIndicator" class="flex justify-center p-6">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
        </div>
        
        <!-- Empty state -->
        <div id="emptyState" class="hidden flex flex-col items-center justify-center p-10">
            <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune candidature</h3>
            <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore reçu de candidatures.</p>
        </div>
       
<!-- Candidate Detail Modal -->
<div id="candidateDetailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-xl font-medium text-gray-900">Détails du candidat</h3>
            <button id="closeDetailModal" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mt-4">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3">
                    <div class="flex flex-col items-center">
                        <img id="candidatPhoto" class="h-32 w-32 rounded-full mb-4" src="/api/placeholder/128/128" alt="Photo de profil">
                        <h3 class="text-lg font-medium text-gray-900" id="modalCandidateName">Chargement...</h3>
                        <p class="text-sm text-gray-500" id="modalCandidateEmail">Chargement...</p>
                        <div class="mt-4 flex space-x-3">
                            <a href="#" class="text-gray-500 hover:text-gray-700">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-700">
                                <i class="fab fa-github text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-globe text-xl"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Documents</h4>
                        <div class="space-y-2">
                            <a id="candidatCv" href="#" class="flex items-center p-2 rounded-md hover:bg-gray-50">
                                <i class="far fa-file-pdf text-red-500 mr-2"></i>
                                <span class="text-sm">CV</span>
                            </a>
                            <a href="#" class="flex items-center p-2 rounded-md hover:bg-gray-50">
                                <i class="far fa-file-alt text-blue-500 mr-2"></i>
                                <span class="text-sm">Lettre de motivation</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="md:w-2/3 mt-6 md:mt-0 md:pl-6">
                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Informations personnelles</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Téléphone</p>
                                <p id="candidatPhone" class="text-sm">Chargement...</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Fonction</p>
                                <p id="candidatFonction" class="text-sm">Chargement...</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Niveau</p>
                                <p id="candidatNiveau" class="text-sm">Chargement...</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Expérience</p>
                                <p id="candidatExperience" class="text-sm">Chargement...</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Bio</h4>
                        <div class="bg-gray-50 p-3 rounded-md">
                            <p id="candidatBio" class="text-sm text-gray-700">Chargement...</p>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Lettre de motivation</h4>
                        <div class="bg-gray-50 p-3 rounded-md">
                            <p id="lettreMotivation" class="text-sm text-gray-700">Chargement...</p>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Notes</h4>
                        <div class="bg-gray-50 p-3 rounded-md">
                            <p class="text-sm text-gray-700">Notes sur le candidat...</p>
                            <p class="text-xs text-gray-500 mt-2">Ajouté par l'admin le {{ date('d/m/Y') }}</p>
                        </div>
                        
                        <div class="mt-3">
                            <textarea class="w-full p-2 border border-gray-300 rounded-md" rows="3" placeholder="Ajouter une note..."></textarea>
                            <div class="mt-2 flex justify-end">
                                <button class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Contacter
                        </button>
                        <button id="acceptButton" data-id="" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-green-700 hover:bg-green-50">
                            Accepter
                        </button>
                        <button id="rejectButton" data-id="" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-red-700 hover:bg-red-50">
                            Rejeter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
// document.addEventListener('DOMContentLoaded', async () => {
//     const token = localStorage.getItem('token');

//     if (!token) {
//         window.location.href = '/auth/login'; 
//         return;
//     }
//     try {
//         const response = await fetch('/api/candidature', {
//             headers: {
//                 'Accept': 'application/json',
//                 'Authorization': `Bearer ${token}`,
//             }
//         });

//         const data = await response.json();
// console.log(data);
//         const tbody = document.querySelector('tbody');
//         tbody.innerHTML = ''; 

//         data.Candidature.forEach(candidature => {
//             const row = `
//                 <tr>
//                     <td class="px-6 py-4 whitespace-nowrap">
//                         <div class="text-sm font-medium text-gray-900">${candidature.lettre_motivation}</div>
//                     </td>
//                     <td class="px-6 py-4 whitespace-nowrap">
//                         <div class="text-sm text-gray-900">${candidature.created_at}</div>
//                     </td>
//                     <td class="px-6 py-4 whitespace-nowrap">
//                         <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
//                             candidature.status === 'accepté' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                         }">
//                             ${candidature.status}
//                         </span>
//                     </td>
//                     <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
//                         <div class="flex justify-end space-x-2">
//                             <button class="text-indigo-600 hover:text-indigo-900 p-1"><i class="fas fa-eye"></i></button>
//                             <button class="text-blue-600 hover:text-blue-900 p-1"><i class="fas fa-edit"></i></button>
//                             <button class="text-red-600 hover:text-red-900 p-1"><i class="fas fa-trash"></i></button>
//                         </div>
//                     </td>
//                 </tr>
//             `;
//             tbody.insertAdjacentHTML('beforeend', row);
//         });

//     } catch (error) {
//         console.error('Erreur lors de la récupération des candidatures:', error);
//     }
// });

document.addEventListener('DOMContentLoaded', async () => {
    const token = localStorage.getItem('token');
    const candidatesTable = document.getElementById('candidatesTable');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const emptyState = document.getElementById('emptyState');
    const candidateDetailModal = document.getElementById('candidateDetailModal');
    const closeDetailModal = document.getElementById('closeDetailModal');
    const acceptButton = document.getElementById('acceptButton');
    const rejectButton = document.getElementById('rejectButton');

    if (!token) {
        window.location.href = '/auth/login'; 
        return;
    }

    // Fonction pour fermer le modal
    function closeModal() {
        candidateDetailModal.classList.add('hidden');
    }

    // Fonction pour ouvrir le modal et charger les détails de la candidature
    async function openCandidateDetail(candidatureId) {
        try {
            // Afficher le modal avant le chargement des données
            candidateDetailModal.classList.remove('hidden');
            
            // Définir des valeurs par défaut pour éviter les erreurs
            document.getElementById('modalCandidateName').textContent = 'Chargement...';
            document.getElementById('modalCandidateEmail').textContent = 'Chargement...';
            document.getElementById('candidatPhone').textContent = 'Chargement...';
            document.getElementById('candidatFonction').textContent = 'Chargement...';
            document.getElementById('candidatNiveau').textContent = 'Chargement...';
            document.getElementById('candidatExperience').textContent = 'Chargement...';
            document.getElementById('candidatBio').textContent = 'Chargement...';
            document.getElementById('lettreMotivation').textContent = 'Chargement...';
            
            console.log(`Chargement des détails pour la candidature ${candidatureId}`);
            
            // Rechercher la candidature dans les données déjà chargées
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
            const candidature = data.Candidature.find(c => c.id == candidatureId);
            
            if (!candidature) {
                throw new Error('Candidature non trouvée');
            }
            
            console.log('Détails de la candidature:', candidature);
            
            // Extraire les informations du candidat
            const candidat = candidature.candidat;
            
            if (candidat) {
                document.getElementById('modalCandidateName').textContent = `${candidat.first_name} ${candidat.last_name}`;
                document.getElementById('modalCandidateEmail').textContent = candidat.email || 'Email non disponible';
                document.getElementById('candidatPhone').textContent = candidat.phone || 'Téléphone non disponible';
            } else {
                document.getElementById('modalCandidateName').textContent = 'Informations non disponibles';
                document.getElementById('modalCandidateEmail').textContent = 'Email non disponible';
                document.getElementById('candidatPhone').textContent = 'Téléphone non disponible';
            }
            
            // Remplir les autres champs avec des informations disponibles ou des valeurs par défaut
            document.getElementById('candidatFonction').textContent = candidat?.role || 'Non spécifié';
            document.getElementById('candidatNiveau').textContent = 'Non spécifié';
            document.getElementById('candidatExperience').textContent = 'Non spécifié';
            document.getElementById('candidatBio').textContent = 'Aucune bio disponible';
            document.getElementById('lettreMotivation').textContent = candidature.lettre_motivation || 'Aucune lettre disponible';
            
            // Mettre à jour les liens de téléchargement des documents
            const cvLink = document.getElementById('candidatCv');
            if (candidature.cv) {
                cvLink.href = `/storage/cv/${candidature.cv}`;
                cvLink.innerHTML = '<i class="far fa-file-pdf text-red-500 mr-2"></i><span class="text-sm">CV</span>';
            } else {
                cvLink.href = '#';
                cvLink.innerHTML = '<i class="far fa-file-pdf text-gray-400 mr-2"></i><span class="text-sm">CV non disponible</span>';
            }

            // Mettre à jour les data-id pour les boutons d'action
            acceptButton.dataset.id = candidatureId;
            rejectButton.dataset.id = candidatureId;
            
            // Photo de profil
            if (candidat?.photo) {
                document.getElementById('candidatPhoto').src = `/storage/${candidat.photo}`;
            } else {
                document.getElementById('candidatPhoto').src = "/api/placeholder/128/128";
            }
            
        } catch (error) {
            console.error('Erreur détaillée lors du chargement des détails:', error);
            alert('Impossible de charger les détails de cette candidature');
            closeModal();
        }
    }

    // Gestionnaire pour fermer le modal
    closeDetailModal.addEventListener('click', closeModal);

    // Gestionnaires pour les boutons accepter/rejeter
    acceptButton.addEventListener('click', async function() {
        const candidatureId = this.dataset.id;
        await updateCandidatureStatus(candidatureId, 'accepté');
    });

    rejectButton.addEventListener('click', async function() {
        const candidatureId = this.dataset.id;
        await updateCandidatureStatus(candidatureId, 'refusé');
    });

    // Fonction pour mettre à jour le statut d'une candidature
    async function updateCandidatureStatus(candidatureId, status) {
        const response = await fetch(`/api/candidature/${candidatureId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify({ status })
        });

        closeModal();
        loadCandidatures();

    
}


    async function loadCandidatures() {
        try {
            loadingIndicator.classList.remove('hidden');
            emptyState.classList.add('hidden');
            candidatesTable.innerHTML = '';

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
            console.log('Liste des candidatures:', data);
            
            loadingIndicator.classList.add('hidden');

            if (!data.Candidature || data.Candidature.length === 0) {
                emptyState.classList.remove('hidden');
                return;
            }

            data.Candidature.forEach(candidature => {
                // Créer la ligne du tableau
                const row = document.createElement('tr');
                
                // Extraire les informations du candidat
                const candidat = candidature.candidat;
                let candidatName = 'Candidat inconnu';
                let candidatEmail = '';
                let candidatPhoto = '/api/placeholder/40/40';
                
                if (candidat) {
                    candidatName = `${candidat.first_name} ${candidat.last_name}`;
                    candidatEmail = candidat.email || '';
                    candidatPhoto = candidat.photo ? `/storage/${candidat.photo}` : '/api/placeholder/40/40';
                }
                
                // Extraire les informations de l'annonce
                const annonce = candidature.annonce;
                let annonceTitle = `Annonce #${candidature.annonce_id}`;
                
                if (annonce) {
                    annonceTitle = annonce.title || `Annonce #${candidature.annonce_id}`;
                }
                
                // Définir la classe de statut
                let statusClass = 'bg-yellow-100 text-yellow-800'; // Par défaut pour "en_attente"
                
                if (candidature.status === 'accepté') {
                    statusClass = 'bg-green-100 text-green-800';
                } else if (candidature.status === 'refusé') {
                    statusClass = 'bg-red-100 text-red-800';
                }
                
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="${candidatPhoto}" alt="Photo candidat">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${candidatName}</div>
                                <div class="text-sm text-gray-500">${candidatEmail}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">${annonceTitle}</div>
                        <div class="text-xs text-gray-500">ID: ${candidature.annonce_id}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${new Date(candidature.created_at).toLocaleDateString('fr-FR')}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                            ${candidature.status || 'en_attente'}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <button class="view-candidate text-indigo-600 hover:text-indigo-900 p-1" data-id="${candidature.id}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900 p-1 delete-candidate" data-id="${candidature.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                candidatesTable.appendChild(row);
            });

            // Ajouter les event listeners pour les boutons de détail
            document.querySelectorAll('.view-candidate').forEach(button => {
                button.addEventListener('click', function() {
                    openCandidateDetail(this.dataset.id);
                });
            });

            // Ajouter les event listeners pour les boutons de suppression
            document.querySelectorAll('.delete-candidate').forEach(button => {
                button.addEventListener('click', function() {
                    if (confirm("Êtes-vous sûr de vouloir supprimer cette candidature ?")) {
                        deleteCandidature(this.dataset.id);
                    }
                });
            });

        } catch (error) {
            loadingIndicator.classList.add('hidden');
            console.error('Erreur détaillée lors de la récupération des candidatures:', error);
            alert('Impossible de récupérer les candidatures');
        }
    }

    // Fonction pour supprimer une candidature
    async function deleteCandidature(candidatureId) {
        try {
            const response = await fetch(`/api/candidature/${candidatureId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`,
                }
            });

            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }

            const data = await response.json();
            console.log('Réponse de suppression:', data);
            
            alert('Candidature supprimée avec succès');
            loadCandidatures();
            
        } catch (error) {
            console.error('Erreur détaillée lors de la suppression:', error);
            alert('Impossible de supprimer cette candidature');
        }
    }

    // Fonction pour rechercher des candidats
    const searchInput = document.getElementById('searchCandidate');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = candidatesTable.querySelectorAll('tr');
            
            rows.forEach(row => {
                const candidateName = row.querySelector('td:first-child .text-sm.font-medium').textContent.toLowerCase();
                const candidateEmail = row.querySelector('td:first-child .text-sm.text-gray-500').textContent.toLowerCase();
                const annonceTitle = row.querySelector('td:nth-child(2) .text-sm.text-gray-900').textContent.toLowerCase();
                
                if (candidateName.includes(searchTerm) || 
                    candidateEmail.includes(searchTerm) || 
                    annonceTitle.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // Charger les candidatures au chargement de la page
    loadCandidatures();
});
</script>



@endsection 