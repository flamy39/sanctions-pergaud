<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Créer un compte</h1>
    
    <form action="/register" method="POST" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="login">
                Login
            </label>
            <input type="text" id="login" name="login" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="pseudo">
                Pseudo
            </label>
            <input type="text" id="pseudo" name="pseudo" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="password">
                Mot de passe
            </label>
            <input type="password" id="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 mb-3 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Créer le compte
            </button>
            <a href="/login" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Déjà un compte ? Se connecter
            </a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>