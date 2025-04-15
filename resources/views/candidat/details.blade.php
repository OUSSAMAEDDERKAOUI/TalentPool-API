
@extends('layouts/candidat')
@section("title","Annonces")
@section('content') 
<body class="bg-gray-50 py-10 px-4">
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-emerald-600 mb-6">📩 Postuler à une annonce</h1>

    <form id="postulerForm" enctype="multipart/form-data" class="space-y-4">
      <!-- Ce champ sera rempli automatiquement via l'URL -->
      <input type="hidden" id="annonce_id" name="annonce_id">

      <div>
        <label for="cv" class="block text-sm font-medium text-gray-700">Votre CV :</label>
        <input type="file" id="cv" name="cv" required accept=".pdf,.doc,.docx"
               class="block w-full mt-1 border border-gray-300 rounded px-3 py-2">
      </div>

      <div>
        <label for="lettre" class="block text-sm font-medium text-gray-700">Lettre de motivation :</label>
        <textarea id="lettre" name="lettre" rows="4" required
                  class="block w-full mt-1 border border-gray-300 rounded px-3 py-2"></textarea>
      </div>

      <button type="submit"
              class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 transition">
        Envoyer ma candidature
      </button>
    </form>

    <div id="message" class="mt-4 text-sm font-medium"></div>
  </div>

  <script>
    // 1. Récupérer l'ID de l'annonce via l'URL
    const params = new URLSearchParams(window.location.search);
    const annonceId = params.get("id");
    document.getElementById("annonce_id").value = annonceId;

    // 2. Fonction d'envoi
    document.getElementById("postulerForm").addEventListener("submit", async function (e) {
      e.preventDefault();

      const token = localStorage.getItem("token");
      const formData = new FormData();

      const cvFile = document.getElementById("cv").files[0];
      const lettre = document.getElementById("lettre").value;

      formData.append("cv", cvFile);
      formData.append("lettre_motivation", lettre);
      formData.append("annonce_id", annonceId);

      try {
        const res = await fetch("/api/candidature", {
          method: "POST",
          headers: {
            "Authorization": `Bearer ${token}`,
            "Accept": "application/json",
          },
          body: formData,
        });

        const data = await res.json();

        if (res.ok) {
          document.getElementById("message").textContent = "✅ Candidature envoyée avec succès !";
          document.getElementById("message").classList.add("text-green-600");
          document.getElementById("postulerForm").reset();
        } else {
          document.getElementById("message").textContent = "❌ " + (data.message || "Erreur de validation");
          document.getElementById("message").classList.add("text-red-600");
        }
      } catch (error) {
        document.getElementById("message").textContent = "❌ Erreur : " + error.message;
        document.getElementById("message").classList.add("text-red-600");
      }
    });
  </script>
</body>
</html>
@endsection