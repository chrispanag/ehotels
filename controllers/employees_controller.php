<?php 
require_once '../models/employee.php';
require_once '../controllers/view_controller.php';

class EmployeesController {
    
    function showAll() {
        $employees = Employee::fetchAll();
        (new View('employees', array('employees' => $employees)
        ))->render();
        die();
    }

    function newEmployee() {
        (new View('addEmployee', array(
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

    function editEmployee() {
        $employee= Employee::fetchOne($_GET["id"]);
        $employees = Employee::fetchAll();
        (new View('addEmployee', array(
            'employees' => $employees,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'ssn' => $employee->ssn,
            'irs_number' => $employees->irs_number,
            'address' => $hotel->address
        ), 'Edit'))->render();
        die();
    }

    function addEmployee() {
        $employee = new Employee($_POST);

        if ($employee->store() === FALSE) {
            echo("Error");
        } else {
            header('Location: ./employees', TRUE, 302);
        }
        die();   
    }

    function deleteEmployee() {
        $employee = new Employee([$_GET["id"], "", "", "", ""]);
        $employee->delete();
        header('Location: ./employees', TRUE, 302);
        die();
    }
}

?>