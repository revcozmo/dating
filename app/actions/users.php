<?php

include_once $_SERVER['DATING_ROOT'] . '/lib/init-global.php';

switch($_SERVER['REQUEST_METHOD']) {
  case 'POST':
    // create
    \lib\user::create(json_decode($POST, $assoc = true));

  case 'GET':
    if (preg_match('|^/(\d+)|', $_SERVER['PATH_INFO'], $matches)) {
      // retrieve single user
      echo json_encode(\lib\user::get($matches[1]));
    } else if (preg_match('|^/page=(\d+)&perPage=(\d+)|', $_SERVER['PATH_INFO'], $matches)) {
      // retrieve list of users
      echo json_encode(\lib\user::list_users($matches[1], $matches[2]));
    }
    break;

  case 'PUT':
    // update
    break;
  case 'DELETE':
    if (!preg_match('|(\d+)|', $_SERVER['PATH_INFO'], $matches)) {
      echo '';
    }
    \lib\user::delete($matches[0]);
    break;

  default:
    \lib\log::error('REQUEST METHOD INVALID: ' . $_SERVER['REQUEST_METHOD']);

}
