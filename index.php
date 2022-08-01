<?php

require 'database.php';
require 'flash_message.php';

session_start();

$flashMessage = getFlashMessage();
$users = getUsers();

require 'view/index.php';
