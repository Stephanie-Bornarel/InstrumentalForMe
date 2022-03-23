<?php

use Instrumental\Controllers\UserController;
use Instrumental\Controllers\AppointmentController;
use Instrumental\Controllers\TestController;

global $router;

// instanciation du router
$router = new AltoRouter();
$baseURI = dirname($_SERVER['SCRIPT_NAME']);
$router->setBasePath($baseURI);

// configuration des routes

// === HOME===

$router->map(
    'GET, POST', // surveille les appels HTTP de type GET
    '/user/dashboard/', // url a surveiller
    function () {
        $userController = new UserController();
        $userController->home();
    },
    'user-home'
);

// === UPDATE ===
$router->map(
    'GET',
    '/user/update-profile/',
    function () {
        $userController = new UserController();
        $userController->updateProfile();
    },
    'user-update-profile'
);

$router->map(
    'POST',
    '/user/update-profile/',
    function () {
        $userController = new UserController();
        $userController->saveProfile();
    },
    'user-save-profile'
);

// === LESSON ===
$router->map(
    'POST',
    '/teacher/take-lesson',
    function () {
        $userController = new UserController();
        $userController->takeLesson();
    },
    'teacher-take-lesson'
);

// === APPOINTMENT ===
$router->map(
    'GET',
    '/teacher/appointment/',
    function () {
        $appointmentController = new AppointmentController();
        $appointmentController->appointment();
    },
    'appointment'
);




// ==== DELETE ACCOUNT ====
$router->map(
    'GET',
    '/user/delete-account/',
    function () {
        $userController = new UserController();
        $userController->deleteAccount();
    },
    'user-delete-account'
);
