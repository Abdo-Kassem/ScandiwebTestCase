$('#delete-product-ptn').on('click',function() {

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

    $.ajax({

        method : 'get',
        url : 'deleteAll',
        data : skus,

        success:function(data) {
            console.log(data);
            if(data.status == true) {
                checkboxes.forEach(function(checkbox) {
                    if(checkbox.checked)
                        checkbox.parentNode.remove();
                });
            }
        },
        error : function(xhr,status,error) {
            alert('error');
        }

    })

}) 
