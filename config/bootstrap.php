<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

// Charger les variables d'environnement depuis un fichier .env
//$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

// Configuration de la base de données
$dbParams = [
    'driver'   => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
    'host'     => $_ENV['DB_HOST'] ?? 'localhost',
    'port'     => $_ENV['DB_PORT'] ?? '3306',
    'dbname'   => $_ENV['DB_NAME'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset'  => $_ENV['DB_CHARSET'] ?? 'utf8mb4'
];

// Configuration de Doctrine
$config = ORMSetup::createAttributeMetadataConfiguration(
    [__DIR__ . '/../src/Entity'],
    $_ENV['APP_ENV'] === 'dev'
);

// Obtention de la connexion à la base de données
$connection = DriverManager::getConnection($dbParams, $config);

// Création de l'EntityManager
$entityManager = new EntityManager($connection, $config);

return $entityManager;