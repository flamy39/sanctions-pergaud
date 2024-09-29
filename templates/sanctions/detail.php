<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <?php if (isset($_GET['message'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= htmlspecialchars($_GET['message']) ?></span>
        </div>
    <?php endif; ?>

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Détails de la sanction</h1>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Informations générales</h2>
                <p class="mb-2"><span class="font-bold">Date :</span> <?= $sanction->getDate()->format('d/m/Y') ?></p>
                <p class="mb-2"><span class="font-bold">Raison :</span> <?= htmlspecialchars($sanction->getRaison()) ?></p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Personnes concernées</h2>
                <p class="mb-2"><span class="font-bold">Étudiant :</span> <?= htmlspecialchars($sanction->getEtudiant()->getPrenom() . ' ' . $sanction->getEtudiant()->getNom()) ?></p>
                <p class="mb-2"><span class="font-bold">Professeur :</span> <?= htmlspecialchars($sanction->getProfesseur()->getPrenom() . ' ' . $sanction->getProfesseur()->getNom()) ?></p>
            </div>
        </div>
        
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2 text-gray-700">Description</h2>
            <p class="text-gray-600"><?= nl2br(htmlspecialchars($sanction->getDescription())) ?></p>
        </div>
        
        <div class="mt-8 flex justify-between">
            <a href="/sanctions" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Retour à la liste
            </a>
            <div>
                <a href="/sanctions/edit/<?= $sanction->getId() ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                    Modifier
                </a>
                <a href="/sanctions/delete/<?= $sanction->getId() ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Supprimer
                </a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>