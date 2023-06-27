<?php


define('ROOT_DIRECTORY',__DIR__);

require 'Applecation/config.php';
require 'Applecation/Liberary/AutoLoader.php';
require 'Applecation/Liberary/URLHandle.php';

spl_autoload_register(LIBERARY_NAMESPACE.DIRECTORY_SEPARATOR.'AutoLoader::autoloadLiberaryClasses');
spl_autoload_register(LIBERARY_NAMESPACE.DIRECTORY_SEPARATOR.'AutoLoader::autoloadDBConnection');
spl_autoload_register(LIBERARY_NAMESPACE.DIRECTORY_SEPARATOR.'AutoLoader::autoloadController');
spl_autoload_register(LIBERARY_NAMESPACE.DIRECTORY_SEPARATOR.'AutoLoader::autoloadModels');
spl_autoload_register(LIBERARY_NAMESPACE.DIRECTORY_SEPARATOR.'AutoLoader::autoloadProducts');
spl_autoload_register(LIBERARY_NAMESPACE.DIRECTORY_SEPARATOR.'AutoLoader::autoloadProductsValidation');

$cont = new URLHandle();
