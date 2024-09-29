    </main>

    <footer class="bg-gray-200 dark:bg-gray-800 text-center p-4 mt-8">
        <p>&copy; <?= date('Y') ?> Gestion des sanctions. Tous droits réservés.</p>
    </footer>

    <script>
        // Fonction pour basculer entre le mode clair et sombre
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        }

        // Vérifier la préférence de l'utilisateur au chargement de la page
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }

        // Ajouter un écouteur d'événements au bouton de bascule
        document.getElementById('darkModeToggle').addEventListener('click', toggleDarkMode);
    </script>
</body>
</html>