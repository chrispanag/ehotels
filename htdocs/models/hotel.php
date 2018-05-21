<?php 

include 'mysql_connector.php';

class Hotel {

    function __construct($hotel_data) {
        $this->id = $hotel_data[0];
        $this->email = $hotel_data[1];
        $this->phone = $hotel_data[2];
        $this->rooms = $hotel_data[3];
        $this->stars = $hotel_data[4];
    }

    private static function createHotel($hotel_data) {
        return new Hotel($hotel_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM HOTELS");
        $con->close();
        $hotels_data = $result->fetch_all();
        return array_map(array('Hotel','createHotel'), $hotels_data);
    }
    
}

?>