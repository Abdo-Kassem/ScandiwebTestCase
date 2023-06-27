function display(switchValue) {
   
    productElements = document.getElementsByClassName('active');

    productElements = Array.from(productElements);

    productElements.forEach(element => {
        element.classList.add('hidden');
        element.classList.remove('active');
    });

    productElement = document.getElementsByClassName(switchValue)[0];
    productElement.classList.add('active');

}

$("#submit").on('click',(function(event){
    
    if($("#product_form").attr('valid') == 'false') {
        event.preventDefault();

        typeOfProduct = '';

        var formData = {
            sku : $('#sku').val(),
            price : $('#price').val(),
            name : $('#name').val(),
            productType : $('#productType').val(),
        };

        if(formData['productType'] == 'dvd') {
            formData['size'] = $('#size').val();
            typeOfProduct = 'dvd';
        }else if(formData['productType'] == 'book') {
            formData['weight'] = $('#weight').val();
            typeOfProduct = 'book';
        }else if(formData['productType'] == 'furniture') {
            formData['length'] = $('#length').val(),
            formData['width'] = $('#width').val(),
            formData['height'] = $('#height').val()
            typeOfProduct = 'furniture';
        }/*else {
            $('#productType_error').text('must specify product type');
            return;
        }*/
        
        $.ajax({

            method : 'POST',
            url : 'validate',
            data : formData,

            success:function(data,status,xhr) {
          
                if(data.status == true) {
                    $("#product_form").attr('valid','true');
                    $('#submit').click();
                }else{
                    if(data.sku != undefined)
                        $('#sku-help').text(data.sku);
                    if(data.name != undefined)
                        $('#name-help').text(data.name);
                    if(data.price != undefined)
                        $('#price-help').text(data.price);
                    if(data.productType != undefined) 
                        $('#productType_error').text(data.productType);
                        

                    switch(typeOfProduct) {
                        case 'dvd' : if(data.size != undefined) $('#size-help').text(data.size); break;
                        case 'book' : if(data.weight != undefined) $('#weight-help').text(data.weight); break;
                        case 'furniture' :  if(data.heigth != undefined) $('#heigth-help').text(data.heigth);
                                            if(data.width != undefined) $('#width-help').text(data.width); 
                                            if(data.length != undefined) $('#length-help').text(data.length);  
                                            break;
                    }
                }
                
                
            },
            error: function(xhr,status,error) {
                alert('error');
            }
        
        });
    }else {
        $("#product_form").attr('valid','false');
    }
    
}))

    