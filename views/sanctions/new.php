<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Ajouter une nouvelle sanction</h1>
    
    <form action="/sanctions/new" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="etudiant">
                Étudiant
            </label>
            <select name="etudiant" id="etudiant" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <?php foreach ($etudiants as $etudiant): ?>
                    <option value="<?= $etudiant->getId() ?>"><?= htmlspecialchars($etudiant->getPrenom() . ' ' . $etudiant->getNom()) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Ajoutez les autres champs du formulaire ici -->
        
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Ajouter la sanction
            </button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>