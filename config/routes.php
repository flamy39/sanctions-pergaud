<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    '_controller' => 'App\Controller\HomeController',
    '_action' => 'index'
]));

$routes->add('new_etudiant', new Route('/etudiants/new', [
    '_controller' => 'App\Controller\EtudiantController',
    '_action' => 'new'
]));

$routes->add('list_sanctions', new Route('/sanctions', [
    '_controller' => 'App\Controller\SanctionController',
    '_action' => 'list'
]));

$routes->add('new_sanction', new Route('/sanctions/new', [
    '_controller' => 'App\Controller\SanctionController',
    '_action' => 'new'
]));

$routes->add('show_sanction', new Route('/sanctions/{id}', [
    '_controller' => 'App\Controller\SanctionController',
    '_action' => 'show',
]));

$routes->add('list_etudiants', new Route('/etudiants', [
    '_controller' => 'App\Controller\EtudiantController',
    '_action' => 'list'
]));

$routes->add('import_etudiants', new Route('/etudiants/import', [
    '_controller' => 'App\Controller\EtudiantController',
    '_action' => 'import',
]));

$routes->add('show_etudiant', new Route('/etudiants/{id}', [
    '_controller' => 'App\Controller\EtudiantController',
    '_action' => 'show'
]));

$routes->add('delete_sanction', new Route('/sanctions/delete/{id}', [
    '_controller' => 'App\Controller\SanctionController',
    '_action' => 'delete'
]));    

$routes->add('list_promotions', new Route('/promotions', [
    '_controller' => 'App\Controller\PromotionController',
    '_action' => 'list'
]));



$routes->add('show_promotion', new Route('/promotions/{id} ', [
    '_controller' => 'App\Controller\PromotionController',
    '_action' => 'show'
]));

$routes->add('edit_sanction', new Route('/sanctions/edit/{id}', [
    '_controller' => 'App\Controller\SanctionController',
    '_action' => 'edit'
]));

$routes->add('edit_etudiant', new Route('/etudiants/edit/{id}', [
    '_controller' => 'App\Controller\EtudiantController',
    '_action' => 'edit'
]));



return $routes;