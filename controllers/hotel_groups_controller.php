<?php 
require_once '../models/hotel_group.php';
require_once '../controllers/view_controller.php';

class HotelGroupsController {
    
    function showAll() {
        $hotel_groups = HotelGroup::fetchAll();
        (new View('hotel_groups', array('hotel_groups' => $hotel_groups)
        ))->render();
        die();
    }

    function newHotelGroup() {
        (new View('addHotelGroup', array(
            'hotel_groups' => $hotel_groups, 
            'phone' => "+XX XXXXXXXX",
            'email' => "example@example.com",
            'address' => new Address(array(
                'city' => 'City',
                'number' => 'XX',
                'postal_code' => 'XXX XX',
                'street' => 'Street'
            ))
        ), 'Add'))->render();
        die();
    }

    function addHotelGroupView() {
        (new View('addHotelGroup', array(
            'phone' => "+XX XXXXXXXX",
            'email' => "hotel_group@example.com",
            'address' => new Address(array(
                'city' => 'City',
                'number' => 'XX',
                'postal_code' => 'XXX XX',
                'street' => 'Street'
            ))
        ), "Add"))->render();
        die();
    }

    function editHotelGroupView() {
        $hotel_group = HotelGroup::fetchOne($_GET["id"]);
        (new View('addHotelGroup', array(
            'phone' => $hotel_group->phone,
            'email' => $hotel_group->email,
            'address' => $hotel_group->address
        ), "Edit"))->render();
        die();
    }

    function addHotelGroup() {
        $hotel = new HotelGroup($_POST);
        if ($hotel->store() === FALSE) {
            echo("Error");
        } else {
            header('Location: ./hotel_groups', TRUE, 302);
        }
        die();   
    }

    function deleteHotelGroup() {
        $hotel_group = new HotelGroup([$_GET["id"], "", "", "", ""]);
        $hotel_group->delete();
        header('Location: ./hotel_groups', TRUE, 302);
        die();
    }
}
?>