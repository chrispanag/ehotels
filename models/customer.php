<?php 

include '../mysql_connector.php';

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
        } else {
            $this->irs_number = $customer_data["irs_number"];
            $this->ssn = $customer_data["ssn"];
            $this->first_name = $customer_data["first_name"];
            $this->last_name = $customer_data["last_name"];
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
        $sql = "INSERT INTO CUSTOMERS (irs_number, ssn, first_name, last_name) VALUES ('".$this->irs_number."','".$this->ssn."','".$this->first_name."','".$this->last_name."')";
        $res = $con->query($sql);
        echo($con->error);
        return $res;
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM CUSTOMERS");
        $customers_data = $result->fetch_all();
        return array_map(array('Customer','createCustomer'), $customers_data);
    }
    
}

?>
