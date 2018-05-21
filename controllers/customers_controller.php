<?php 
require_once '../models/customer.php';

class CustomersController {

    function showAll() {
        $customers = Customer::fetchAll();
        (new View('customers', array('customers' => $customers)
        ))->render();
        die();
    }
}

?>