<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('about', 'Pages::about');
$routes->get('services', 'Pages::services');

// The form page carries the honeypot field; the POST also requires a valid CSRF token.
$routes->get('contact', 'Contact::index', ['filter' => 'honeypot']);
$routes->post('contact', 'Contact::submit', ['filter' => ['csrf', 'honeypot']]);
