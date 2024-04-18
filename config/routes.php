<?php
$routes = array(
  'AdminController' => array(
    'admin_auth' => 'auth',
    'tables' => 'table'
  ),
  'MainController' => array(
      'report/([a-z]+)' => 'report/$1',
      'privacy' => 'privacy',
      '' => 'index'
    )
);
