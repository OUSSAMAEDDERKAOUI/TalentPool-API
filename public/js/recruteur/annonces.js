
document.addEventListener('DOMContentLoaded', async () => {
    const token = Cookies.get('Access-Token');
    
    if (token.length == 0) {
        window.location.href = '/auth/login'; 
        return;
    }


    try {
        const response = await fetch('/api/annonce', {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            }
        });

        const data = await response.json();
        console.log(data);

        const tbody = document.querySelector('tbody');
        tbody.innerHTML = '';

        data.annonces.forEach(annonce => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${annonce.title}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${annonce.created_at}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                        annonce.status === 'actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                    }">
                        ${annonce.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                        <button class="text-indigo-600 hover:text-indigo-900 p-1"><i class="fas fa-eye"></i></button>
                        <button class="text-blue-600 hover:text-blue-900 p-1 editButton" data-id="${annonce.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 p-1 deleteButton" data-id="${annonce.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            `;

            // Gérer la modification
            const editButton = row.querySelector('.editButton');
            editButton.addEventListener('click', () => {
                document.getElementById('edit-id').value = annonce.id;
                document.getElementById('edit-title').value = annonce.title;
                document.getElementById('edit-description').value = annonce.description;
                document.getElementById('editAnnonce').classList.remove('hidden');
            });

            // Gérer la suppression
            const deleteButton = row.querySelector('.deleteButton');
            deleteButton.addEventListener('click', async (e) => {
                const annonceId = e.currentTarget.getAttribute('data-id');
                if (confirm("Êtes-vous sûr de vouloir supprimer cette annonce ?")) {
                    try {
                        const deleteResponse = await fetch(`/api/annonce/${annonceId}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${token}`,
                            }
                        });

                        if (deleteResponse.ok) {
                            alert('Annonce supprimée');
                            row.remove();
                        } else {
                            alert("Erreur lors de la suppression de l'annonce");
                        }
                    } catch (error) {
                        console.error('Erreur lors de la suppression de l\'annonce:', error);
                        alert('Erreur lors de la suppression');
                    }
                }
            });

            tbody.appendChild(row);
        });
    } catch (error) {
        console.error('Erreur lors de la récupération des annonces:', error);
    }

    // Bouton pour ouvrir la modale d'ajout
    document.getElementById('newAnnounceBtn').onclick = function(){
        document.getElementById('addAnnonce').classList.remove('hidden');
    };
    
    // Bouton pour fermer la modale d'ajout
    document.getElementById('clsAnnounceBtn').onclick = function(){
        document.getElementById('addAnnonce').classList.add('hidden');
    };

    // Gestion du formulaire d'ajout
    const form = document.getElementById('annonceForm');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('/api/annonce', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Ajout réussie !');
                    const tbody = document.querySelector('tbody');
                    const newRow = `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">${data.title}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Now</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    actif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                        <button class="text-indigo-600 hover:text-indigo-900 p-1"><i class="fas fa-eye"></i></button>
                        <button class="text-blue-600 hover:text-blue-900 p-1 editButton" data-id="${annonce.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 p-1 deleteButton" data-id="${annonce.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', newRow);
                    document.getElementById('addAnnonce').classList.add('hidden');
                    form.reset();
                } else {
                    alert(result.message || "Une erreur s'est produite");
                }
            } catch (error) {
                console.error('Erreur réseau:', error);
                alert("Une erreur s'est produite");
            }
        });
    }

    // Gestion du formulaire d'édition
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('edit-id').value;
            const title = document.getElementById('edit-title').value;
            const description = document.getElementById('edit-description').value;

            try {
                const response = await fetch(`/api/annonce/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify({ title, description })
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Annonce mise à jour avec succès');
                    document.getElementById('editAnnonce').classList.add('hidden');
                    // Mettre à jour la ligne dans le tableau sans rechargement
                    const rowToUpdate = document.querySelector(`button[data-id="${id}"]`).closest('tr');
                    if (rowToUpdate) {
                        const titleCell = rowToUpdate.querySelector('td:first-child div');
                        if (titleCell) titleCell.textContent = title;
                    }
                } else {
                    alert(result.message || 'Erreur lors de la mise à jour');
                }
            } catch (err) {
                console.error('Erreur de mise à jour:', err);
                alert('Erreur réseau');
            }
        });
    }

    // Bouton pour fermer la modale d'édition
    const cancelEdit = document.getElementById('cancelEdit');
    if (cancelEdit) {
        cancelEdit.addEventListener('click', () => {
            document.getElementById('editAnnonce').classList.add('hidden');
        });
    }
});