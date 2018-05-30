<?php 

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
        } else {
            $this->customer_id = $reservation_data["customer_id"];
            $this->room_id = $reservation_data["room_id"];
            $this->start_date = $reservation_data["start_date"];
            $this->finish_date = $reservation_data["finish_date"];
            $this->paid = $reservation_data["paid"];
        }
    }

    function store() {
        global $con;
        $sql = "INSERT INTO RESERVES (customer_id, room_id, start_date, finish_date, paid) VALUES ('".$this->customer_id."','".$this->room_id."','".$this->start_date."','".$this->finish_date."','".$this->paid."')";
        $res = $con->query($sql);
        echo($con->error);
        return $res;
    }
}

?>