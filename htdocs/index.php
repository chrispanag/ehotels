<?php

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

include 'templates/header.php';

// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        require 'views/home.php';
        break;
    // About page
    case '/rooms':
        require 'views/rooms.php';
        break;
    // About page
    case '/employees':
        require 'views/employees.php';
        break;
    // About page
    case '/available':
        require 'views/available.php';
        break;
    // About page
    case '/customers':
        require 'views/customers.php';
        break;
    // About page
    case '/hotels':
        require 'views/hotels.php';
        break;
    // Everything else
    default:
        require 'views/404.php';
        break;
}

include 'templates/footer.php'

?>