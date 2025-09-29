<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AdminController::index');

// 美容院予約システムのルート
$routes->get('/appointment', 'AppointmentController::index');
$routes->post('/appointment/save', 'AppointmentController::save');

// ログイン機能（IDでユーザー/管理者を判定）
$routes->get('/login', 'AdminController::index');
$routes->post('/login', 'AdminController::login');
$routes->get('/logout', 'AdminController::logout');

// 管理者向けルート
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/admin/appointments', 'AdminController::appointments');

// メニュー管理ルート
$routes->get('/admin/menus', 'AdminController::menus');
$routes->get('/admin/menus/create', 'AdminController::createMenu');
$routes->post('/admin/menus/save', 'AdminController::saveMenu');
$routes->get('/admin/menus/edit/(:num)', 'AdminController::editMenu/$1');
$routes->post('/admin/menus/update/(:num)', 'AdminController::updateMenu/$1');
$routes->get('/admin/menus/delete/(:num)', 'AdminController::deleteMenu/$1');
