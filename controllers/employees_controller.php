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