
<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo CSSURL.'/bootstrap.min.css'?>" rel='stylesheet'>
    <link href="<?php echo CSSURL.'/style.css'?>" rel='stylesheet'>
</head>

<body>
<?php

?>
    <div class="form">

            <form method='post' action="store" id='product_form' valid='false'>

                <div class="main-header row">

                    <h3 class='col-8 header'>create product</h3>
                    <div class="buttons col-4">
                        <input type='submit' id='submit' class='btn btn-success' value='SAVE'>
                        <a  href="/scandiweb" class='btn btn-danger' id='cancel_product'>CANCEL</a>
                    </div>

                </div>
                <div class="form-content">

                    <div class="mb-3 row">
                        <label for="sku" class="form-label sku col-3">sku</label>
                        <input type="text" name="sku" class="form-control" id='sku' placeholder="SKU" >
                        
                        <small class='help ' id='sku-help'></small>
                 
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="form-label col-3">name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" >
                       
                        <small class='help ' id='name-help'></small>
                       
                    </div>

                    <div class="mb-3 row">
                        <label for="price" class="form-label col-3">price $</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Price" >
                        
                        <small class='help ' id='price-help'></small>
                        
                    </div>

                    <div class="mb-3 row " >
                        <label for="productType" class="form-label col-3">type switcher</label>
                        <select class="form-select col-8" id='productType' onchange="display(this.value)" name='productType' required>
                            <option selected disabled>...</option>
                            <option value="dvd">DVD</option>
                            <option value="book">Book</option>
                            <option value="furniture">furniture</option>
                        </select>
                        
                         <small class='help ' id='productType_error'></small>
                        
                    </div>

                    <div class="dvd hidden">
                        
                        <div class="mb-3 row">
                            <label for="size" class="form-label col-3">size(MB)</label>
                            <input type="number" name="size" id="size" class="form-control" placeholder="Size" min="0">
                            
                            <small class='help ' id='size-help'></small>
                            
                        </div>
                        <p class="descreption" >please, provide size in MB</p>
                    </div>

                    <div class="book hidden">
                        <div class="mb-3 row">
                            <label for="weight" class="form-label col-3">weight(KG)</label>
                            <input type="number" name="weight" id="weight" class="form-control" placeholder="Weight"  min='0'>
                           
                            <small class='help ' id='weight-help'></small>
                            
                        </div>
                        <p class="descreption" >please, provide weight in KG</p>
                    </div>
                    
                    <div class="furniture hidden">

                        <div class="mb-3 row">
                            <label for="height" class="form-label col-3">height(CM)</label>
                            <input type="number" name="height" id="height" class="form-control" placeholder="Height" min='0'>
                            <small class='help ' id='height-help'></small>
                            
                        </div>
                        <div class="mb-3 row">
                            <label for="width" class="form-label col-3">width(CM)</label>
                            <input type="number" name="width" id="width" class="form-control" placeholder="Width" min='0'>
                            <small class='help ' id='width-help'></small>
                            
                        </div>
                        <div class="mb-3 row">
                            <label for="length" class="form-label col-3">length(CM)</label>
                            <input type="number" name="length" id="length" class="form-control" placeholder="Length" min='0'>
                            <small class='help ' id='length-help'></small>
                        </div>
                        <p class="descreption">please, provide dimentions in <span title='height,width,length'>HxWxL</span> format</p>
                    </div>

                </div>

            </form>

        </div>

    <script src="<?php echo JSURL.'/bootstrap.js';?>"></script>
    <script src="<?php echo JSURL.'/bootstrap.bundle.min.js';?>"></script>
    <script src="<?php echo JSURL.'/jquery.js';?>"></script>
    <script src="<?php echo JSURL.'/formValidation.js';?>"></script>
   
</body>

</html>
