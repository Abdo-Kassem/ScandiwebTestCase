<?php

namespace Applecation\Liberary\Product;

use Applecation\Models\Product as ModelsProduct;

abstract class Product
{
    protected $ProductModel ;
    
    public function __construct()
    {
        $this->ProductModel = new ModelsProduct();
    }

    public abstract function edit($sku):ModelsProduct;
    public static function showAll():array
    {
        return (new ModelsProduct())->getAll(null);
    }

    public function store(array $attributes)
    {
        $this->ProductModel->setSku($attributes['sku']);
        $this->ProductModel->setName($attributes['name']);
        $this->ProductModel->setPrice($attributes['price']);
    }

    public function update(array $attributes)
    {
        $this->ProductModel->setSku($attributes['sku']);
        $this->ProductModel->setName($attributes['name']);
        $this->ProductModel->setPrice($attributes['price']);
    }

    public static function deleteAll(array $sku):bool
    {
        return (new ModelsProduct())->deleteIN($sku);
    }

}