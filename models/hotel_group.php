<?php 

include '../mysql_connector.php';

class HotelGroup {

    function __construct($hotel_group_data) {
        $this->id = $hotel_group_data[0];
        $this->email = $hotel_group_data[1];
        $this->phone = $hotel_group_data[2];
        $this->hotel_number = $hotel_group_data[3];
    }

    private static function createHotel_Group($hotel_group_data) {
        return new HotelGroup($hotel_group_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM HOTEL_GROUPS");
        $con->close();
        $hotel_groups_data = $result->fetch_all();
        return array_map(array('HotelGroup','createHotel_Group'), $hotel_groups_data);
    }
    
}

?>
