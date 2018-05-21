<?php 
require_once '../models/hotel.php';
require_once '../controllers/view_controller.php';

class HotelsController {
    function showAll() {
        $hotels = Hotel::fetchAll();
        (new View('hotels', array('hotels' => $hotels)
        ))->render();
        die();
    }

    function addHotel() {
        if (Hotel::addHotel($_POST) === FALSE) {
            echo("Error");
        } else {
            header('Location: ./hotels', TRUE, 302);
        }
        die();
        
    }
}

?>