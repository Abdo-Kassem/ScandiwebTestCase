$('#delete-product-btn').on('click',function() {

    var skus = {skus:[]};
    var counter = 0;
    $checkboxes = $('.delete-checkbox');

    checkboxes = Array.from($checkboxes);

    checkboxes.forEach(function(checkbox){
        
        if(checkbox.checked == true) {
            skus.skus[counter] = $(checkbox).attr('sku');
            counter++;
        }

    })

    if((skus.skus).length > 0) {
        $.ajax({

            method : 'get',
            url : 'deleteAll',
            data : skus,

            success:function(data) {
            
                if(data.status == true) {
                    checkboxes.forEach(function(checkbox) {
                        if(checkbox.checked)
                            checkbox.parentNode.remove();
                    });
                }

                if(checkboxes.length == 0) {
                    $('#delete-product-btn').hide(300);
                }
            },
            error : function(xhr,status,error) {
                alert('error');
            }

        });
    }

}) 
