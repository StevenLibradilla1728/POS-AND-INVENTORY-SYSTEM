
$(document).ready(function() {

    //alertify.set('notifier', 'position', 'top-right');

    $(document).on('click', '.increment', function () {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty'); 
        var productId = $(this).closest('.qtyBox').find('.prodId').val(); // Remove $ here
        
        var currentValue = parseInt($quantityInput.val());

        if(!isNaN(currentValue)){
            var qtyVal = currentValue + 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal); // Now using productId without $
        
        }
    });

    $(document).on('click', '.decrement', function () {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty'); 
        var productId = $(this).closest('.qtyBox').find('.prodId').val(); // Remove $ here
        
        var currentValue = parseInt($quantityInput.val());

        if(!isNaN(currentValue) && currentValue > 1){
            var qtyVal = currentValue - 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal); // Now using productId without $
        }
    });

    function quantityIncDec(prodId, qty){

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'productIncDec': true,
                'product_id': prodId,
                'stock_level': qty
            },
            success: function (response){
                var res = JSON.parse(response);

                if(res.status == 200){
                    window.location.reload();
                    
                    alertify.success(res.message);
                } else { 
                    alertify.error(res.message);
                }
            }
        });
    }

    
    //Proceed to Place Order Button
    $(document).on('click', '.proceedToPlace', function () {
        
        var cphone = $('#cphone').val();
        var payment_mode = $('#payment_mode').val();

        if(payment_mode == ''){

            swal("Select Payment Mode", "Select your payment mode", "warning");
            return false;
        } 

        if(cphone == '' && !$.isNumeric(cphone)){

            swal("Enter Phone Number", "Enter Valid Phone Number", "warning");
            return false;
        }
        var data = {
            'proceedToPlace': true,
            'cphone': cphone,
            'payment_mode': payment_mode,
        };

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: data,
            success: function (response) {
                var res = JSON.parse(response);
                if(res.status == 200){
                    window.location.href = "order-summary.php";
                }
                else if(res.status == 404){

                    swal(res.message, res.message, res.status_type, {
                        buttons: {
                            catch: {
                                text: "Add Customer",
                                value: "catch"
                            },
                            cancel: "Cancel"
                        }
                    })
                    .then((value) => {
                        switch(value){

                            case "catch":
                                $('#c_phone').val(cphone);
                                $('#addCustomerModal').modal('show');
                                //console.log('Pop the customer add modal');
                                break;
                            default:  
                        }
                    });
                }else{
                    swal(res.message, res.message, res.status_type);
                }
            }
        });
    });


    //Add customer to customers table
    $(document).on('click', '.saveCustomer', function () {

        var c_name = $('#c_name').val();
        var c_phone = $('#c_phone').val();
        var c_email = $('#c_email').val();

        if(c_name != '' && c_phone != '')
        {
            if($.isNumeric(c_phone)){

                var data = {
                    'saveCustomer': true,
                    'fullname': c_name,
                    'phone': c_phone,
                    'email': c_email,
                };

                $.ajax({
                    type: "POST",
                    url: "orders-code.php",
                    data: data,
                    success: function (response){
                        var res = JSON.parse(response);
                        
                        if(res.status == 200){
                            swal(res.message, res.message, res.status_type);
                            $('#addCustomerModal').modal('hide');
                        }
                        else if(res.status == 422){
                            swal(res.message, res.message, res.status_type);
                        }
                        else
                        {
                            swal(res.message, res.message, res.status_type);
                        }
                    }
                });
                
            }else{
                swal("Enter Valid Phone Number", "", "warning");
            }
        }
        else
        {
            swal("Please fill the required fields", "", "warning");
        }     

    });

    

    $(document).on('click', '#saveOrder', function () {
        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'saveOrder': true
            },
            success: function (response){
                var res = JSON.parse(response);
                console.log(res); // Debugging: check the response data
    
                if(res.status == 200) {
                    swal(res.message, res.message, res.status_type);
                    $('#orderPlacedSuccessMessage').text(res.message);
    
                    // Show modal using Bootstrap 5's JavaScript API
                    var orderSuccessModal = new bootstrap.Modal(document.getElementById('orderSuccessModal'));
                    orderSuccessModal.show();
                } else {
                    swal(res.message, res.message, res.status_type);
                }
            }
        });
    });

    
});
 