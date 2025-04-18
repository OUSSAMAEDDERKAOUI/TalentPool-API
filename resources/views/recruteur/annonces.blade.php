@extends('layouts/recruteur')
@section("title","Annonces")
@section('content')
<div class="mt-4">
    <div class="bg-indigo-600 rounded-lg shadow-md overflow-hidden">
        <div class="px-4 py-5 sm:p-6">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-white">Bonjour, Thomas</h3>
                    <div class="mt-2 max-w-xl text-sm text-indigo-100">
                        <p>Vous avez <span class="font-bold">16</span> candidatures en attente de traitement et <span class="font-bold">4</span> entretiens programmés cette semaine.</p>
                    </div>
                </div>
                <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                    <button id="newAnnounceBtn" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-plus mr-2"></i>
                        Nouvelle annonce
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Vos annonces récentes</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Liste de vos dernières offres d'emploi</p>
            </div>
            <div class="flex space-x-3">
                <div class="relative">
                    <input type="text" id="searchAnnounce" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Rechercher une annonce">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <div class="relative inline-block text-left">
                    <button id="filterButton" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-filter mr-2"></i>
                        Filtrer
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Titre
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col" class=" px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  
                </tbody>
        </table>
    </div>
</div>
</div>



<div id="addAnnonce" class="hidden fixed inset-0 z-180 bg-black/80 flex items-center justify-center">
    <div class="max-w-md w-full space-y-8 bg-white p-6 rounded-xl shadow-lg">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Ajouter une nouvelle annonce
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Complétez tous les champs pour publier votre offre d'emploi
            </p>
        </div>
        <form id="annonceForm"  method="POST" class="mt-8 space-y-6">
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="job-title" class="block text-sm font-medium text-gray-700">
                        Titre de l'annonce <span class="text-red-500">*</span>
                    </label>
                    <input id="job-title" name="title" type="text" required 
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                <div>
                    <label for="job-description" class="block text-sm font-medium text-gray-700">
                        Description de l'annonce <span class="text-red-500">*</span>
                    </label>
                    <textarea id="job-description" name="description" rows="8" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"
                        placeholder="Décrivez le poste, les responsabilités et les compétences requises..."></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button"  id="clsAnnounceBtn"
                    class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Annuler
                </button>
                <button id="addButton" type="submit" 
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-save mr-2"></i>
                    Publier immédiatement
                </button>
            </div>
        </form>
    </div>
</div>

<div id="editAnnonce" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg shadow-lg">
      <h2 class="text-xl font-bold mb-4">Modifier l'annonce</h2>
      <form id="editForm">
        <input type="hidden" name="id" id="edit-id">
        <div class="mb-4">
          <label for="edit-title" class="block text-sm font-medium text-gray-700">Titre</label>
          <input type="text" name="title" id="edit-title" class="mt-1 block w-full border p-2 rounded" required>
        </div>
        <div class="mb-4">
          <label for="edit-description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea name="description" id="edit-description" class="mt-1 block w-full border p-2 rounded" rows="5" required></textarea>
        </div>
        <div class="flex justify-end space-x-2">
          <button type="button" id="cancelEdit" class="bg-gray-200 px-4 py-2 rounded">Annuler</button>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
  










<script src="{{asset('/js/recruteur/annonces.js') }}"></script>





@endsection