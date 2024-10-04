<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Service\UtilisateurService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class AuthController
{
    private $utilisateurService;

    public function __construct(EntityManager $entityManager)
    {
        $this->utilisateurService = new UtilisateurService(
            $entityManager->getRepository(Utilisateur::class),
            $entityManager
        );
    }

    public function login(Request $request): Response
    {
        $error = null;
        $message = $request->query->get('message');

        if ($request->isMethod('POST')) {
            $login = $request->request->get('login');
            $password = $request->request->get('password');

            $user = $this->utilisateurService->authenticate($login, $password);

            if ($user) {
                // Détruire toute session existante
                session_destroy();
                
                // Démarrer une nouvelle session
                session_start();
                
                // Régénérer l'ID de session
                session_regenerate_id(true);
                
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_pseudo'] = $user->getPseudo();
                $_SESSION['user_role'] = $user->getRole();
                $_SESSION['CREATED'] = time();
                $_SESSION['LAST_ACTIVITY'] = time();

                // Rediriger vers la page d'accueil après la connexion réussie
                header('Location: /');
                exit;
            } else {
                $error = "Login ou mot de passe incorrect";
            }
        }

        $content = render('auth/login', [
            'error' => $error,
            'message' => $message,
        ]);

        return new Response($content);
    }

    public function register(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $login = $request->request->get('login');
            $pseudo = $request->request->get('pseudo');
            $password = $request->request->get('password');

            $user = $this->utilisateurService->createUser($login, $password, $pseudo);

            if ($user) {
                // Rediriger vers la page de connexion après l'inscription réussie
                header('Location: /login?message=Compte créé avec succès. Veuillez vous connecter.');
                exit;
            } else {
                $error = "Erreur lors de la création du compte";
            }
        }

        $content = render('auth/register', [
            'error' => $error ?? null,
        ]);

        return new Response($content);
    }

    public function logout(): Response
    {
        // Unset all of the session variables
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();

        header('Location: /login');
        exit;
    }
}