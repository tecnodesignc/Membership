<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => '/membership/v1'], function (Router $router) {
    include('ApiRoute/addressRoutes.php');
    include('ApiRoute/committeeRoutes.php');
    include('ApiRoute/congregationRoutes.php');
    include('ApiRoute/districtRoutes.php');
    include('ApiRoute/professionsRoutes.php');
    include('ApiRoute/profileRoutes.php');
    include('ApiRoute/studyRoutes.php');
    include('ApiRoute/workstationRoutes.php');
});
