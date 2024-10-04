<?php

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require_once __DIR__ . '/../vendor/autoload.php';
/** @var EntityManager $entityManager */
$entityManager = require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../config/view.php';

// Configuration de la session
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true
]);

session_start();

// Régénérer l'ID de session à chaque requête pour plus de sécurité
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    // Régénérer la session toutes les 30 minutes
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}

// Création de la requête à partir des variables globales
$request = Request::createFromGlobals();

// Création du contexte de routage
$context = new RequestContext();
$context->fromRequest($request);

// Chargement des routes (à définir dans un fichier séparé)
$routes = require __DIR__ . '/../config/routes.php';

// Création du matcher d'URL
$matcher = new UrlMatcher($routes, $context);

// Vérification de l'authentification
$publicRoutes = ['/login', '/register'];
if (!isset($_SESSION['user_id']) && !in_array($request->getPathInfo(), $publicRoutes)) {
    header('Location: /login');
    exit;
}

// Vérifier si la session est expirée
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // Si la dernière activité date de plus de 30 minutes, déconnectez l'utilisateur
    session_unset();     // Unset $_SESSION variable for the run-time 
    session_destroy();   // Destroy session data in storage
    header('Location: /login');
    exit;
}

// Mettre à jour le timestamp de dernière activité
$_SESSION['LAST_ACTIVITY'] = time();

try {
    // Tentative de correspondance de la route
    $parameters = $matcher->match($request->getPathInfo());
    // Récupération du contrôleur et de l'action
    $controller = $parameters['_controller'];
    $action = $parameters['_action'];
   
    // Création de l'instance du contrôleur
    $controllerInstance = new $controller($entityManager);

    // Extraction des paramètres de la route
    $routeParams = $parameters;
   
    unset($routeParams['_controller'], $routeParams['_action'], $routeParams['_route']);
      
    // Appel de l'action du contrôleur avec les paramètres de la route
    if (isset($routeParams['id'])) {
        $response = $controllerInstance->$action($request, $routeParams['id']);
    } else {
        $response = $controllerInstance->$action($request);
    }

    // Si l'action ne renvoie pas une réponse, créer une réponse par défaut
    if (!$response instanceof Response) {
        $response = new Response($response);
    }
} catch (ResourceNotFoundException $e) {
    // Gestion des routes non trouvées
    $response = new Response(render('errors/404'), Response::HTTP_NOT_FOUND);
} catch (\Exception $e) {
    // Gestion des erreurs générales
    $response = new Response(render('errors/500', ['error' => $e->getMessage()]), Response::HTTP_INTERNAL_SERVER_ERROR);
}

// Envoi de la réponse
$response->send();