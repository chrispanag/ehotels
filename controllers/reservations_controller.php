<?php 

require_once '../models/reservation.php';
require_once '../models/room.php';
require_once '../models/customer.php';
require_once '../models/rent.php';

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
        header('Location: ./reservations', TRUE, 302);
        die();
    }

    function deleteReservation() {
        $reservation = Reservation::fetchOne($_GET['room_id'], $_GET['start_date']);
        $reservation->delete();
        header('Location: ./reservations', TRUE, 302);
        die();
    }

    function checkIn() {
        $reservation = Reservation::fetchOne($_GET['room_id'], $_GET['start_date']);
        $rent = new Rent(array(), $_GET['employee_id'], $reservation, $_GET['payment_method']);
        $rent->store();
        $reservation->delete();
        header('Location: ./rents', TRUE, 302);
        die();
    }
}

?>