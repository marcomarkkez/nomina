<?php 

function __autoload($class) {
  $path = $_SERVER['DOCUMENT_ROOT'] . '/controller/';
  require_once  $path . $class .'.php';
}