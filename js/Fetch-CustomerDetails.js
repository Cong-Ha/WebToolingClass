$(document).ready(function(){

    console.log("js is firing!!!!!");


    window.readCustomer = function(customerId){
        console.log("fetching data for customer id:", customerId);

        //display loading image inside modal
        $('#customerDetails').html("<p class='text-primary>Loading customer details...</p>");

        $.ajax({
            url: 'read_customer.php',
            type: 'GET',
            data: {id: customerId},
            success: function(response) {
                console.log("Response recieved", response);
                $('#customerDetails').html(response);
            },
            error: function(xhr, status, error){
                console.log("AJAX Error:", error);
                $('#customerDetails').html("<p class='text-danger>error fetching details...</p>", error);
            }
        });

        //show modal if not open
        $('#readCustomerModal').modal('show');
    }
});