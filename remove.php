<?php

require './database.php';
require './flash_message.php';

session_start();

$id = $_GET["id"];

removeUser($id);

setFlashMessage('success', 'Usuário removido com sucesso!', './index.php');