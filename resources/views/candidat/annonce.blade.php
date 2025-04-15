@extends('layouts/candidat')
@section("title","Annonces")
@section('content')    

    <div class="container mx-auto p-6">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">📋 Offres d'emploi disponibles</h1>
    
      <div id="annonce-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </div>
    
    <script>
      async function loadAnnonces() {
        try {
          const res = await fetch('/api/annonces');
          const annonces = await res.json();
    console.log(annonces);
    
          const list = document.getElementById('annonce-list');
          list.innerHTML = '';
    
          annonces.annonces.forEach(annonce => {
            const card = document.createElement('div');
            card.className = 'bg-white shadow-lg rounded-lg p-5 border border-gray-200 transition hover:shadow-xl';
    
            card.innerHTML = `
              <h3 class="text-xl font-semibold text-emerald-600 mb-2">${annonce.title}</h3>
              <p class="text-gray-600 text-sm mb-4">${annonce.description.slice(0, 100)}...</p>
              <a href="/candidat/details?id=${annonce.id}" 
                 class="inline-block px-4 py-2 bg-emerald-500 text-white rounded hover:bg-emerald-600 transition text-sm">
                 👁️ Voir Détails
              </a>
            `;
            list.appendChild(card);
          });
        } catch (err) {
          console.error('Erreur lors du chargement :', err);
        }
      }
    
      loadAnnonces();
    </script>
    
    @endsection