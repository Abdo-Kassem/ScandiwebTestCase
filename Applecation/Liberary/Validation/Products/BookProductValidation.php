<?php

namespace Applecation\Liberary\Validation\Products;

class BookProductValidation extends ProductValidation
{
    public function validate()
    {
        parent::validate();
        $this->validateWieght();
    
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

    public function validateWieght()
    {
        $message = '';

        if(!isset($_POST['weight'])||$_POST['weight'] =='')
            $message .= 'weight required'.PHP_EOL;
        else if(!is_numeric($_POST['weight']))
            $message .= 'weight must be numeric';

        if($message !== '')
            $this->messages['weight'] = $message;
        else {
            $_POST['weight'] = htmlspecialchars($_POST['weight']);
        }
    }
}