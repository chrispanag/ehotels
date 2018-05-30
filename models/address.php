<?php

require_once '../mysql_connector.php';

class Address {

    private function isAssoc(array $arr) {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    function __construct($address_data) {
        if (!Address::isAssoc($address_data)) {
            $this->id = $address_data[0];
            $this->street = $address_data[1];
            $this->number = $address_data[2];
            $this->postal_code = $address_data[3];
            $this->city = $address_data[4];
        } else {
            $this->street = $address_data["street"];
            $this->number = $address_data["number"];
            $this->postal_code = $address_data["postal_code"];
            $this->city = $address_data['city'];
        }
    }

    function store() {
        global $con;
        $sql = "INSERT INTO ADDRESSES (street, number, postal_code, city) VALUES ('".$this->street."','".$this->number."','".$this->postal_code."','".$this->city."')";
        $res = $con->query($sql);
        $this->id = $con->insert_id;
        echo($con->error);
        return $res;
    }

    function serialize() {
        return $this->street . " " . $this->number . ", " . $this->city . ", " . $this->postal_code;
    }

}

?>