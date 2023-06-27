<?php

namespace Applecation\Controllers;
use Applecation\Liberary\Product\Product;
use Applecation\Liberary\Validation\Products\ProductValidation;
use Applecation\Liberary\View;

class ProductController
{

    private ProductValidation $validation;
    private array $productTypes;
    private Product $product;

    public function __construct()
    {
        $this->productTypes['dvd'] = 'DVDProduct';
        $this->productTypes['book'] = 'BookProduct';
        $this->productTypes['furniture'] = 'FurnitureProduct';
    }

    public function create()
    {
        //make require of view
        View::render('Applecation/Views/createProduct');
    }

    public function store()
    {

        $productAndNamespace = PRODUCT_NAMESPACE.DIRECTORY_SEPARATOR.$this->productTypes[$_POST['productType']];
        
        $this->product = new $productAndNamespace;

        $this->product->store($_POST);
        
        //$this->show();

        header('Location: Http:\\ScandiWeb\ProductController\show');
        die;
    }

    public function show()
    {
        /*session_set_cookie_params(SESSION_TIME_OUT,'/',$_SERVER['HTTP_HOST']);
        session_start();
        
        $products = Product::showAll();
        $_SESSION['products'] =$products;
       */
        $products = Product::showAll();
        View::render('Applecation'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'showProducts',$products);
        //echo json_encode(['status'=>'done']);
    }

    public function deleteAll()
    {
        $skus = filter_input(INPUT_GET,'skus');

        $status = Product::deleteAll($skus);
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status'=>$status]);
    }

    public function validate()
    { 
        header('Content-Type: application/json; charset=utf-8');

        $typeValidationRes = ProductValidation::validateType(); 

        if($typeValidationRes === true) {
            $productValidAndNamespace = PRODUCT_VALID_NAMESPACE.DIRECTORY_SEPARATOR.$this->productTypes[$_POST['productType']].'Validation'; 
            $this->validation = new $productValidAndNamespace; 
            echo json_encode($this->validation->validate());
            die;
        }
        
        echo json_encode(['productType'=>$typeValidationRes]);
    }
}