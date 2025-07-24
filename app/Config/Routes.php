<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/survey/external', 'SurveyController::external');
$routes->get('/survey/internal', 'SurveyController::internal');

$routes->post('/survey/save', 'SurveyController::save');
$routes->get('thank-you', 'SurveyController::thank_you');
$routes->get('/login', 'HomeController::login');
$routes->post('/login', 'HomeController::login');

$routes->get('/reports/responses', 'ReportsController::responses');
$routes->get('/reports/generate', 'ReportsController::generate');
$routes->post('/reports/gen_result', 'ReportsController::gen_result');
$routes->get('/reports/gen_pdf', 'ReportsController::gen_pdf');

$routes->get('/registry/signatories', 'RegistryController::signatories');
$routes->post('/registry/save-signatory', 'RegistryController::saveSignatory');
$routes->post('/registry/update-signatory', 'RegistryController::updateSignatory');
$routes->post('registry/delete-signatory/(:num)', 'RegistryController::deleteSignatory/$1');












