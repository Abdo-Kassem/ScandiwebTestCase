<?php

namespace Applecation\Liberary\Product;

use Applecation\Models\Product as ProductModel;

class BookProduct extends Product
{
    public function store(array $attributes)
    {
        parent::store($attributes);
        $this->ProductModel->setWeight($attributes['weight']);

        return $this->ProductModel->save();
    }

    public function edit($sku):ProductModel
    {
        return $this->ProductModel->getByID($sku,['sku','name','price','weight']);
    }

    public function update(array $attributes)
    {
        parent::update($attributes);
        $this->ProductModel->setWeight($attributes['weight']);

        return $this->ProductModel->update();
    }

 
}