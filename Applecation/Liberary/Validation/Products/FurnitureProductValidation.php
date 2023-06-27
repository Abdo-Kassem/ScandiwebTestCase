<?php

namespace Applecation\Liberary\Validation\Products;

class FurnitureProductValidation extends ProductValidation
{
 
    public function validate()
    {
        parent::validate();
        $this->validateLength();
        $this->validateWidth();
        $this->validateHeight();

        if(count($this->messages)>0) {
            $this->messages['status'] = false;
            return $this->messages;
           /* session_start();
            $_SESSION['validationMessages'] = $this->messages;

            header('Location: http://localhost/ScandiWeb/Applecation/Views/createProduct.php');
            die;
            */
        }

        return ['status'=>true];
    }

    public function validateLength()
    {
        $message = '';

        if(!isset($_POST['length'])||$_POST['length'] =='')
            $message .= 'length required'.PHP_EOL;
        else if(!is_numeric($_POST['length']))
            $message .= 'length must be numeric';

        if($message !== '')
            $this->messages['length'] = $message;
        else {
            $_POST['length'] = htmlspecialchars($_POST['length']);
        }
    }
    public function validateWidth()
    {
        $message = '';

        if(!isset($_POST['width'])||$_POST['width'] =='')
            $message .= 'width required'.PHP_EOL;
        else if(!is_numeric($_POST['width']))
            $message .= 'width must be numeric';

        if($message !== '')
            $this->messages['width'] = $message;
        else {
            $_POST['width'] = htmlspecialchars($_POST['width']);
        }
    }
    public function validateHeight()
    {
        $message = '';

        if(!isset($_POST['height'])||$_POST['height'] =='')
            $message .= 'height required'.PHP_EOL;
        else if(!is_numeric($_POST['height']))
            $message .= 'height must be numeric';

        if($message !== '')
            $this->messages['height'] = $message;
        else {
            $_POST['height'] = htmlspecialchars($_POST['height']);
        }
    }
    
}