<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Modifier l'étudiant</h1>
    
    <form action="/etudiants/edit/<?= $etudiant->getId() ?>" method="POST" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="prenom">
                Prénom
            </label>
            <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($etudiant->getPrenom()) ?>" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-300" required>
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">
                Nom
            </label>
            <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($etudiant->getNom()) ?>" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-300" required>
        </div>
        
             
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="promotion_id">
                Promotion
            </label>
            <select name="promotion_id" id="promotion_id" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-300" required>
                <?php foreach ($promotions as $promotion): ?>
                    <option value="<?= $promotion->getId() ?>" <?= $etudiant->getPromotion()->getId() === $promotion->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($promotion->getNom()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="flex items-center justify-end">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300" type="submit">
                Modifier l'étudiant
            </button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>