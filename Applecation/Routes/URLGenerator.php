<?php

namespace ScandiWeb\Applecation\Routes;

trait URLGenerator
{
    function urlGenerate()
    {
        return [
            //write like this url=>controller/method
            'addproduct' => 'ProductController/create',
            'validate' => 'ProductController/validate',
            'store' => 'ProductController/store',
            'deleteAll' => 'ProductController/deleteAll',
        ];
    }
}