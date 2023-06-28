<?php

namespace Applecation\Models;

use Exception;

require_once 'Model.php';

class Product extends Model
{
    protected string $sku;
    protected string $productName;
    protected float $price;
    private ?float $weight;
    private ?float $size;

    private ?float $height,$width,$length;


    public function __construct()
    {
        parent::__construct('products');
        $this->size = null;
        $this->weight = null;
        $this->length = null;
        $this->width = null;
        $this->height = null;
    }


    public function setSku(string $sku) { $this->sku = $sku; }
    public function getSku() { return $this->sku; }

    public function setName(string $name) { $this->productName = $name; }
    public function getName() { return $this->productName ; }

    public function setPrice(float $price) {$this->price = $price;}
    public function getPrice() {return $this->price;}

    public function setSize(?int $size) {$this->size = $size;}
    public function getSize() { return $this->size;}

    public function setWeight(?int $weight) {$this->weight = $weight;}
    public function getWeight() { return $this->weight;}

    public function setLength(?int $length) {$this->length = $length;}
    public function getLength() { return $this->length;}

    public function setWidth(?int $width) {$this->width = $width;}
    public function getWidth() { return $this->width;}

    public function setHeigth(?int $height) {$this->height = $height;}
    public function getHeight() { return $this->height;}

    public  function save():int
    {
        $this->columnsEmpty();

        $sql = 'INSERT INTO products(sku,productName,price,weight,size,height,width,length) VALUES(:sku,:productName,:price,:weight,:size,:height,:width,:length)';
        $pdoStatement = $this->pdo->prepare($sql);

        $status = $pdoStatement->execute([
                    ':sku'=>$this->sku,':productName'=>$this->productName,':price'=>$this->price,
                    ':weight'=>$this->weight,':size'=>$this->size,':height'=>$this->height,
                    ':width'=>$this->width,':length'=>$this->length
                ]);

        return ($status)?$this->pdo->lastInsertId():0;
    }

    public function deleteIN(array $skus):bool
    {
       
        $sql = "DELETE FROM products WHERE sku IN (";

        foreach($skus as $sku) {
            $sql .= "'".$sku."'".',';
        }

        $sql = substr_replace($sql,')',( strlen($sql))-1,1);
       
       
        $pdoStatement = $this->pdo->prepare($sql);

        return $pdoStatement->execute();
    }

    protected function columnsEmpty():bool|Exception
    {
        $emptyProperties = '';

        if(empty($this->sku))
            $emptyProperties .= 'sku ';
        if(empty($this->productName))
            $emptyProperties .= '& product name ';
        if(empty($this->price))
            $emptyProperties .= '& price ';

        if($emptyProperties !== '')
            throw new Exception('this properties '.$emptyProperties.' required');

        return false;
    }

    public function skuExist($sku):bool|Exception
    {
        $sql = "SELECT sku FROM ".$this->table." WHERE sku = '".$sku."'";

        $pdoStatement = $this->pdo->prepare($sql);

        $status = $pdoStatement->execute();

        if($status) {
            return $pdoStatement->rowCount() > 0 ? true:false;
        }

        throw new Exception('server hangout');
    }

    public function getAll(array $attributes = null):array
    {
        $products = array();

        $sql = 'SELECT ';

        if($attributes !== null) {

            foreach($attributes as $attribute) {
                $sql .= $attribute.',';
            }

            $sqlLength = strlen($sql);

            $sql=substr_replace($sql,' ',$sqlLength-1,1 );

        }else {
            $sql .= '* ';
        }

        $sql .= 'FROM '.$this->table;

            
        $pdoStatement = $this->pdo->prepare($sql);
        $status = $pdoStatement->execute();
       
        if($status) {
           
            $productsRes = $pdoStatement->fetchAll();
           
            
            foreach($productsRes as $product) {

                $productObj = new self;
                
                if($attributes !== null) {
                    if(in_array('sku',$attributes)) $productObj->setSku($product['sku']);
                    if(in_array('productName',$attributes)) $productObj->setName($product['productName']);
                    if(in_array('price',$attributes)) $productObj->setPrice($product['price']);
                    if(in_array('size',$attributes)) $productObj->setSize($product['size']);
                    if(in_array('weight',$attributes)) $productObj->setWeight($product['weight']);
                    if(in_array('height',$attributes)) $productObj->setHeigth($product['height']);
                    if(in_array('width',$attributes)) $productObj->setWidth($product['width']);
                    if(in_array('length',$attributes)) $productObj->setLength($product['length']);
                }else {
                    $productObj->setSku($product['sku']);
                    $productObj->setName($product['productName']);
                    $productObj->setPrice($product['price']);
                    $productObj->setSize($product['size']);
                    $productObj->setWeight($product['weight']);
                    $productObj->setHeigth($product['height']);
                    $productObj->setWidth($product['width']);
                    $productObj->setLength($product['length']);
                }
                
                unset($productObj->pdo,$productObj->table);
                
                array_push($products,$productObj);
                
            }
        }

        return $products;
      
    }

}
