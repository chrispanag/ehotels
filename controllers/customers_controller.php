<?php 
require_once '../models/customer.php';
require_once '../controllers/view_controller.php';

class CustomersController {

    function showAll() {
        $customers = Customer::fetchAll();
        (new View('customers', array('customers' => $customers)
        ))->render();
        die();
    }

    function newCustomer() {
        $customers = Customer::fetchAll();
        (new View('addCustomer', array(
            'customers' => $customers,
            'irs_number' => "",
            'ssn' => "Social Security Number",
            'first_name' => "First Name",
            'last_name' => "Last Name",
            'address' => new Address(array(
                'city' => 'City',
                'number' => 'XX',
                'postal_code' => 'XXX XX',
                'street' => 'Street'
            ))
        ), 'Add'))->render();
        die();
    }

    function editCustomer() {
        $customer = Customer::fetchOne($_GET["id"]);
        $customers = Customer::fetchAll();
        (new View('addCustomer', array(
            'customers' => $customers,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'ssn' => $customer->ssn,
            'irs_number' => $customer->irs_number,
            'address' => $hotel->address
        ), 'Edit'))->render();
        die();
    }

    function addCustomer() {
        $customer = new Customer($_POST);
        if ($customer->store() === FALSE) {
            echo("Error");
        } else {
            header('Location: ./customers', TRUE, 302);
        }
        die();   
    }

    function deleteCustomer() {
        $customer = new Customer(array($_GET["id"], "", "", "", ""));
        $customer->delete();
        header('Location: ./customers', TRUE, 302);
        die();
    }
}

?>