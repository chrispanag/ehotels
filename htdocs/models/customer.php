<?php 

include 'mysql_connector.php';

class customer {

    function __construct($customer_data) {
        $this->irs_num = $customer_data[0];
        $this->ssn = $customer_data[1];
        $this->first_name = $customer_data[2];
        $this->last_name = $customer_data[3];
        $this->first_registration = $customer_data[4];
    }

    private static function createCustomer($customer_data) {
        return new Hotel($customer_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM CUSTOMER");
        $con->close();
        $customer_data = $result->fetch_all();
        return array_map(array('Customer','createCustomer'), $customers_data);
    }
    
}

?>
