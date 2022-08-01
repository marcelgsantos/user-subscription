<?php

require 'database.php';

session_start(); //início de sessão. permite trocar informações de, e estabelecer sessões entre páginas

$flashMessage = $_SESSION["flash_message"] ?? ""; //mensagem de sucesso 
unset($_SESSION["flash_message"]);

$users = getUsers();

require 'view/index.php';
