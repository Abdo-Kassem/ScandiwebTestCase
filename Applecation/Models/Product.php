<?php

namespace Applecation\Models;

use Exception;
use PDO;

require_once 'Model.php';

class Product extends Model
{
    protected string $sku;
    protected string $productName;
    protected float $price;
    private ?float $weight;
    private ?float $size;

    private ?float $height,$width,$length;
    protected string $where;


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


    //update current object
    public  function update():bool
    {
        $this->columnsEmpty();

        $product = $this->checkProductType();

        if($product === 'dvd') {

            $sql = 'UPDATE products SET sku = :sku , productName = :productName , size = :size , price = :price WHERE sku = :sku';
            $pdoStatement = $this->pdo->prepare($sql);
            return $pdoStatement->execute([
                        ':sku'=>$this->sku,':productName'=>$this->productName,
                        ':price'=>$this->price,':size'=>$this->size,
                    ]);

        }elseif($product === 'book') {

            $sql = 'UPDATE products SET sku = :sku , productName = :productName , weight = :weight , price = :price WHERE sku = :sku';
            $pdoStatement = $this->pdo->prepare($sql);
            return $pdoStatement->execute([
                        ':sku'=>$this->sku,':productName'=>$this->productName,
                        ':price'=>$this->price,':weight'=>$this->weight,
                    ]);

        }elseif($product === 'furniture') {

            $sql = 'UPDATE products SET sku = :sku , productName = :productName , price = :price , 
                length = :length , width = :width , height = :height WHERE sku = :sku';

            $pdoStatement = $this->pdo->prepare($sql);

            return $pdoStatement->execute([
                        ':sku'=>$this->sku,':productName'=>$this->productName,':price'=>$this->price ,
                        ':length'=>$this->length,':width'=>$this->width,':height'=>$this->height
                    ]);


        }

        return false;
           
    }

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

/*
    //delete current object
    public  function delete():bool|Exception
    {
        if($this->sku === '')
            throw new Exception('sku must insert');

        $sql = 'DELETE FROM products WHERE sku = :sku';
        $pdoStatement = $this->pdo->prepare($sql);

        return $pdoStatement->execute([':sku'=>$this->sku ]);

    }

    public  function deleteWhere():bool|Exception
    {
        $sql = 'DELETE FROM products WHERE :condition';

        if($this->where === '') 
            $this->where = true;

        $sql = str_replace(':condition',$this->where,$sql);

        $pdoStatement = $this->pdo->prepare($sql);

        return $pdoStatement->execute([':sku'=>$this->where ]);

    }
*/
    /*
    *delete all rows in table product
    *//*
    public function truncate()
    {
        $sql = 'DELETE FROM products WHERE sku != ""';

        $pdoStatement = $this->pdo->prepare($sql);

        return $pdoStatement->execute();
    }
*/

    public function deleteIN(array $skus):bool
    {
        $skus = implode(',',$skus);

        $sql = "DELETE FROM products WHERE sku IN (".$skus.")";
        
        $pdoStatement = $this->pdo->prepare($sql);

        return $pdoStatement->execute();
    }
    public  function getAll(?array $attributes):array
    {
       return $this->get('all',$attributes);
    }

    public function getByID($id,?array $attributes):?self
    {
        $product = $this->get('byID',$attributes,$id);
        return (count($product)>0)?$product[0]:null;
    }

    public function SKUExist(string $sku):bool
    {
        $product = $this->getByID($sku,['sku']);
        if($product !== null)
            return true;
        return false;
    }

    public  function where($property , $value , $operator='='):self
    {
       $this->where .= $property.' '.$operator.' '.$value;
       return $this;
    }

    public  function orWhere($property , $value , $operator='='):self
    {
        $this->where .= ' OR '.$property.' '.$operator.' '.$value;
        return $this;
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
  
    private function checkProductType():string|Exception
    {
        if(isset($this->size))
            return 'dvd';
        if(isset($this->weight))
            return 'book';
        if(isset($this->length)&&isset($this->width)&&isset($this->height))
            return 'furniture';
    
        throw new Exception('specific product attributes empty not allow');
    }

    private function get(string $status,?array $attributes,$id = '')
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


        if($status === 'all') {

            $sql .= 'FROM '.$this->table;

            if(isset($this->where))
                $sql = $sql." WHERE {$this->where}";
                
            $pdoStatement = $this->pdo->prepare($sql);
            $status = $pdoStatement->execute();

        }elseif($status === 'byID') {

            $sql .= 'FROM '.$this->table.' WHERE sku = :sku';;
            $pdoStatement = $this->pdo->prepare($sql);
            $status = $pdoStatement->execute([':sku'=>$id]);

        }
       
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
