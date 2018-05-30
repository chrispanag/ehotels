<?php 

require_once '../mysql_connector.php';

class Reservation {

    private function isAssoc(array $arr) {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    function __construct($reservation_data) {
        if (!Reservation::isAssoc($reservation_data)) {
            $this->customer_id = $reservation_data[0];
            $this->room_id = $reservation_data[1];
            $this->start_date = $reservation_data[2];
            $this->finish_date = $reservation_data[3];
            $this->paid = $reservation_data[4];
            if (count($reservation_data) < 12)
                $this->customer = new Customer(array_slice($reservation_data, 5, 5));
            else if (count($reservation_data) > 12)
                $this->room = new Room(array_slice($reservation_data, 5));
        } else {
            $this->customer_id = $reservation_data["customer_id"];
            $this->room_id = $reservation_data["room_id"];
            $this->start_date = $reservation_data["start_date"];
            $this->finish_date = $reservation_data["finish_date"];
            if (array_key_exists("paid", $reservation_data)) {
                $this->paid = '1';
            } else {
                $this->paid = '0';
            }
        }
    }

    function store() {
        global $con;
        $sql = "INSERT INTO RESERVES (customer_id, room_id, start_date, finish_date, paid) VALUES ('".$this->customer_id."','".$this->room_id."','".$this->start_date."','".$this->finish_date."','".$this->paid."')";
        $res = $con->query($sql);
        echo($con->error);
        return $res;
    }

    function delete() {
        global $con;
        $con->query("DELETE FROM RESERVES WHERE (room_id=" . $this->room_id . " AND start_date='". $this->start_date ."')");
        echo($con->error);
    }

    public static function createReservation($reservation_data) {
        return new Reservation($reservation_data);
    }

    static function fetchAll() {
        global $con;
        $result = $con->query("SELECT * FROM RESERVES INNER JOIN CUSTOMERS ON CUSTOMERS.irs_number = RESERVES.customer_id");
        echo($con->error);
        $reservations_data = $result->fetch_all();
        return array_map(array('Reservation','createReservation'), $reservations_data);
    }

    static function fetchOne($room_id, $start_date) {
        global $con;
        $result = $con->query("SELECT * FROM RESERVES INNER JOIN ROOMS ON ROOMS.id = RESERVES.room_id WHERE room_id=" . $room_id . " AND start_date='". $start_date ."'");
        $reservations_data = $result->fetch_all();
        return new Reservation($reservations_data[0]);
    }

}

?>