<?php 
require_once '../models/room.php';
require_once '../models/hotel.php';
require_once '../models/hotel_group.php';
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
        $cities = Hotel::fetchAvailableAreas();
        $hotel_groups = HotelGroup::fetchAll();

        $start_date = '0000-01-01';
        $finish_date = '2999-12-31';
        $price_start = 0;
        $price_upper = 10000;
        $capacity = 0;
        $stars = 0;
        $selected_city = "";
        $selected_hotel_group = "";

        if (array_key_exists('start_date', $_GET))
            $start_date = $_GET['start_date'];
        if (array_key_exists('finish_date', $_GET))
            $finish_date = $_GET['finish_date'];
        if (array_key_exists('price_upper', $_GET))
            $price_upper = $_GET['price_upper'];
        if (array_key_exists('price_start', $_GET))
            $price_start = $_GET['price_start'];
        if (array_key_exists('capacity', $_GET))
            $capacity = $_GET['capacity'];
        if (array_key_exists('stars', $_GET))
            $stars = $_GET['stars'];
        if (array_key_exists('selected_city', $_GET))
            $selected_city = $_GET['selected_city'];
        if (array_key_exists('selected_hotel_group', $_GET))
            $selected_hotel_group = $_GET['selected_hotel_group'];

        if ($_GET['action'] == "default") {
            $rooms = Room::fetchAvailable($start_date, $finish_date,  $price_start, $price_upper, $capacity, $stars, $selected_city, $selected_hotel_group);
            (new View('availableRooms', array(
                'rooms' => $rooms,
                'start_date' => $start_date,
                'finish_date' => $finish_date,
                'price_upper' => $price_upper,
                'price_start' => $price_start,
                'capacity' => $capacity,
                'stars' => $stars,
                'cities' => $cities,
                'hotel_groups' => $hotel_groups,
                'selected_city' => $selected_city,
                'selected_hotel_group' => $selected_hotel_group
                ) 
            ))->render();
            die();
        } else {
            $locations = Room::fetchAvailableGroupBy($start_date, $finish_date,  $price_start, $price_upper, $capacity, $stars, $selected_city, $selected_hotel_group);
            (new View('availableRoomsGroupedBy', array(
                'locations' => $locations,
                'start_date' => $start_date,
                'finish_date' => $finish_date,
                'price_upper' => $price_upper,
                'price_start' => $price_start,
                'capacity' => $capacity,
                'stars' => $stars,
                'cities' => $cities,
                'hotel_groups' => $hotel_groups,
                'selected_city' => $selected_city,
                'selected_hotel_group' => $selected_hotel_group
                ) 
            ))->render();
            die();
        }

        
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