<?php

use Nette\Configurator;
use Nette\Utils\Strings;

require __DIR__ . '/shortcuts.php';
require __DIR__ . '/../vendor/autoload.php';

$configurator = new Configurator;

$debugMode = FALSE;

$debugSwitchFile = __DIR__ . '/config/debug';
if (file_exists($debugSwitchFile)) {
	$debugMode = Strings::trim(mb_strtolower(file_get_contents($debugSwitchFile))) === 'true' ? TRUE : FALSE;
}

$configurator->setDebugMode($debugMode);
$configurator->enableDebugger(__DIR__ . '/../log');

$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
		->addDirectory(__DIR__)
		->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');

$localConfig = __DIR__ . '/config/config.local.neon';

if (file_exists($localConfig)) {
	$configurator->addConfig($localConfig);
}

$container = $configurator->createContainer();

return $container;
