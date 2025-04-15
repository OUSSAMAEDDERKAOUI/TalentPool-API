


<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Création d'une page d'inscription dynamique</title>
  </head>
  <body>
    <div id="app"></div>
  

<script>
document.querySelector('#app').innerHTML = `
<div class="min-h-screen bg-[url('{{ asset('storage/background_image/Recrutement-prédictif.png') }}')] bg-cover bg-center flex items-center justify-center p-4">
    <!-- Overlay avec effet de dégradé -->
    <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-black/50 to-black/30 backdrop-blur-[2px]"></div>
    
    <div class="relative min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
      <div class="max-w-2xl w-full space-y-8 relative">
        <!-- Container principal avec effet glassmorphism -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/20">
          <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-white mb-2">Inscription</h2>
            <div class="h-1 w-24 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
          </div>

          <form id="registrationForm" class="space-y-6 max-h-[70vh] overflow-y-auto custom-scrollbar">
            <!-- Les champs du formulaire avec style amélioré -->
            <div class="form-group">
              <label class="text-white/90 font-medium mb-2 block" for="role">Rôle </label>
              <select id="role" name="role" class="form-select-modern" required>
                <option value="">Sélectionnez un rôle</option>
                <option value="recruteur">Recruteur</option>
                <option value="candidat">Candidat</option>
              </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="form-group">
                <label class="  text-white/90 font-medium mb-2 block" for="firstName">Prénom </label>
                <input type="text" id="firstName" name="first_name" class=" px-1 border border-black rounded-lg" required>
              </div>

              <div class="form-group">
                <label class="text-white/90 font-medium mb-2 block" for="lastName">Nom </label>
                <input type="text" id="lastName" name="last_name" class="px-1 border border-black rounded-lg" required>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="form-group">
                <label class="text-white/90 font-medium mb-2 block" for="phone">Téléphone </label>
                <input type="tel" id="phone" name="phone" class="px-1 border border-black rounded-lg" required>
              </div>

              <div class="form-group">
                <label class="text-white/90 font-medium mb-2 block" for="email">Email </label>
                <input type="email" id="email" name="email" class="px-1 border border-black rounded-lg" required>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="form-group">
                <label class="text-white/90 font-medium mb-2 block" for="password">Mot de passe </label>
                <input type="password" id="password" name="password" class="px-1 border border-black rounded-lg" required>
              </div>

                <div class="form-group">
              <label class="text-white/90 font-medium mb-2 block" for="photo">Photo</label>
              <input type="file" id="photo" name="photo" class="form-file-modern" accept="image/">
            </div>

            </div>

          

            <!-- Champs Recruteur -->
            <div id="recruiterFields" class="hidden space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                  <label class="text-white/90 font-medium mb-2 block" for="company">Entreprise </label>
                  <input type="text" id="company" name="company" class="px-1 border border-black rounded-lg">
                </div>

                <div class="form-group">
                  <label class="text-white/90 font-medium mb-2 block" for="sector">Secteur </label>
                  <input type="text" id="sector" name="sector" class="px-1 border border-black rounded-lg">
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                  <label class="text-white/90 font-medium mb-2 block" for="position">Poste </label>
                  <input type="text" id="position" name="poste" class="px-1 border border-black rounded-lg">
                </div>

                <div class="form-group">
                  <label class="text-white/90 font-medium mb-2 block" for="city">Ville </label>
                  <input type="text" id="city" name="city" class="px-1 border border-black rounded-lg">
                </div>
              </div>
            </div>

            <!-- Champs Candidat -->
            <div id="candidateFields" class="hidden space-y-6">
              <div class="form-group">
                <label class="text-white/90 font-medium mb-2 block" for="education">Niveau d'étude </label>
                <input type="text" id="niveau" name="niveau" class="px-1 border border-black rounded-lg">
              </div>

              <div class="form-group">
                <label class="text-white/90 font-medium mb-2 block" for="experience">Expérience professionnelle </label>
                <textarea id="experience" name="experience" class="px-1 w-[550px] resize-none" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label class="text-white/90 font-medium mb-2 block" for="bio">Bio </label>
                <textarea id="bio" name="bio" class="form-textarea-modern px-1 w-[550px] resize-none" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label class="text-white/90 font-medium mb-2 block" for="desiredPosition">Fonction souhaitée </label>
                <input type="text" id="desiredPosition" name="desiredPosition  w-[550px]" class=" px-1 border border-black rounded-lg">
              </div>
            </div>

            <div class="pt-6">
              <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium 
                transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg hover:shadow-blue-500/25 
                active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                S'inscrire
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
`

  

const form = document.getElementById('registrationForm');
const roleSelect = document.getElementById('role');
const recruiterFields = document.getElementById('recruiterFields');
const candidateFields = document.getElementById('candidateFields');

roleSelect.addEventListener('change', (e) => {
  const role = e.target.value;
  recruiterFields.classList.add('hidden');
  candidateFields.classList.add('hidden');

  if (role === 'recruteur') {
    recruiterFields.classList.remove('hidden');
    recruiterFields.querySelectorAll('input').forEach(input => input.required = true);
    candidateFields.querySelectorAll('input, textarea').forEach(input => input.required = false);
  } else if (role === 'candidat') {
    candidateFields.classList.remove('hidden');
    candidateFields.querySelectorAll('input, textarea').forEach(input => input.required = true);
    recruiterFields.querySelectorAll('input').forEach(input => input.required = false);
  }
});

// --- Soumission du formulaire
form.addEventListener('submit', async function(e) {
  e.preventDefault();

  const formData = new FormData(form);
  const data = Object.fromEntries(formData.entries());

  if (!validateForm(data)) return;

  try {
    const response = await fetch('/api/register', {
      method: 'POST',
      headers: {
        'Accept': 'application/json'
      },
      body: formData 
    });

    const result = await response.json();

    if (response.ok) {
      alert('Inscription réussie !');
      console.log('Réponse :', result);
      window.location.href = "/auth/login"; 
    } else {
      alert(result.message || "Une erreur s'est produite");
    }
  } catch (error) {
    console.error('Erreur réseau:', error);
    alert("Une erreur s'est produite");
  }
});

function validateForm(data) {
  const { first_name, last_name, phone, email, password, role } = data;

  if (!first_name || !last_name || !phone || !email || !password || !role) {
    alert('Veuillez remplir tous les champs obligatoires');
    return false;
  }

  if (role === 'recruteur') {
    if (!data.company || !data.sector || !data.poste || !data.city) {
      alert('Champs recruteur incomplets');
      return false;
    }
  } else if (role === 'candidat') {
    if (!data.niveau || !data.experience || !data.bio || !data.desiredPosition) {
      alert('Champs candidat incomplets');
      return false;
    }
  }

  return true;
}


</script>
</body>
</html>