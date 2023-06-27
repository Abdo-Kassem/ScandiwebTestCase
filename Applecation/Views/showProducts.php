<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo CSSURL.'/bootstrap.min.css';?>" rel='stylesheet'>
    <link href="<?php echo CSSURL.'/style.css';?>" rel='stylesheet'>
</head>

<body>
    <div class="containner">

        <div class="main-header row">

            <h3 class='col-8 header'>product list</h3>
            <div class="buttons col-4">
                <a class='btn btn-primary' href="addproduct">ADD</a>
                <button class='btn btn-danger ' id='delete-product-ptn'>MASS DELETE</button>
            </div>
           
        </div>

        <div class="products-container  row justify-content-between">

            <?php

                $arrayCount = count($data);

                for($count = 0 ; $count<$arrayCount ; $count++):
                    
                   
            ?>
            <div class="product col-2 ">
                <input type='checkbox' class='delete-checkbox form-check-input' sku="<?php echo  $data[$count]->getSku();?>">
                <div class="product-content">
                    <span class='product_sku span'><?php echo $data[$count]->getSku(); ?></span>
                    <span class='product_name span'><?php echo $data[$count]->getName(); ?></span>
                    <span class='price span'><?php echo $data[$count]->getPrice(); ?>$</span>
                    
                    <?php if($data[$count]->getSize() !== null):?>
                    <span class='size span small-font'>size: <?php echo $data[$count]->getSize();?>MG</span>

                    <?php elseif($data[$count]->getWeight() !== null):?>
                    <span class='weight span small-font'>weigth: <?php echo $data[$count]->getWeight();?>KG</span>
                    
                    <?php elseif($data[$count]->getHeight() !== null):?>
                    <span class='dimention span small-font'>dimention: 
                        <?php 
                            echo $data[$count]->getHeight().'X'.$data[$count]->getWidth().
                            'X'.$data[$count]->getLength();
                        ?>
                    </span>
                    <?php endif;?>
                    <!--<span class='weight'>2KG</span>
                    <span class='dimention'>100X100X100</span>-->
                </div>
                
            </div>
          <?php endfor;?>
        </div>

    </div>

    <script src="<?php echo JSURL.'/bootstrap.js';?>"></script>
    <script src="<?php echo JSURL.'/bootstrap.bundle.min.js';?>"></script>
    <script src="<?php echo JSURL.'/jquery.js';?>"></script>
    <script src="<?php echo JSURL.'/deleteProducts.js';?>"></script>
</body>

</html>