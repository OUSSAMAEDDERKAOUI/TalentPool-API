document.addEventListener('DOMContentLoaded', async () => {
    const token = document.cookie.split('; ').filter((item) => item.startsWith('Access-Token='));

    if (token.length == 0) {
        alert()
        window.location.href = '/auth/login'; 
        return;
    }
    try {
        const response = await fetch('/api/candidature', {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token[0].replace('Access-Token=', '')}`,
            }
        });

        const data = await response.json();
console.log(data);
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = ''; 

        data.Candidature.forEach(candidature => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="${candidature.user.photo || '/api/placeholder/40/40'}" alt="Photo de profil">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">${candidature.user.first_name} ${candidature.user.last_name}</div>
                            <div class="text-sm text-gray-500">${candidature.title}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${candidature.annonce.titre || 'N/A'}</div>
                    <div class="text-sm text-gray-500">${candidature.annonce.type_contrat || 'N/A'} - ${candidature.annonce.lieu || 'N/A'}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${formattedDate}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                        ${statusText}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                        <button class="text-indigo-600 hover:text-indigo-900 p-1 viewCandidate" data-id="${candidature.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="text-blue-600 hover:text-blue-900 p-1 progressCandidate" data-id="${candidature.id}">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 p-1 rejectCandidate" data-id="${candidature.id}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </td>
            `;
        });

    } catch (error) {
        console.error('Erreur lors de la récupération des candidatures:', error);
    }
});


