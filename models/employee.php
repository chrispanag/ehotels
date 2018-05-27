<?php 

include '../mysql_connector.php';

class Employee {

    private function isAssoc(array $arr) {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    function __construct($employee_data) {
        if (!Employee::isAssoc($employee_data)) {
            $this->irs_number = $employee_data[0];
            $this->ssn = $employee_data[1];
            $this->first_name = $employee_data[2];
            $this->last_name = $employee_data[3];
        } else {
            $this->irs_number = $employee_data["irs_number"];
            $this->ssn = $employee_data["ssn"];
            $this->first_name = $employee_data["first_name"];
            $this->last_name = $employee_data["last_name"];
        }
    }

    function getPositions() {
        global $con;
        $sql = "SELECT position, HOTELS.email_address FROM WORKS INNER JOIN HOTELS WHERE WORKS.hotel_id=HOTELS.id AND WORKS.employee_id=".$this->irs_number;
        $result = $con->query($sql);
        echo($con->error);
        return $result->fetch_all();
    }

    function store() {
        global $con;
        $sql = "INSERT INTO EMPLOYEES (irs_number, ssn, first_name, last_name) VALUES ('".$this->irs_number."','".$this->ssn."','".$this->first_name."','".$this->last_name."')";
        $res = $con->query($sql);
        echo($con->error);
        return $res;
    }

    function newPosition($position, $hotel_id) {
        global $con;
        $sql = "INSERT INTO WORKS (employee_id, hotel_id, position) VALUES ('".$this->irs_number."','".$hotel_id."','".$position."')";
        $res = $con->query($sql);
        echo($con->error);
        return $res;
    }

    function delete() {
        global $con;
        $res = $con->query("DELETE FROM EMPLOYEES WHERE irs_number=" . $this->irs_number);
        echo($con->error);
        return $res;
    }

    private static function createEmployee($employee_data) {
        return new Employee($employee_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM EMPLOYEES");
        $employee_data = $result->fetch_all();
        return array_map(array('Employee','createEmployee'), $employee_data);
    }
    
}

?>
