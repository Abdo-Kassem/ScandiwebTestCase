<?php

namespace Applecation\Liberary;

class AutoLoader
{
    public static function autoloadController($controllerName)
    {
        if(file_exists($controllerName.'.php'))
            require_once $controllerName.'.php';
    
    }

    public static function autoloadModels($modelName)
    {
        if(file_exists($modelName.'.php'))
            require_once $modelName.'.php';
    }

    public static function autoloadDBConnection($DBClass)
    {
        if(file_exists($DBClass.'.php'))
            require_once $DBClass.'.php';
    }

    public static function autoloadProducts($product)
    {
        if(file_exists($product.'.php'))
            require_once $product.'.php';
    }

    public static function autoloadProductsValidation($productValidation)
    {
        if(file_exists($productValidation.'.php'))
            require_once $productValidation.'.php';
    }

    public static function autoloadLiberaryClasses($class)
    {
        if(file_exists($class.'.php'))
            require_once $class.'.php';
    }

}