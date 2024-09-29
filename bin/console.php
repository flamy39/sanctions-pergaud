<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// Remplacez __DIR__ . '/../config/bootstrap.php' par le chemin correct vers votre fichier bootstrap si nécessaire
require_once __DIR__ . '/../config/bootstrap.php';

// Création du SingleManagerProvider
$entityManagerProvider = new SingleManagerProvider($entityManager);

// Exécution de la console
ConsoleRunner::run($entityManagerProvider);