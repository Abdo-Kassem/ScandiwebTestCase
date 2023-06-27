<?php

namespace traits;

use model\Model;
require_once '../Models/Model.php';
trait SKUGenerator
{
    public function SKUGenerator($productName,$attr1,$attr2 = '',$color=''):string
    {
        $sku = '';
        $sku .= substr($productName,0,2).'_';
        $sku .= substr($attr1,0,2).substr($attr1,-1,1).'_';

        if($attr2 !== '') {
            $sku .= substr($attr2,0,2).'_';
        }

        if($color !== '') {
            $sku .= substr($color,0,2).substr($attr1,-1,1).'_';
        }
        
        $skuLength = strlen($sku);

        $skuComplete = '';

        while(true) {

            $skuComplete .= rand(0,999999);

            $skuCompleteLength = strlen($skuComplete);

            if($skuCompleteLength <= (12-$skuLength) && ($skuCompleteLength+$skuLength) >= 8 && $this->isUnique($sku)) {
                $sku .= $skuComplete;
                break;
            }else if($skuCompleteLength > (12-$skuLength)) {
                $skuComplete = '';
            }

        }

        return $sku;
    }

    private function isUnique($SKU) 
    {
        $skus = Model::getAllSKU();

        foreach($skus as $sku) {

           if($SKU === $sku) {
                return false;
           }

        }

        return true;

    }

}
