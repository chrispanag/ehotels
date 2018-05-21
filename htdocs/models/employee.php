<?php 

include 'mysql_connector.php';

class Employee {

    function __construct($employee_data) {
        $this->irs_num = $employee_data[0];
        $this->ssn = $employee_data[1];
        $this->first_name = $employee_data[2];
        $this->last_name = $employee_data[3];
        //$this->stars = $hotel_data[4];
    }

    function delete() {
        global $con;
        $con->query("DELETE FROM EMPLOYEES WHERE irs_num=" + $this->irs_num);
    }

    private static function createEmployee($employee_data) {
        return new Employee($employee_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM EMPLOYEES");
        $con->close();
        $employee_data = $result->fetch_all();
        return array_map(array('Employee','createEmployee'), $employee_data);
    }
    
}

?>
