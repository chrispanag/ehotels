<?php 

require_once '../mysql_connector.php';

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
            if (count($hotel_data) > 6) {
                $this->manager = new Employee(array_slice($hotel_data, 10));
            }
            if (count($hotel_data) > 16) {
                $this->address = new Address(array_slice($hotel_data, 16));
            }
                
        } else {
            $this->email = $hotel_data["email"];
            $this->phone = $hotel_data["phone"];
            $this->stars = $hotel_data["stars"];
            $this->hotel_group_id = $hotel_data["hotel_group_id"];
            $this->address = new Address($hotel_data);
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
        $this->address->store();
        $this->address_id = $this->address->id;
        $sql = "INSERT INTO HOTELS (email_address, phone_number, stars, hotel_group_id, address_id) VALUES ('".$this->email."','".$this->phone."','".$this->stars."','".$this->hotel_group_id."','".$this->address_id."')";
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

    function update ($field_list) {
        if (count($field_list) > 0) {

            $set_values = "";

            unset($field_list["employee_id"]);
            foreach ($field_list as $key => $value) {
                if ($key == "email")
                    $key = "email_address";
                if ($key == "phone")
                    $key = "phone_number";

                if (gettype($value) == "string") {
                    $value = "'{$value}'";
                }
                if ($value != "")
                    $set_values .= $key ."=".$value.", ";
            }

            if ($set_values != "") {
                global $con;

                $set_values = substr($set_values, 0, -2)." ";
                $sql = "UPDATE HOTELS SET {$set_values} WHERE id={$this->id}";
                $res = $con->query($sql);
                echo($con->error);
                return $res;
            }
        }

        return true;
    }

    function delete() {
        global $con;
        $con->query("DELETE FROM HOTELS WHERE id=" . $this->id);
    }

    static function addHotel($hotel_data) {
        $hotel = Hotel::createHotel($hotel_data);
        return Hotel::store($hotel);
    }

    static function fetchOne($id) {
        global $con;
        $result = $con->query("SELECT * FROM (HOTELS INNER JOIN WORKS ON WORKS.hotel_id=HOTELS.id AND WORKS.position='manager') INNER JOIN EMPLOYEES ON EMPLOYEES.irs_number=employee_id INNER JOIN ADDRESSES ON HOTELS.address_id = ADDRESSES.address_id WHERE id=".$id);
        echo($con->error);
        $hotels_data = $result->fetch_all();
        return new Hotel($hotels_data[0]);
    }

    public static function createHotel($hotel_data) {
        return new Hotel($hotel_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM (HOTELS INNER JOIN WORKS ON WORKS.hotel_id=HOTELS.id AND WORKS.position='manager') INNER JOIN EMPLOYEES ON EMPLOYEES.irs_number=employee_id INNER JOIN ADDRESSES ON HOTELS.address_id = ADDRESSES.address_id");
        echo($con->error);
        $hotels_data = $result->fetch_all();
        return array_map(array('Hotel','createHotel'), $hotels_data);
    }

    private static function unpack($element) {
        return $element[0];
    } 

    static function fetchAvailableAreas() {
        global $con;
        $result = $con->query("SELECT DISTINCT ADDRESSES.city FROM HOTELS INNER JOIN ADDRESSES ON ADDRESSES.address_id = HOTELS.address_id");
        echo($con->error);
        $cities = $result->fetch_all();
        return array_map(array('Hotel','unpack'), $cities);
    }
    
}

?>