<?php 
require_once '../models/hotel_group.php';
require_once '../controllers/view_controller.php'

class HotelGroupsController {
    function showAll() {
        $hotel_groups = HotelGroup::fetchAll();
        (new View('hotel_groups', array('hotel_groups' => $hotel_groups)
        ))->render();
        die();
    }
}
?>