<?php 
require_once '../models/hotel_room.php';
require_once '../controllers/view_controller.php';

class Hotel_Room_Controller {
    
    function showAll() {
        $hotel_rooms = Hotel_Room::fetchAll();
        (new View('hotel_rooms', array('hotel_rooms' => $hotel_rooms) 
        ))->render();
        die();
    }

    function addHotel_Room() {
        if (Hotel_Room::addHotel_Room($_POST) === FALSE) {
            echo("Error");
        } else {
            header('Location: ./hotel_rooms', TRUE, 302);
        }
        die();   
    }

    function deleteHotel_Room() {
        $hotel_room = new Hotel_Room([$_GET["id"], "", "", "", ""]);
        $hotel_room->delete();
        header('Location: ./hotel_rooms', TRUE, 302);
        die();
    }
}

?>