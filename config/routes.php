<?php
$routes = array(
  'AdminController' => array(
    'admin_auth' => 'auth',
    'logout' => 'logout',
  ),
  'FeedbackController' => array(
    'admin_feedback' => 'index',
    'feedback/edit/([0-9]+)' => 'edit/$1',
    'feedback/delete/([0-9]+)' => 'delete/$1',
  ),
  'ReservationController' => array(
    'reservations' => 'index',
    'reservations/edit/([0-9]+)' => 'edit/$1',
    'reservations/delete/([0-9]+)' => 'delete/$1',
  ),
  'ProductController' => array(
    'products' => 'index',
    'product/add' => 'add',
    'product/edit/([0-9]+)' => 'edit/$1',
    'product/delete/([0-9]+)' => 'delete/$1',
  ),
  'MainController' => array(
      'report/([a-z]+)' => 'report/$1',
      'privacy' => 'privacy',
      '' => 'index'
    )
);
