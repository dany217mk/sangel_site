<?php
$routes = array(
  'AdminController' => array(
    'admin_auth' => 'auth',
    'admins' => 'views',
    'admin/add' => 'add',
    'admin/delete' => 'delete',
    'logout' => 'logout',
  ),
  'FeedbackController' => array(
    'admin_feedback' => 'index',
    'feedback/edit/([0-9]+)' => 'edit/$1',
    'feedback/delete/([0-9]+)' => 'delete/$1',
  ),
  'ReservationController' => array(
    'reservations' => 'index',
    'reservation/edit/([0-9]+)' => 'edit/$1',
    'reservation/delete/([0-9]+)' => 'delete/$1',
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
