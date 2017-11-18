<?php
// PHPUnit 6 introduced a breaking change that
// removed PHPUnit_Framework_TestCase as a base class,
// and replaced it with \PHPUnit\Framework\TestCase
if (!class_exists('\PHPUnit_Framework_TestCase') && class_exists('\PHPUnit\Framework\TestCase'))
    class_alias('\PHPUnit\Framework\TestCase', '\PHPUnit_Framework_TestCase');

if (!is_file($autoloadFile = __DIR__ . '/../vendor/autoload.php') &&
    !is_file($autoloadFile = __DIR__ . '/../../../../../autoload.php')) {
    throw new RuntimeException('Install dependencies to run test suite.');
}

require $autoloadFile;
