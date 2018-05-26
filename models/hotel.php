<?php 

include '../mysql_connector.php';

require_once '../models/hotel_group.php';
require_once '../models/employee.php';

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
            $this->stars = $hotel_data[3];
            $this->hotel_group_id = $hotel_data[4];
            if (count($hotel_data) > 5) {
                $this->manager = new Employee(array_slice($hotel_data, 10));
            }
        } else {
            $this->email = $hotel_data["email"];
            $this->phone = $hotel_data["phone"];
            $this->stars = $hotel_data["stars"];
            $this->hotel_group_id = $hotel_data["hotel_group_id"];
        }
    }

    function rooms() {
        global $con;
        $result = $con->query("SELECT * FROM ROOMS WHERE hotel_id=" . $this->id);
        $result = $result->fetch_all();
        return array_map(array('Room','createRoom'), $result);
    }

    function hotelGroup() {
        global $con;
        $result = $con->query("SELECT * FROM HOTEL_GROUPS WHERE id=" . $this->hotel_group_id);
        $results = $result->fetch_all();
        return new HotelGroup($results[0]);
    }

    function store() {
        global $con;
        $sql = "INSERT INTO HOTELS (email_address, phone_number, stars, hotel_group_id) VALUES ('".$this->email."','".$this->phone."','".$this->stars."','".$this->hotel_group_id."')";
        $res = $con->query($sql);
        echo($con->error);
        $this->id = $con->insert_id;
        return $res;
    }

    function newEmployee($position, $employee_id) {
        global $con;
        $sql = "INSERT INTO WORKS (employee_id, hotel_id, position) VALUES ('".$employee_id."','".$this->id."','".$position."')";
        $res = $con->query($sql);
        echo($con->error);
        return $res;
    }

    function delete() {
        global $con;
        $con->query("DELETE FROM HOTELS WHERE id=" . $this->id);
    }

    static function addHotel($hotel_data) {
        $hotel = Hotel::createHotel($hotel_data);
        return Hotel::store($hotel);
    }

    public static function createHotel($hotel_data) {
        return new Hotel($hotel_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM (HOTELS INNER JOIN WORKS ON WORKS.hotel_id=HOTELS.id AND WORKS.position='manager') INNER JOIN EMPLOYEES ON EMPLOYEES.irs_number=employee_id");
        echo($con->error);
        $hotels_data = $result->fetch_all();
        return array_map(array('Hotel','createHotel'), $hotels_data);
    }
    
}

?>