<?php 

include '../mysql_connector.php';

class HotelRoom {

    function __construct($hotel_room_data) {
        $this->id = $hotel_room_data[0];
        $this->price = $hotel_room_data[1];
        $this->capacity = $hotel_room_data[2];
        $this->view = $hotel_room_data[3];
        $this->amenities = $hotel_room_data[4];
	    $this->expendable = $hotel_room_data[5];
    }

    private static function createHotelRoom($hotel_room_data) {
        return new HotelRoom($hotel_room_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM ROOMS");
        $con->close();
        $hotel_rooms_data = $result->fetch_all();
        return array_map(array('HotelRoom','createHotelRoom'), $hotel_rooms_data);
    }
    
}

?>
