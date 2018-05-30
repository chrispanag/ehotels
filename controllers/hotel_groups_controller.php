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

    function addHotelGroupView() {
        (new View('addHotelGroup', array(
            'phone' => "+XX XXXXXXXX",
            'email' => "hotel_group@example.com"
        ), "Add"))->render();
        die();
    }

    function editHotelGroupView() {
        $hotel_group = HotelGroup::fetchOne($_GET["id"]);
        (new View('addHotelGroup', array(
            'phone' => $hotel_group->phone,
            'email' => $hotel_group->email
        ), "Edit"))->render();
        die();
    }

    function addHotelGroup() {
        if (HotelGroup::addHotelGroup($_POST) === FALSE) {
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