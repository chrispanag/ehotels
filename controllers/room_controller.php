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
        $customers = Customer::fetchAll();
        (new View('reserveRoom', array('customers' => $customers, 'room_id'=> $_GET["id"])))->render();
    }

    function reserveRoom() {
        $room = Room::fetchOne($_POST['room_id']);
        $paid = '0';
        if ($_POST['paid'] === 'on') $paid = '1';
        $room->reserve($_POST['customer_id'], $_POST['start_date'], $_POST['finish_date'], $paid);
        header('Location: ./rooms', TRUE, 302);
        die();
    }
}

?>