document.addEventListener('DOMContentLoaded', async () => {
    try {
        const response = await fetch('/api/annonce', {
            headers: {
                'Accept': 'application/json'
            }
        });

        const data = await response.json();
console.log(data);
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = ''; 

        data.annonces.forEach(annonce => {
            const row = `
                <tr>
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
                            <button class="text-red-600 hover:text-red-900 p-1"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
        });

    } catch (error) {
        console.error('Erreur lors de la récupération des annonces:', error);
    }
});