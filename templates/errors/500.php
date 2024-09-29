<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-6 text-red-600 dark:text-red-400">Erreur 500 - Erreur Interne du Serveur</h1>
        
        <p class="mb-4 text-gray-700 dark:text-gray-300">Nous sommes désolés, mais une erreur inattendue s'est produite sur notre serveur.</p>
        
        <p class="mb-4 text-gray-700 dark:text-gray-300">Notre équipe technique a été informée et travaille à résoudre le problème.</p>
        
        <?php if (isset($error) && $_ENV['APP_ENV'] === 'dev'): ?>
            <div class="mt-6 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 rounded">
                <h2 class="text-xl font-bold mb-2">Détails de l'erreur (visible uniquement en mode debug) :</h2>
                <pre class="whitespace-pre-wrap"><?= htmlspecialchars($error) ?></pre>
            </div>
        <?php endif; ?>
        
        <div class="mt-6">
            <a href="/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Retour à la page d'accueil
            </a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>