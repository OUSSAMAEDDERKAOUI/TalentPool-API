@extends('layouts.admin') 

@section('title', 'Dashboard Admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Tableau de bord - Statistiques</h1>

    <div id="stats" class="grid grid-cols-1 md:grid-cols-3 gap-6">

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", async () => {
    const token = localStorage.getItem("token");
    const res = await fetch("http://127.0.0.1:8000/api/admin/statistics", {
        headers: {
            "Authorization": `Bearer ${token}`,
            "Accept": "application/json"
        }
    });

    const data = await res.json();

    const statsContainer = document.getElementById("stats");

    const stats = [
        { label: "Utilisateurs", value: data.totalUsers, icon: "fa-users", color: "indigo" },
        { label: "Recruteurs", value: data.totalRecruteurs, icon: "fa-user-tie", color: "green" },
        { label: "Candidats", value: data.totalCandidats, icon: "fa-user", color: "blue" },
        { label: "Annonces", value: data.totalAnnonces, icon: "fa-briefcase", color: "purple" },
        { label: "Candidatures", value: data.totalCandidatures, icon: "fa-envelope", color: "yellow" },
        { label: "Acceptées", value: data.acceptedCandidatures, icon: "fa-check", color: "emerald" },
        { label: "Refusées", value: data.refusedCandidatures, icon: "fa-times", color: "red" },
        { label: "En attente", value: data.pendingCandidatures, icon: "fa-clock", color: "orange" },
        { label: "Annonces (semaine)", value: data.newAnnoncesThisWeek, icon: "fa-calendar-plus", color: "pink" },
        { label: "Candidatures (semaine)", value: data.newCandidaturesThisWeek, icon: "fa-calendar-alt", color: "teal" }
    ];

    stats.forEach(stat => {
        statsContainer.innerHTML += `
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-${stat.color}-500">
                <div class="flex items-center space-x-4">
                    <i class="fas ${stat.icon} text-${stat.color}-600 text-2xl"></i>
                    <div>
                        <p class="text-sm text-gray-500">${stat.label}</p>
                        <p class="text-xl font-bold text-gray-800">${stat.value}</p>
                    </div>
                </div>
            </div>
        `;
    });
});
</script>
@endsection
