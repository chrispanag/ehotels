<?php 
require_once '../models/room.php';
require_once '../models/hotel.php';
require_once '../models/customer.php';

require_once '../controllers/view_controller.php';

class RoomController {
    
    function showAll() {
        $rooms = Room::fetchAll();
        (new View('rooms', array('rooms' => $rooms) 
        ))->render();
        die();
    }

    function showAllAvailable() {
        $start_date = '0000-01-01';
        $finish_date = '2999-12-31';
        if (array_key_exists('start_date', $_GET))
            $start_date = $_GET['start_date'];
        if (array_key_exists('finish_date', $_GET))
            $finish_date = $_GET['finish_date'];

        $rooms = Room::fetchAvailable($start_date, $finish_date);
        (new View('availableRooms', array(
            'rooms' => $rooms,
            'start_date' => $start_date,
            'finish_date' => $finish_date
            ) 
        ))->render();
        die();
    }

    function newRoom() {
        $hotels = Hotel::fetchAll();
        (new View('addRoom', array(
            'hotels' => $hotels,
            'price' => "€",
            'capacity' => "",
            'view' => "",
            'amenities' => "",
            'repairs_need' => "What needs to be fixed",
            'expendable' => "",
        ), 'Add'))->render();
        die();
    }

    function editRoom() {
        $room= Room::fetchOne($_GET["id"]);
        (new View('addRoom', array(
            'hotels' => $hotels,
            'price' => $room->price,
            'capacity' => $room->capacity,
            'view' => $room->view,
            'amenities' => $room->amenities,
            'repairs_need' => $room->repairs_need,
            'expendable' => $room->expendable,
        ), 'Edit'))->render();
        die();
    }


    function addRoom() {
        $room = new Room($_POST);
        if ($room->store() === FALSE) {
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

    function reserveRoomView() {
        $rooms = Room::fetchAll();
        $customers = Customer::fetchAll();
        (new View('newReservation', array(
            'start_date' => $_GET['start_date'],
            'finish_date' => $_GET['finish_date'],
            'rooms' => $rooms, 
            'customers' => $customers,
            'room_id' => $_GET['id']
        ), 'Add'))->render();
        die();
    }
}

?>