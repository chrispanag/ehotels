<?php 

require_once '../models/rent.php';

class RentsController {
    function showAll() {
        $rents = Rent::fetchAll();
        (new View('rents', array(
            'rents' => $rents
        ), 'show'))->render();
    }
}

?>