<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Importer des étudiants</h1>
    
    <form action="/etudiants/import" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        <div class="mb-6">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="csv_file">
                Fichier CSV
            </label>
            <input type="file" name="csv_file" id="csv_file" accept=".csv" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="promotion_id">
                Promotion
            </label>
            <select name="promotion_id" id="promotion_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Sélectionnez une promotion</option>
                <?php foreach ($promotions as $promotion): ?>
                    <option value="<?= $promotion->getId() ?>"><?= htmlspecialchars($promotion->getNom()) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Importer les étudiants
            </button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>