<?php 
require_once '../models/hotel_group.php';

class HotelGroupsController {
    function showAll() {
        $hotel_groups = HotelGroup::fetchAll();
        (new View('hotel_groups', array('hotel_groups' => $hotel_groups)
        ))->render();
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