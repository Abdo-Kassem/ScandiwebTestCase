<?php

use Applecation\Controllers\ProductController;
use ScandiWeb\Applecation\Routes\URLGenerator;

class URLHandle
{
    use URLGenerator;
    private $controller;
    private $action;

   public function __construct()
   {
        
        $this->URLHandle();

        $controllerNamespace = CONTROLLER_NAMESPACE.DIRECTORY_SEPARATOR.$this->controller;

        $controller = new $controllerNamespace();

        $controller->{$this->action}();
        
   }


   private function URLHandle()
   {
        $urlParameters = filter_input(INPUT_GET,'url');

        $controllersAndMethods = $this->urlGenerate();

        if(array_key_exists($urlParameters,$controllersAndMethods)) {

            $url = $controllersAndMethods[$urlParameters];
            
            $url = trim($url,'/');

            $urlParts = explode('/',$url);

            if(count($urlParts)>=2) {
                $this->controller = $urlParts[0];
                $this->action = $urlParts[1];
            }else {
                throw new Exception('controller not exist');
            }
        }elseif($urlParameters == '/' || $urlParameters == '') {
            $this->controller = 'ProductController';
            $this->action = 'show';
        }else {
            header('location: http://localhost/scandiweb');
        }

   }

}