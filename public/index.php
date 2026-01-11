<?php

// Start session at the very beginning
session_start();

// 1. Seteaza calea de baza pentru a putea include fisierele din afara directorului public
define('ROOT_PATH', dirname(__DIR__));


// 2. incarca Routerul: Calea ar trebui sa fie ROOT_PATH/app/Core/Router.php
require_once ROOT_PATH . '/app/Core/Router.php'; // <--- VERIFICa CALEA AICI!

// =========================================================================
// 3. DEFINIREA RUTELOR APLICAtIEI
// =========================================================================

$router = new Router();

$router->get('fitnessapp/public', 'CoreController@index'); // Ruta pentru accesul direct la /public/
$router->get('fitnessapp/public/', 'CoreController@index'); // Adaugati si varianta cu slash

// Ruta GET pentru Pagina Principala (View-ul index.php)
// Controller-ul ar trebui sa fie CoreController care incarca View-ul index.php
$router->get('', 'CoreController@index');

// Ruta GET pentru Logout
$router->get('logout', 'UserController@logout');

// Ruta POST pentru Logare
$router->post('user/login', 'UserController@login');

// Ruta POST pentru inregistrare
$router->post('user/register', 'UserController@register');

// Ruta GET pentru pagina Retete
$router->get('retete', 'RecipeController@index');

// Rute pentru administrare retete (doar admin)
$router->get('retete/create', 'RecipeController@create');
$router->post('retete/store', 'RecipeController@store');
$router->get('retete/edit/{id}', 'RecipeController@edit');
$router->post('retete/update/{id}', 'RecipeController@update');
$router->get('retete/delete/{id}', 'RecipeController@delete');

// Ruta GET pentru pagina Antrenamente
$router->get('antrenamente', 'WorkoutController@index');

// Rute pentru administrare antrenamente (doar admin)
$router->get('antrenamente/create', 'WorkoutController@create');
$router->post('antrenamente/store', 'WorkoutController@store');
$router->get('antrenamente/edit/{id}', 'WorkoutController@edit');
$router->post('antrenamente/update/{id}', 'WorkoutController@update');
$router->get('antrenamente/delete/{id}', 'WorkoutController@delete');

// Ruta GET pentru pagina Orar
$router->get('orar', 'CoreController@orar');

// =========================================================================
// 4. INItIALIZAREA sI RULAREA APLICAtIEI
// =========================================================================

$router->dispatch();