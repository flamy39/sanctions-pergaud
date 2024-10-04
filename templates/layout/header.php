<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des sanctions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Configuration de Tailwind pour le mode sombre
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            bg: '#1a202c',
                            text: '#e2e8f0',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Styles supplémentaires pour le mode sombre */
        .dark body { background-color: #1a202c; color: #e2e8f0; }
        .dark .bg-white { background-color: #2d3748; }
        .dark .text-gray-700 { color: #e2e8f0; }
        .dark .text-gray-600 { color: #cbd5e0; }
        .dark .border-gray-200 { border-color: #4a5568; }
        .dark .bg-gray-100 { background-color: #2d3748; }
        
        /* Styles pour les formulaires en mode sombre */
        .dark input[type="text"],
        .dark input[type="date"],
        .dark input[type="email"],
        .dark input[type="password"],
        .dark select,
        .dark textarea {
            background-color: #2d3748;
            color: #e2e8f0;
            border-color: #4a5568;
        }

        .dark input[type="text"]:focus,
        .dark input[type="date"]:focus,
        .dark input[type="email"]:focus,
        .dark input[type="password"]:focus,
        .dark select:focus,
        .dark textarea:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
        }

        .dark label {
            color: #e2e8f0;
        }
    </style>
</head>
<body class="flex flex-col min-h-full">
    <header class="bg-blue-600 dark:bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center text-2xl font-bold hover:text-blue-200 transition duration-300">
                <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                </svg>
                Gestion des sanctions
            </a>
            <nav class="flex items-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <ul class="flex space-x-4 mr-4">
                        <?php
                        $currentPage = $_SERVER['REQUEST_URI'];
                        $menuItems = [
                            '/' => 'Accueil',
                            '/etudiants' => 'Étudiants',
                            '/promotions' => 'Promotions',
                            '/sanctions' => 'Sanctions'
                        ];
                        foreach ($menuItems as $url => $label):
                            $isActive = ($url === '/' && $currentPage === '/') || 
                                        ($url !== '/' && strpos($currentPage, $url) === 0);
                            $activeClass = $isActive ? 'bg-blue-700 dark:bg-blue-900 text-white' : 'hover:bg-blue-500 dark:hover:bg-blue-700';
                        ?>
                            <li>
                                <a href="<?= $url ?>" class="px-3 py-2 rounded-md text-sm font-medium <?= $activeClass ?>">
                                    <?= $label ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 text-sm focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span><?= htmlspecialchars($_SESSION['user_pseudo']) ?></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-xl z-10">
                            <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Déconnexion</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/login" class="text-sm hover:text-blue-200">Connexion</a>
                    <a href="/register" class="ml-4 text-sm hover:text-blue-200">Créer un compte</a>
                <?php endif; ?>
                <button id="darkModeToggle" class="ml-4 p-2 rounded-full hover:bg-blue-700 dark:hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-colors duration-200">
                    <svg class="w-6 h-6 text-yellow-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
            </nav>
        </div>
    </header>
    <main class="flex-grow">