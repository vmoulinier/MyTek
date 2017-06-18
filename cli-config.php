<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once 'Core/Config/configuration.php';

return ConsoleRunner::createHelperSet($entityManager);

//vendor\bin\doctrine orm:schema-tool:update --force --dump-sql