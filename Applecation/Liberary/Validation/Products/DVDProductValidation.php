<?php

namespace Applecation\Liberary\Validation\Products;

class DVDProductValidation extends ProductValidation
{

    public function validate()
    { 
        parent::validate();
        $this->validateSize();
    
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

    public function validateSize()
    {
        $message = '';

        if(!isset($_POST['size']) || $_POST['size'] == '')
            $message .= 'size required'.PHP_EOL;
        else if(!is_numeric($_POST['size']))
            $message .= 'size must be numeric';

        if($message !== '')
            $this->messages['size'] = $message;
        else {
            $_POST['size'] = htmlspecialchars($_POST['size']);
        }
    }
}