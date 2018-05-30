<?php 

require_once '../mysql_connector.php';
require_once '../models/address.php';

class Customer {

    private function isAssoc(array $arr) {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    function __construct($customer_data) {
        if (!Customer::isAssoc($customer_data)) {
            $this->irs_number = $customer_data[0];
            $this->ssn = $customer_data[1];
            $this->first_name = $customer_data[2];
            $this->last_name = $customer_data[3];
            $this->first_registration = $customer_data[4];
            if (count($customer_data) > 5)
                $this->address = new Address(array_slice($customer_data, 6));
        } else {
            $this->irs_number = $customer_data["irs_number"];
            $this->ssn = $customer_data["ssn"];
            $this->first_name = $customer_data["first_name"];
            $this->last_name = $customer_data["last_name"];
            $this->address = new Address($customer_data);
        }
    }

    private static function createCustomer($customer_data) {
        return new Customer($customer_data);
    }

    function delete() {
        global $con;
        $res = $con->query("DELETE FROM CUSTOMERS WHERE irs_number=".$this->irs_number);
        echo($con->error);
        return $res;
    }

    function store() {
        global $con;
        $this->address_id = $this->address->store();
        $sql = "INSERT INTO CUSTOMERS (irs_number, ssn, first_name, last_name, address_id) VALUES ('".$this->irs_number."','".$this->ssn."','".$this->first_name."','".$this->last_name."','".$this->address_id."')";
        $res = $con->query($sql);
        echo($con->error);
        return $res;
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM CUSTOMERS INNER JOIN ADDRESSES ON CUSTOMERS.address_id = ADDRESSES.address_id");
        $customers_data = $result->fetch_all();
        return array_map(array('Customer','createCustomer'), $customers_data);
    }
    
}

?>
