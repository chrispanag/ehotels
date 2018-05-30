<?php 

require_once '../mysql_connector.php';

class Payment {
    function __construct($payment_amount, $payment_method) {
        $this->payment_amount = $payment_amount;
        $this->payment_method = $payment_method;
    }

    function store() {
        global $con;
        $sql = "INSERT INTO PAYMENT_TRANSACTIONS (payment_amount, payment_method) VALUES ('".$this->payment_amount."','".$this->payment_method."')";
        $res = $con->query($sql);
        $this->id = $con->insert_id;
        echo($con->error);
        return $res;
    }
}

class Rent {

    function __construct($rent_data = array(), $employee_id = null, $reservation = null, $payment_method = null) {
        if (count($rent_data) == 0) {
            $this->employee_id = $employee_id;
            $this->room_id = $reservation->room_id;
            $this->customer_id = $reservation->customer_id;
            $this->start_date = $reservation->start_date;
            $this->finish_date = $reservation->finish_date;
            $this->payment = new Payment($reservation->room->price, $payment_method);
        } else {
            $this->employee_id = $rent_data[0];
            $this->customer_id = $rent_data[1];
            $this->room_id = $rent_data[2];
            $this->start_date = $rent_data[3];
            $this->finish_date = $rent_data[4];
            $this->payment_id = $rent_data[5];
            $this->payment = new Payment($rent_data[7], $rent_data[8]);
        }   
    }

    function store() {
        global $con;
        $this->payment->store();
        $this->payment_id = $this->payment->id;
        $res = $con->query("INSERT INTO RENTS (employee_id, room_id, customer_id, start_date, finish_date, payment_id) VALUES ('".$this->employee_id."','".$this->room_id."','".$this->customer_id."','".$this->start_date."','".$this->finish_date."','".$this->payment_id."')");
        echo($con->error);
        return $res;
    }

    public static function createRent($rent_data) {
        return new Rent($rent_data);
    }

    static function fetchAll() {
        global $con;
        $res = $con->query("SELECT * FROM RENTS INNER JOIN PAYMENT_TRANSACTIONS ON RENTS.payment_id = PAYMENT_TRANSACTIONS.id");
        $rents_data = $res->fetch_all();
        return array_map(array('Rent','createRent'), $rents_data);
    }
}

?>