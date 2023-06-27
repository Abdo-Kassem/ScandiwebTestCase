<?php

namespace Applecation\Liberary;

use Exception;

class View
{
    public static function render($viewFile, array $data = [])
    {
        if(!file_exists($viewFile.'.php')) {
            throw new Exception('view not found '.$viewFile.'.php ');
        }

        require $viewFile.'.php';
    }

}