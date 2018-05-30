<?php 

require_once '../models/reservation.php';
require_once '../models/room.php';
require_once '../models/customer.php';

class ReservationsController {
    function showAll() {
        $reservations = Reservation::fetchAll();
        (new View('reservations', array(
            'reservations' => $reservations
        ), 'show'))->render();
    }

    function newReservation() {
        $rooms = Room::fetchAll();
        $customers = Customer::fetchAll();
        (new View('newReservation', array(
            'start_date' => 'YYYY-MM-DD',
            'finish_date' => 'YYYY-MM-DD',
            'rooms' => $rooms, 
            'customers' => $customers,
            'room_id' => 'null'
        ), 'Add'))->render();
    }

    function addReservation() {
        $reservation = new Reservation($_POST);
        if (!$reservation->store()) {
            echo("Error");
            die();
        }
        header('Location: ./hotel_groups', TRUE, 302);
        die();
    }
}

?>