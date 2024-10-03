<?php include __DIR__ . '/layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-gray-800 dark:text-gray-100">Bienvenue dans l'application de Gestion des Sanctions</h1>
    
    <div class="mt-12 bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">À propos de l'application</h2>
        <p class="text-gray-700 dark:text-gray-300">
            Cette application permet de suivre les sanctions données aux étudiants de BTS SIO. 
            Elle offre une vue d'ensemble des sanctions par promotion et par étudiant, 
            facilitant ainsi la gestion et le suivi des mesures disciplinaires.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-600 dark:text-blue-400">Sanctions</h2>
            <p class="mb-4 text-gray-700 dark:text-gray-300">Gérez les sanctions des étudiants de BTS SIO.</p>
            <a href="/sanctions" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Voir les sanctions</a>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4 text-green-600 dark:text-green-400">Étudiants</h2>
            <p class="mb-4 text-gray-700 dark:text-gray-300">Consultez la liste des étudiants par promotion.</p>
            <a href="/etudiants" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Voir les étudiants</a>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4 text-purple-600 dark:text-purple-400">Promotions</h2>
            <p class="mb-4 text-gray-700 dark:text-gray-300">Gérez les promotions de BTS SIO.</p>
            <a href="/promotions" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Voir les promotions</a>
        </div>
    </div>
    
    <div class="mt-12 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Les 5 dernières sanctions</h2>
        <?php if (!empty($recentSanctions)): ?>
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Étudiant</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Raison</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentSanctions as $sanction): ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <?= $sanction->getDate()->format('d/m/Y') ?>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <?= htmlspecialchars($sanction->getEtudiant()->getPrenom() . ' ' . $sanction->getEtudiant()->getNom()) ?>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <?= htmlspecialchars($sanction->getRaison()) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-700 dark:text-gray-300">Aucune sanction récente à afficher.</p>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>