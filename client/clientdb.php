<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// CLIENT DB CONFIG

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'	=> '',
    // Locally hosted on my machine
    //'hostname' => '127.0.0.1:8889',
    // Vagrant
    'hostname' => 'localhost',
    'username' => 'bhf',
    // 'username' => 'root',
    // Locally hosted on my machine
    // 'password' => 'ezolp',
    'password' => 'bhf',
    'database' => 'bhf',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => TRUE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_unicode_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);


