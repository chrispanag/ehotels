<?php

require_once '../controllers/hotels_controller.php';
require_once '../controllers/customers_controller.php';
require_once '../controllers/view_controller.php';
require_once '../controllers/hotel_groups_controller.php';
require_once '../controllers/room_controller.php';
require_once '../controllers/employees_controller.php';

$hotelsController = new HotelsController();
$customersController = new CustomersController();
$hotelGroupsController = new HotelGroupsController();
$roomsController = new RoomController();
$employeesController = new EmployeesController();

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        (new View('home', []))->render();
        break;
    // About page
    case '/rooms':
        $roomsController->showAll();
        break;
    // About page
    case '/addHotel%20Room':
        $roomsController->newRoom();
        break;
    // About page
    case '/new_room':
        $roomsController->addRoom();
        break;
    // About page
    case '/deleteRoom':
        $roomsController->deleteRoom();
        break;
    // About page
    case '/employees':
        $employeesController->showAll();
        break;
    // About page
    case '/addEmployee':
        (new View('addEmployee', []))->render();
        break;
    case '/deleteEmployee':
        $employeesController->deleteEmployee();
        break;
    // About page
    case '/new_employee':
        $employeesController->addEmployee();
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
        $hotelsController->newHotel();
        break;
    case '/new_hotel':
        $hotelsController->addHotel();
        break;
    // About page
    case '/hotel_groups':
        $hotelGroupsController->showAll();
        break;
    // About page
    case '/addHotel%20Group':
        (new View('addHotelGroup', []))->render();
        break;
    case '/new_hotel_group':
        $hotelGroupsController->addHotelGroup();
        break;
    case '/deleteHotelGroup':
        $hotelGroupsController->deleteHotelGroup();
        break;
    // About page
    case '/deleteHotel':
        $hotelsController->deleteHotel();
        break;
    // Everything else
    default:
        (new View('404', []))->render();
        break;
}

?>