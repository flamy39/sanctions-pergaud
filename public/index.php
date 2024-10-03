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

// Création de la requête à partir des variables globales
$request = Request::createFromGlobals();

// Création du contexte de routage
$context = new RequestContext();
$context->fromRequest($request);

// Chargement des routes (à définir dans un fichier séparé)
$routes = require __DIR__ . '/../config/routes.php';

// Création du matcher d'URL
$matcher = new UrlMatcher($routes, $context);
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