<?php 

include 'mysql_connector.php';

class Hotel_Room {

    function __construct($hotel_room_data) {
        $this->id = $hotel_room_data[0];
        $this->price = $hotel_room_data[1];
        $this->capacity = $hotel_room_data[2];
        $this->view = $hotel_room_data[3];
        $this->amenities = $hotel_room_data[4];
	$this->expendable = $hotel_room_data[5];
    }

    private static function createHotel_Room($hotel_room_data) {
        return new Hotel_Room($hotel_room_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM HOTEL_ROOMS");
        $con->close();
        $hotel_rooms_data = $result->fetch_all();
        return array_map(array('Hotel_Room','createHotel_Room'), $hotel_rooms_data);
    }
    
}

?>
