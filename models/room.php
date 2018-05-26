<?php 

require_once '../mysql_connector.php';
require_once '../models/hotel.php';

class Room {

    private function isAssoc(array $arr) {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    function __construct($room_data) {
        if (!Room::isAssoc($room_data)) {
            $this->id = $room_data[0];
            $this->price = $room_data[1];
            $this->capacity = $room_data[2];
            $this->view = $room_data[3];
            $this->amenities = $room_data[4];
            $this->repairs_need = $room_data[5];
            $this->expendable = $room_data[6];
            $this->hotel_id = $room_data[7];
        } else {
            $this->price = $room_data["price"];
            $this->capacity = $room_data["capacity"];
            $this->view = $room_data["view"];
            $this->amenities = $room_data["amenities"];
            $this->repairs_need = $room_data["repairs_need"];
            $this->expendable = $room_data["expendable"];
            $this->hotel_id = $room_data["hotel_id"];
        }
    }

    function hotel() {
        global $con;
        $result = $con->query("SELECT * FROM HOTELS WHERE id=".$this->hotel_id);
        $results = $result->fetch_all();
        return new Hotel($results[0]);
    }

    function delete() {
        global $con;
        $con->query("DELETE FROM ROOMS WHERE id=" . $this->id);
    }

    static function store($room) {
        global $con;
        $sql = "INSERT INTO ROOMS (price, capacity, view, amenities, repairs_need, expendable, hotel_id) VALUES ('".$room->price."','".$room->capacity."','".$room->view."','".$room->amenities."','".$room->repairs_need."','".$room->expendable."','".$room->hotel_id."')";
        $res = $con->query($sql);
        echo($con->error);
        return $res;
    }

    static function addRoom($room_data) {
        $room = Room::createRoom($room_data);
        return Room::store($room);
    }

    public static function createRoom($room_data) {
        return new Room($room_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM ROOMS");
        $rooms_data = $result->fetch_all();
        return array_map(array('Room','createRoom'), $rooms_data);
    }
    
}

?>