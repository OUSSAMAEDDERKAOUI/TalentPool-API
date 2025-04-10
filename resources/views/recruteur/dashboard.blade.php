@extends('layouts.recruteur')

@section('title', 'Dashboard')
@section('content') 

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Tableau de bord</h1>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
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

        <!-- Statistiques -->
        <div class="mt-8">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                                <i class="fas fa-briefcase text-indigo-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Annonces actives</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">12</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                <i class="fas fa-user-tie text-green-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Candidatures reçues</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">48</div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                            <i class="fas fa-arrow-up mr-1"></i>
                                            <span>12%</span>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">En attente de traitement</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">16</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                <i class="fas fa-check-circle text-blue-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Candidats sélectionnés</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">8</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="bg-white shadow rounded-lg lg:col-span-2">
                <div class="px-4 py-5 sm:px-6 flex flex-wrap items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Activité de recrutement</h3>
                    <div class="mt-1 flex items-center">
                        <div class="flex space-x-1">
                            <span class="px-3 py-1 text-xs font-medium rounded-md bg-gray-100 text-gray-800">Jour</span>
                            <span class="px-3 py-1 text-xs font-medium rounded-md bg-indigo-100 text-indigo-800">Semaine</span>
                            <span class="px-3 py-1 text-xs font-medium rounded-md bg-gray-100 text-gray-800">Mois</span>
                        </div>
                    </div>
                </div>
                <div class="px-4 pb-5 sm:px-6">
                    <div class="h-64">
                        <canvas id="recruitmentChart"></canvas>
                    </div>
                </div>
            </div>










@endSection