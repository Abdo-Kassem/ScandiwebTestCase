<?php

namespace Applecation\Liberary\Product;

use Applecation\Models\Product as ProductModel;

class FurnitureProduct extends Product
{
    public function store(array $attributes)
    {
        parent::store($attributes);

        $this->ProductModel->setLength($attributes['length']);
        $this->ProductModel->setWidth($attributes['width']);
        $this->ProductModel->setHeigth($attributes['height']);

        return $this->ProductModel->save();
    }

    public function edit($sku):ProductModel
    {
        return $this->ProductModel->getByID($sku,['sku','name','price','length','width','height']);
    }

    public function update(array $attributes)
    {
        parent::update($attributes);

        $this->ProductModel->setLength($attributes['length']);
        $this->ProductModel->setWidth($attributes['width']);
        $this->ProductModel->setHeigth($attributes['height']);

        return $this->ProductModel->update();
    }

    
}