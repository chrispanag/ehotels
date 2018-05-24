<?php 
require_once '../models/room.php';
require_once '../models/hotel.php';
require_once '../controllers/view_controller.php';

class RoomController {
    
    function showAll() {
        $rooms = Room::fetchAll();
        (new View('rooms', array('rooms' => $rooms) 
        ))->render();
        die();
    }

    function newRoom() {
        $hotels = Hotel::fetchAll();
        (new View('addRoom', array('hotels' => $hotels)))->render();
        die();
    }

    function addRoom() {
        if (Room::addRoom($_POST) === FALSE) {
            echo("Error");
        } else {
            header('Location: ./rooms', TRUE, 302);
        }
        die();   
    }

    function deleteRoom() {
        $room = new Room([$_GET["id"], "", "", "", "", "", "", ""]);
        $room->delete();
        header('Location: ./rooms', TRUE, 302);
        die();
    }
}

?>