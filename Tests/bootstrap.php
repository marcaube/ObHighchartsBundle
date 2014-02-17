<?php

if (!is_file($autoloadFile = __DIR__ . '/../vendor/autoload.php') &&
    !is_file($autoloadFile = __DIR__ . '/../../../../../autoload.php')) {
    throw new RuntimeException('Install dependencies to run test suite.');
}

require $autoloadFile;
