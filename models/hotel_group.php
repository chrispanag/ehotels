<?php 

require_once '../mysql_connector.php';
require_once '../models/hotel.php';

class HotelGroup {

    private function isAssoc(array $arr) {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    function __construct($hotel_group_data) {
        if (!HotelGroup::isAssoc($hotel_group_data)) {
            $this->id = $hotel_group_data[0];
            $this->email = $hotel_group_data[1];
            $this->phone = $hotel_group_data[2];
        } else {
            $this->email = $hotel_group_data["email"];
            $this->phone = $hotel_group_data["phone"];
        }
    }

    function delete() {
        global $con;
        $con->query("DELETE FROM HOTEL_GROUPS WHERE id=" . $this->id);
    }

    function getHotels() {
        global $con;
        $result = $con->query("SELECT * FROM HOTELS WHERE hotel_group_id=" . $this->id);
        $hotels = $result->fetch_all();
        return array_map(array('Hotel','createHotel'), $hotels);
    }

    private static function createHotel_Group($hotel_group_data) {
        return new HotelGroup($hotel_group_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM HOTEL_GROUPS");
        $hotel_groups_data = $result->fetch_all();
        return array_map(array('HotelGroup','createHotel_Group'), $hotel_groups_data);
    }

    static function store($hotel_group) {
        global $con;
        $sql = "INSERT INTO HOTEL_GROUPS (email, phone) VALUES ('".$hotel_group->email."','".$hotel_group->phone."')";
        $res = $con->query($sql);
        echo($con->error);
        return $res;
    }

    static function addHotelGroup($hotel_group_data) {
        $hotel_group = new HotelGroup($hotel_group_data);
        return HotelGroup::store($hotel_group);
    }

    static function fetchOne($id) {
        global $con;
        $result = $con->query("SELECT * FROM HOTEL_GROUPS WHERE id=".$id);
        echo($con->error);
        $hotels_group_data = $result->fetch_all();
        return new HotelGroup($hotels_group_data[0]);
    }
    
}

?>
