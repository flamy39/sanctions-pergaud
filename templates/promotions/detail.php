<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Détails de la promotion : <?= htmlspecialchars($promotion->getNom()) ?></h1>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Informations générales</h2>
        <p class="mb-2"><span class="font-bold">Nom :</span> <?= htmlspecialchars($promotion->getNom()) ?></p>
        <p class="mb-2"><span class="font-bold">Année :</span> <?= $promotion->getAnnee() ?></p>
        <p class="mb-2"><span class="font-bold">Nombre d'étudiants :</span> <?= count($promotion->getEtudiants()) ?></p>
        <p class="mb-2"><span class="font-bold">Nombre total de sanctions :</span> <?= $totalSanctions ?></p>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
        <h2 class="text-2xl font-semibold p-6 bg-gray-100">Liste des étudiants</h2>
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nom
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Prénom
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nombre de sanctions
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($promotion->getEtudiants() as $etudiant): ?>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <?= htmlspecialchars($etudiant->getNom()) ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <?= htmlspecialchars($etudiant->getPrenom()) ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <?= count($etudiant->getSanctions()) ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="/etudiants/<?= $etudiant->getId() ?>" class="text-blue-600 hover:text-blue-900">Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex justify-between">
        <a href="/promotions" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Retour à la liste des promotions
        </a>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>