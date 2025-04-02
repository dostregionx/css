<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/survey/external', 'SurveyController::external');
$routes->post('/survey/save', 'SurveyController::save');

$routes->get('thank-you', 'SurveyController::thank_you');

$routes->get('/login', 'HomeController::login');
$routes->post('/login', 'HomeController::login');

$routes->get('/reports/responses', 'ReportsController::responses');
$routes->get('/reports/generate', 'ReportsController::generate');
$routes->post('/reports/gen_result', 'ReportsController::gen_result');
$routes->get('/reports/gen_pdf', 'ReportsController::gen_pdf');










