<?php 

include 'mysql_connector.php';

class Hotel {

    private function isAssoc(array $arr) {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    function __construct($hotel_data) {
        if (!Hotel::isAssoc($hotel_data)) {
            $this->id = $hotel_data[0];
            $this->email = $hotel_data[1];
            $this->phone = $hotel_data[2];
            $this->rooms = $hotel_data[3];
            $this->stars = $hotel_data[4];
        } else {
            $this->email = $hotel_data["email"];
            $this->phone = $hotel_data["phone"];
            $this->rooms = $hotel_data["rooms"];
            $this->stars = $hotel_data["stars"];
        }
        
    }

    function delete() {
        global $con;
        $con->query("DELETE FROM HOTELS WHERE id=" . $this->id);
    }

    static function store($hotel) {
        global $con;
        $sql = "INSERT INTO HOTELS (email_address, phone_number, number_of_rooms, stars) VALUES ('".$hotel->email."','".$hotel->phone."','".$hotel->rooms."','".$hotel->stars."')";
        if ($con->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $con->error;
        } else {
            header('Location: ./hotels', TRUE, 302);
            die();
        }
    }

    static function addHotel($hotel_data) {
        $hotel = Hotel::createHotel($hotel_data);
        return Hotel::store($hotel);
    }

    private static function createHotel($hotel_data) {
        return new Hotel($hotel_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM HOTELS");
        $hotels_data = $result->fetch_all();
        return array_map(array('Hotel','createHotel'), $hotels_data);
    }
    
}

?>