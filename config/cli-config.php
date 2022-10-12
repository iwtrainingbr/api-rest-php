<?php

use App\Connection\DatabaseConnection;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

include dirname(__DIR__).'/vendor/autoload.php';

$entityManager = DatabaseConnection::getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);