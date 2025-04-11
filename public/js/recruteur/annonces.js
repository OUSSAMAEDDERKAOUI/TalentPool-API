document.addEventListener('DOMContentLoaded', async () => {
 
   

    const token = localStorage.getItem('token');

    if (!token) {
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
                        <button class="text-blue-600 hover:text-blue-900 p-1"><i class="fas fa-edit"></i></button>
                        <button class="text-red-600 hover:text-red-900 p-1 deleteButton" data-id="${annonce.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            `;

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
});
document.getElementById('newAnnounceBtn').onclick = function(){
    document.getElementById('addAnnonce').classList.remove('hidden');
}
document.getElementById('clsAnnounceBtn').onclick = function(){
    document.getElementById('addAnnonce').classList.add('hidden');
}



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
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
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
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                        'bg-green-100 text-green-800'
                    }">
                        actif
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                        <button class="text-indigo-600 hover:text-indigo-900 p-1"><i class="fas fa-eye"></i></button>
                        <button class="text-blue-600 hover:text-blue-900 p-1"><i class="fas fa-edit"></i></button>
                        <button class="text-red-600 hover:text-red-900 p-1"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', newRow);

        document.getElementById('addAnnonce').classList.add('hidden');

                    // location.reload(); 
                } else {
                    alert(result.message || "Une erreur s'est produite");
                }
            } catch (error) {
                console.error('Erreur réseau:', error);
                alert("Une erreur s'est produite");
            }
        });
    }