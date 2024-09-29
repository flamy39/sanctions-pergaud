<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <?php if (isset($_GET['message'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= htmlspecialchars($_GET['message']) ?></span>
        </div>
    <?php endif; ?>

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Détails de l'étudiant</h1>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Informations personnelles</h2>
                <p class="mb-2"><span class="font-bold">Nom :</span> <?= htmlspecialchars($etudiant->getNom()) ?></p>
                <p class="mb-2"><span class="font-bold">Prénom :</span> <?= htmlspecialchars($etudiant->getPrenom()) ?></p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Informations académiques</h2>
                <p class="mb-2"><span class="font-bold">Promotion :</span> <?= htmlspecialchars($etudiant->getPromotion()->getNom()) ?></p>
                <p class="mb-2"><span class="font-bold">Année :</span> <?= $etudiant->getPromotion()->getAnnee() ?></p>
            </div>
        </div>
        
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Sanctions</h2>
            <?php if (count($etudiant->getSanctions()) > 0): ?>
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Raison</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Professeur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($etudiant->getSanctions() as $sanction): ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <?= $sanction->getDate()->format('d/m/Y') ?>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <?= htmlspecialchars($sanction->getRaison()) ?>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <?= htmlspecialchars($sanction->getProfesseur()->getPrenom() . ' ' . $sanction->getProfesseur()->getNom()) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-600">Aucune sanction enregistrée pour cet étudiant.</p>
            <?php endif; ?>
        </div>
        
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Ajouter une sanction</h2>
            <form action="/sanctions/new" method="POST" class="bg-gray-100 p-6 rounded-lg">
                <input type="hidden" name="etudiant_id" value="<?= $etudiant->getId() ?>">
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date :</label>
                    <input type="date" id="date" name="date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="raison" class="block text-gray-700 text-sm font-bold mb-2">Raison :</label>
                    <input type="text" id="raison" name="raison" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description :</label>
                    <textarea id="description" name="description" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3"></textarea>
                </div>
                <div class="mb-4">
                    <label for="professeur_id" class="block text-gray-700 text-sm font-bold mb-2">Professeur :</label>
                    <select id="professeur_id" name="professeur_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Sélectionnez un professeur</option>
                        <?php foreach ($professeurs as $professeur): ?>
                            <option value="<?= $professeur->getId() ?>"><?= htmlspecialchars($professeur->getPrenom() . ' ' . $professeur->getNom()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ajouter la sanction
                    </button>
                </div>
            </form>
        </div>
        
        <div class="mt-8 flex justify-between">
            <a href="/etudiants" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Retour à la liste
            </a>
            <a href="/etudiants/edit/<?= $etudiant->getId() ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Modifier l'étudiant
            </a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>