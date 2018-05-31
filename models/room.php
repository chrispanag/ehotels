<?php 

require_once '../mysql_connector.php';
require_once '../models/hotel.php';
require_once '../models/reservation.php';

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

    function reserve($customer_id, $start_date, $finish_date, $paid) {
        $reservation_data = array(
            "customer_id" => $customer_id, 
            "room_id" => $this->id, 
            "start_date" => $start_date, 
            "finish_date" => $finish_date, 
            "paid" => $paid
        );
        $reservation = new Reservation($reservation_data);
        return $reservation->store();
    }

    function store() {
        global $con;
        $sql = "INSERT INTO ROOMS (price, capacity, view, amenities, repairs_need, expendable, hotel_id) VALUES ('".$this->price."','".$this->capacity."','".$this->view."','".$this->amenities."','".$this->repairs_need."','".$this->expendable."','".$this->hotel_id."')";
        $res = $con->query($sql);
        $this->id = $con->insert_id;
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

    static function fetchOne($id) {
        global $con;
        $result = $con->query("SELECT * FROM ROOMS WHERE id=".$id);
        $rooms_data = $result->fetch_all();
        return new Room($rooms_data[0]);
    }

    static function fetchAvailable($start_date, $finish_date, $price_range_bottom = 0, $price_range_top = 1000, $capacity = 1000, $stars, $selected_city, $selected_hotel_group) {
        global $con;

        $searchRENT = "WHERE (RENTS.start_date <= '{$start_date}' AND RENTS.finish_date >= '{$start_date}')
        OR (RENTS.start_date < '{$finish_date}' AND RENTS.finish_date >= '{$finish_date}' )
        OR ('{$finish_date}' <= RENTS.start_date AND '{$finish_date}' >= RENTS.start_date)";

        $searchRESERVES = "WHERE  (RESERVES.start_date <= '{$start_date}' AND RESERVES.finish_date >= '{$start_date}')
        OR (RESERVES.start_date < '{$finish_date}' AND RESERVES.finish_date >= '{$finish_date}' )
        OR ('{$finish_date}' <= RESERVES.start_date AND '{$finish_date}' >= RESERVES.start_date)";

        // For not in
        $one = "SELECT room_id FROM RENTS ". $searchRENT;
        $two = "SELECT room_id FROM RESERVES ". $searchRESERVES;

        // For price range
        $price_range = "(ROOMS.price BETWEEN {$price_range_bottom} AND {$price_range_top})";

        $capacity_check = "(ROOMS.capacity >= {$capacity})";

        $stars_check = "(HOTELS.stars >= {$stars})";

        $city_check = "1";
        if ($selected_city != "") $city_check = "(ADDRESSES.city = '{$selected_city}')";

        $hotel_group_check = "1";
        if ($selected_hotel_group != "") $hotel_group_check = "(HOTEL_GROUPS.id = '{$selected_hotel_group}')";

        $returning_fields = "
            ROOMS.id,
            ROOMS.price, 
            ROOMS.capacity, 
            ROOMS.view, 
            ROOMS.amenities, 
            ROOMS.repairs_need, 
            ROOMS.expendable, 
            ROOMS.hotel_id
        ";

        $result = $con->query("SELECT {$returning_fields} FROM 
            ROOMS 
            INNER JOIN HOTELS ON ROOMS.hotel_id = HOTELS.id
            INNER JOIN HOTEL_GROUPS ON HOTELS.hotel_group_id = HOTEL_GROUPS.id
            INNER JOIN ADDRESSES ON HOTELS.address_id = ADDRESSES.address_id
            WHERE 
                (ROOMS.id NOT IN ({$one}) 
                AND ROOMS.id NOT IN ({$two})) 
                AND {$price_range} 
                AND {$capacity_check}
                AND {$stars_check}
                AND {$city_check}
                AND {$hotel_group_check}");

        echo($con->error);
        $rooms_data = $result->fetch_all();
        return array_map(array('Room','createRoom'), $rooms_data);
    }

    static function fetchAvailableGroupBy($start_date, $finish_date, $price_range_bottom = 0, $price_range_top = 1000, $capacity = 1000, $stars, $selected_city, $selected_hotel_group) {
        global $con;

        $searchRENT = "WHERE (RENTS.start_date <= '{$start_date}' AND RENTS.finish_date >= '{$start_date}')
        OR (RENTS.start_date < '{$finish_date}' AND RENTS.finish_date >= '{$finish_date}' )
        OR ('{$finish_date}' <= RENTS.start_date AND '{$finish_date}' >= RENTS.start_date)";

        $searchRESERVES = "WHERE  (RESERVES.start_date <= '{$start_date}' AND RESERVES.finish_date >= '{$start_date}')
        OR (RESERVES.start_date < '{$finish_date}' AND RESERVES.finish_date >= '{$finish_date}' )
        OR ('{$finish_date}' <= RESERVES.start_date AND '{$finish_date}' >= RESERVES.start_date)";

        // For not in
        $one = "SELECT room_id FROM RENTS ". $searchRENT;
        $two = "SELECT room_id FROM RESERVES ". $searchRESERVES;

        // For price range
        $price_range = "(ROOMS.price BETWEEN {$price_range_bottom} AND {$price_range_top})";

        $capacity_check = "(ROOMS.capacity >= {$capacity})";

        $stars_check = "(HOTELS.stars >= {$stars})";

        $city_check = "1";
        if ($selected_city != "") $city_check = "(ADDRESSES.city = '{$selected_city}')";

        $hotel_group_check = "1";
        if ($selected_hotel_group != "") $hotel_group_check = "(HOTEL_GROUPS.id = '{$selected_hotel_group}')";

        $returning_fields = "
            COUNT(ROOMS.id),
            ADDRESSES.city
        ";

        $result = $con->query("SELECT {$returning_fields} 
            FROM ROOMS 
            INNER JOIN HOTELS ON ROOMS.hotel_id = HOTELS.id
            INNER JOIN HOTEL_GROUPS ON HOTELS.hotel_group_id = HOTEL_GROUPS.id
            INNER JOIN ADDRESSES ON HOTELS.address_id = ADDRESSES.address_id
            WHERE (
                (ROOMS.id NOT IN ({$one}) 
                AND ROOMS.id NOT IN ({$two})) 
                AND {$price_range} 
                AND {$capacity_check}
                AND {$stars_check}
                AND {$city_check}
                AND {$hotel_group_check}
            )
            GROUP BY ADDRESSES.city");

        echo($con->error);
        $rooms_data = $result->fetch_all();
        return $rooms_data;
    }
    
}

?>