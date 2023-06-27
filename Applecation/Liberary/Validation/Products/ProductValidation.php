<?php

namespace Applecation\Liberary\Validation\Products;
use Applecation\Models\Product;

abstract class ProductValidation
{
    protected array $messages;
    protected Product $productModel;

    public function __construct()
    {
        $this->messages = array();
        $this->productModel = new Product();
    }

    public function validate()
    {
        $this->validateSKU();
        $this->validateName();
        $this->validatePrice();
    }
    public function validateSKU() 
    {
        $message = '';
        if(!isset($_POST['sku'])|| $_POST['sku'] === '')
            $message .= 'sku required'.PHP_EOL;
        else {

            if($this->productModel->SKUExist($_POST['sku']))
                $message .= 'sku already exist'.PHP_EOL;
            if(strlen($_POST['sku'])>14 || strlen($_POST['sku'])<8)
                $message .= 'sku must be greater or equal 8 and less than 14';

        }

        if($message !== '')
            $this->messages['sku'] = $message;
        else {
            $_POST['sku'] = htmlspecialchars($_POST['sku']);
        }

    }
    public function validateName() 
    {
        $message = '';

        if(!isset($_POST['name']) || $_POST['name'] === '')
            $message .= 'name required'.PHP_EOL;
        
        if($message !== '')
            $this->messages['name'] = $message;
        else {
            $_POST['name'] = htmlspecialchars($_POST['name']);
        } 
    }
    public function validatePrice() 
    {
        $message = '';

        if(!isset($_POST['price']) || $_POST['price'] == '')
            $message .= 'price required'.PHP_EOL;
        else if(!is_numeric($_POST['price']))
            $message .= 'price must be numeric';

        if($message !== '')
            $this->messages['price'] = $message;
        else {
            $_POST['price'] = htmlspecialchars($_POST['price']);
        }
    }

    public static function validateType():bool|string
    {
        $message = '';

        if(!isset($_POST['productType']) || $_POST['productType'] == '')
            $message .= 'productType required';
       
        if($message !== '')
            return $message;
        return true;
        
    }

    
}