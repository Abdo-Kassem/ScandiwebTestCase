<?php

namespace Applecation\Liberary\Product;

use Applecation\Models\Product as ProductModel;

class DVDProduct extends Product
{
    
    public function store(array $attributes)
    {
        parent::store($attributes);
        $this->ProductModel->setSize($attributes['size']);

        return $this->ProductModel->save();
    }

    public function edit($sku):ProductModel
    {
        return $this->ProductModel->getByID($sku,['sku','name','price','size']);
    }

    public function update(array $attributes)
    {
        parent::update($attributes);
        $this->ProductModel->setSize($attributes['size']);

        return $this->ProductModel->update();
    }

   

}