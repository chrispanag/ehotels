<?php 
require_once '../models/hotel.php';
require_once '../models/employee.php';
require_once '../models/hotel_group.php';
require_once '../controllers/view_controller.php';

class HotelsController {
    
    function showAll() {
        $hotels = Hotel::fetchAll();
        (new View('hotels', array('hotels' => $hotels)
        ))->render();
        die();
    }

    function newHotel() {
        $hotel_groups = HotelGroup::fetchAll();
        $employees = Employee::fetchAll();
        (new View('addHotel', array('hotel_groups' => $hotel_groups, 'employees' => $employees)))->render();
        die();
    }

    function addHotel() {
        $hotel = new Hotel($_POST);
        $res = $hotel->store() && $hotel->newEmployee("manager", $_POST["employee_id"]);
        if ($res === FALSE) {
            echo("Error");
        } else {
            header('Location: ./hotels', TRUE, 302);
        }
        die();   
    }

    function deleteHotel() {
        $hotel = new Hotel([$_GET["id"], "", "", "", ""]);
        $hotel->delete();
        header('Location: ./hotels', TRUE, 302);
        die();
    }
}

?>