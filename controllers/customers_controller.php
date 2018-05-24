a<?php 
require_once '../models/customer.php';
require_once '../controllers/view_controller.php';

class CustomersController {

    function showAll() {
        $customers = Customer::fetchAll();
        (new View('customers', array('customers' => $customers)
        ))->render();
        die();
    }

    function addCustomer() {
        if (Customer::addCustomer($_POST) === FALSE) {
            echo("Error");
        } else {
            header('Location: ./customers', TRUE, 302);
        }
        die();   
    }

    function deleteCustomer() {
        $customer = new Customer([$_GET["id"], "", "", "", ""]);
        $customer->delete();
        header('Location: ./customers', TRUE, 302);
        die();
    }
}

?>