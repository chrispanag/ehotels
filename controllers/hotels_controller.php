<?php 
require_once '../models/hotel.php';
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
        (new View('addHotel', array('hotel_groups' => $hotel_groups)))->render();
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

    function deleteHotel() {
        $hotel = new Hotel([$_GET["id"], "", "", "", ""]);
        $hotel->delete();
        header('Location: ./hotels', TRUE, 302);
        die();
    }
}

?>