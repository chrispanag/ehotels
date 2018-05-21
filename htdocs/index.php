<?php

require_once '../controllers/hotels_controller.php';
require_once '../controllers/customers_controller.php';
require_once '../controllers/view_controller.php';
require_once '../controllers/hotel_groups_controller.php';

$hotelsController = new HotelsController();
$customersController = new CustomersController();
$hotelGroupsController = new HotelGroupsController();

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        (new View('home', []))->render();
        break;
    // About page
    case '/rooms':
        (new View('rooms', []))->render();
        break;
    // About page
    case '/employees':
        (new View('employees', []))->render();
        break;
    // About page
    case '/available':
        (new View('available', []))->render();
        break;
    // About page
    case '/customers':
        $customersController->showAll();
        break;
    // About page
    case '/hotels': 
        $hotelsController->showAll();
        break;
    // About page
    case '/addHotel':
        (new View('addHotel', []))->render();
        break;
    case '/new_hotel':
        $hotelsController->addHotel();
        break;
    // About page
    case '/hotel_groups':
        $hotelGroupsController->showAll();
        break;
    // Everything else
    default:
        (new View('404', []))->render();
        break;
}

?>