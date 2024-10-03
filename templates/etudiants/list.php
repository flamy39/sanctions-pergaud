<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Liste des étudiants</h1>
        <div class="flex space-x-4">
            <a href="/etudiants/new" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Ajouter un étudiant
            </a>
            <a href="/etudiants/import" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Importer des étudiants
            </a>
        </div>
    </div>
    
    <form action="/etudiants" method="GET" class="mb-6">
        <div class="flex items-center">
            <select name="promotion" id="promotion" class="form-select rounded-md shadow-sm mt-1 block w-full bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <option value="">Toutes les promotions</option>
                <?php foreach ($promotions as $promotion): ?>
                    <option value="<?= $promotion->getId() ?>" <?= $selectedPromotion == $promotion->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($promotion->getNom()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Filtrer
            </button>
        </div>
    </form>
    
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                        Nom
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                        Prénom
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                        Promotion
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $promotionColors = [
                    'bg-blue-100',
                    'bg-green-100',
                    'bg-yellow-100',
                    'bg-red-100',
                    'bg-indigo-100',
                    'bg-purple-100',
                    'bg-pink-100',
                ];
                $colorIndex = 0;
                $currentPromotion = null;
                ?>
                <?php foreach ($etudiants as $etudiant): ?>
                    <?php
                    if ($currentPromotion !== $etudiant->getPromotion()->getId()) {
                        $currentPromotion = $etudiant->getPromotion()->getId();
                        $colorIndex = ($colorIndex + 1) % count($promotionColors);
                    }
                    $rowColor = $selectedPromotion ? 'bg-white' : $promotionColors[$colorIndex];
                    ?>
                    <tr class="<?= $rowColor ?>">
                        <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                            <?= htmlspecialchars($etudiant->getNom()) ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                            <?= htmlspecialchars($etudiant->getPrenom()) ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                            <?= htmlspecialchars($etudiant->getPromotion()->getNom()) ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                            <a href="/etudiants/<?= $etudiant->getId() ?>" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200">Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>